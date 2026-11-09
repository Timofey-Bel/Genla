<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Services\TelegramNotifier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class LeadController extends Controller
{
    /** Приём заявки (сохранение в БД + выгрузка в Telegram). */
    public function store(Request $request, TelegramNotifier $telegram): JsonResponse
    {
        // Honeypot: поле-ловушка, скрытое от людей. Если заполнено — это бот.
        // Возвращаем «успех», чтобы бот не понял, что отфильтрован.
        if (filled($request->input('company_site'))) {
            return response()->json(['ok' => true]);
        }

        $labs = array_keys(config('genla.labs', []));
        $actions = array_keys(config('genla.actions', []));

        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'contact' => ['required', 'string', 'max:160'],
            'email' => ['nullable', 'email', 'max:160'],
            'message' => ['nullable', 'string', 'max:2000'],
            'action' => ['nullable', 'string', Rule::in($actions)],
            'lab' => ['nullable', 'string', Rule::in($labs)],
            'source' => ['nullable', 'string', 'max:255'],
        ]);

        $attributes = [
            'name' => $data['name'],
            'contact' => $data['contact'],
            'email' => $data['email'] ?? null,
            'message' => $data['message'] ?? null,
            'action' => $data['action'] ?? 'consultation',
            'lab' => $data['lab'] ?? null,
            'source' => $data['source'] ?? null,
            'ip' => $request->ip(),
            'user_agent' => mb_substr((string) $request->userAgent(), 0, 255),
        ];

        // Сохраняем только поля, для которых реально есть колонки в таблице leads.
        // Если миграция (например, добавление source) ещё не выполнена на сервере —
        // лишнее поле молча отбрасывается, и заявка сохраняется, а не падает с 500.
        $attributes = $this->keepExistingColumns($attributes);

        try {
            $lead = Lead::create($attributes);
        } catch (\Throwable $e) {
            // База недоступна на запись (readonly / нет места и т.п.). Заявку не теряем:
            // пишем в лог и доставляем в Telegram «как есть», затем отвечаем успехом.
            Log::error('Lead save failed; falling back to log + telegram', [
                'error' => $e->getMessage(),
                'lead' => $attributes,
            ]);

            $this->notifyWithoutPersisting($telegram, $attributes);

            return response()->json(['ok' => true]);
        }

        // Выгрузка заявки в Telegram-группу. Выполняется после ответа клиенту,
        // чтобы форма отвечала мгновенно и сбой Telegram не ломал отправку.
        dispatch(function () use ($lead, $telegram) {
            $telegram->sendLead($lead);
        })->afterResponse();

        return response()->json(['ok' => true, 'id' => $lead->id]);
    }

    /**
     * Оставляет только атрибуты, для которых в таблице есть колонки.
     * Защищает приём заявок, когда миграция ещё не выполнена (нет колонки → пропускаем поле).
     *
     * @param  array<string,mixed>  $attributes
     * @return array<string,mixed>
     */
    private function keepExistingColumns(array $attributes): array
    {
        try {
            $columns = Schema::getColumnListing((new Lead)->getTable());
        } catch (\Throwable $e) {
            return $attributes; // схему прочитать не удалось — ничего не отбрасываем
        }

        return $columns ? array_intersect_key($attributes, array_flip($columns)) : $attributes;
    }

    /**
     * Аварийная доставка в Telegram, когда заявку не удалось сохранить в БД.
     * Заявка не теряется: команда видит её в группе, плюс она записана в лог.
     *
     * @param  array<string,mixed>  $attributes
     */
    private function notifyWithoutPersisting(TelegramNotifier $telegram, array $attributes): void
    {
        try {
            $lead = new Lead($attributes);
            $lead->created_at = now();
            $telegram->sendLead($lead);
        } catch (\Throwable $e) {
            Log::warning('Fallback telegram notify failed: '.$e->getMessage());
        }
    }
}
