<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Services\TelegramNotifier;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

/**
 * Единая короткая заявка «Стать партнёром» (одна форма для четырёх ролей).
 * Сохраняется в общую базу обращений (leads, action = partner) и уходит в Telegram.
 * Статус заявки не означает партнёрского статуса — подключение после встречи.
 */
class PartnerApplicationController extends Controller
{
    /** Версия текста согласия: фиксируется вместе с заявкой. */
    private const CONSENT_VERSION = 'partner-consent-v1';

    /** Минимальное время заполнения формы (сек) — фоновая проверка от ботов. */
    private const MIN_SECONDS = 3;

    public function store(Request $request, TelegramNotifier $telegram): JsonResponse
    {
        // Honeypot: людям поле не видно. Боту отвечаем «успехом», ничего не сохраняя.
        if (filled($request->input('company_site'))) {
            return response()->json(['ok' => true]);
        }

        if (! $this->passesTimingCheck((string) $request->input('form_token'))) {
            return response()->json([
                'ok' => false,
                'errors' => ['form' => [__('genla.partner_form.check_failed')]],
            ], 422);
        }

        $required = __('genla.partner_form.required');
        $data = $request->validate([
            'role' => ['required', Rule::in(['specialist', 'product', 'ambassador', 'franchise'])],
            'last_name' => ['required', 'string', 'max:80'],
            'first_name' => ['required', 'string', 'max:80'],
            'middle_name' => ['nullable', 'string', 'max:80'],
            'city' => ['required', 'string', 'max:120'],
            'organization' => ['nullable', 'string', 'max:160'],
            'activity' => ['required', 'string', 'max:300'],
            'messenger' => ['required', Rule::in(['telegram', 'whatsapp', 'max', 'other'])],
            'messenger_other' => ['nullable', 'required_if:messenger,other', 'string', 'max:60'],
            'contact' => ['required', 'string', 'max:160'],
            'contact_time' => ['required', 'string', 'max:160'],
            'consent' => ['accepted'],
            'source' => ['nullable', 'string', 'max:255'],
        ], [
            'required' => $required,
            'required_if' => $required,
            'consent.accepted' => __('genla.partner_form.consent_required'),
        ]);

        $roleLabel = __('genla.partner_form.roles.'.$data['role']);
        $messenger = $data['messenger'] === 'other'
            ? trim((string) $data['messenger_other'])
            : __('genla.partner_form.messengers.'.$data['messenger']);

        $fullName = trim(implode(' ', array_filter([$data['last_name'], $data['first_name'], $data['middle_name'] ?? null])));

        $message = implode("\n", array_filter([
            'Роль: '.$roleLabel,
            'Город: '.$data['city'],
            ! empty($data['organization']) ? 'Организация / ИП: '.$data['organization'] : null,
            'Сфера деятельности: '.$data['activity'],
            'Удобное время: '.$data['contact_time'],
            'Согласие: '.self::CONSENT_VERSION.', '.now()->format('d.m.Y H:i'),
        ]));

        $attributes = [
            'name' => $fullName,
            'contact' => $messenger.': '.$data['contact'],
            'message' => $message,
            'action' => 'partner',
            'lab' => null,
            'source' => $data['source'] ?? null,
            'status' => 'new',
            'ip' => $request->ip(),
            'user_agent' => mb_substr((string) $request->userAgent(), 0, 255),
        ];

        try {
            $lead = Lead::create($attributes);
        } catch (\Throwable $e) {
            // Успех показываем только после подтверждённого сохранения (ТЗ, раздел 10).
            Log::error('Partner application save failed', ['error' => $e->getMessage(), 'lead' => $attributes]);

            return response()->json([
                'ok' => false,
                'errors' => ['form' => [__('genla.partner_form.error')]],
            ], 500);
        }

        dispatch(function () use ($lead, $telegram) {
            $telegram->sendLead($lead);
        })->afterResponse();

        return response()->json(['ok' => true, 'id' => $lead->id]);
    }

    /** Подписанная метка времени показа формы: не подделана и прошло ≥ MIN_SECONDS (но не больше суток). */
    private function passesTimingCheck(string $token): bool
    {
        if ($token === '') {
            return false;
        }

        try {
            $shownAt = (int) Crypt::decryptString($token);
        } catch (DecryptException) {
            return false;
        }

        $elapsed = now()->timestamp - $shownAt;

        return $elapsed >= self::MIN_SECONDS && $elapsed <= 86400;
    }
}
