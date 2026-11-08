<?php

namespace App\Http\Controllers;

use App\Services\AiLeadCapture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;

/**
 * Бэкенд интерфейса Genla AI (ai.genla.tech).
 * Проксирует сообщения нативному агенту Timeweb. Контракт ответа совпадает
 * с фронтендом интерфейса: { success, message, id, response_id, finish_reason }.
 */
class AiAgentController extends Controller
{
    public function sendMessage(Request $request, AiLeadCapture $leadCapture)
    {
        // Rate limiting — 20 запросов в минуту на IP
        $key = 'ai-chat:'.$request->ip();

        if (RateLimiter::tooManyAttempts($key, 20)) {
            $seconds = RateLimiter::availableIn($key);

            return response()->json([
                'success' => false,
                'error' => "Слишком много запросов. Попробуйте через {$seconds} секунд.",
            ], 429);
        }

        RateLimiter::hit($key, 60);

        $validated = $request->validate([
            'message' => 'required|string|max:30000',
            'parent_message_id' => 'nullable|string|max:255',
        ]);

        // Чистим ввод от HTML. Экранирование делает фронтенд при выводе.
        $message = trim(strip_tags($validated['message']));

        $agentId = config('timeweb.agent_id');
        $token = config('timeweb.api_token');
        $apiUrl = config('timeweb.api_url');

        if (! $agentId || ! $token || ! $apiUrl) {
            Log::error('Timeweb configuration missing');

            return response()->json([
                'success' => false,
                'error' => 'Сервис временно недоступен',
            ], 503);
        }

        try {
            $response = Http::timeout(60)
                ->connectTimeout(10)
                ->retry(3, 100, null, false)
                ->withHeaders([
                    'Authorization' => 'Bearer '.$token,
                    'Content-Type' => 'application/json',
                ])
                ->post("{$apiUrl}/{$agentId}/call", [
                    'message' => $message,
                    'parent_message_id' => $validated['parent_message_id'] ?? null,
                ]);

            if ($response->successful()) {
                $data = $response->json();

                // Автозахват лида: если агент вернул GENLA_LEAD-блок — создаём заявку
                // и шлём её в Telegram/CRM, даже если клиент не дошёл до формы.
                [$message, $lead] = $leadCapture->handle($data['message'] ?? 'Нет ответа', $request);

                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'id' => $data['id'] ?? null,
                    'response_id' => $data['response_id'] ?? null,
                    'finish_reason' => $data['finish_reason'] ?? 'stop',
                    'lead_captured' => (bool) $lead,
                ]);
            }

            $body = $response->json();
            $upstreamMessage = $body['message'] ?? $body['error'] ?? $response->body();

            Log::error('Timeweb API Error', [
                'status' => $response->status(),
                'error_code' => $body['error_code'] ?? null,
                'message' => $upstreamMessage,
                'ip' => $request->ip(),
            ]);

            return $this->upstreamError($response->status(), $upstreamMessage);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Timeweb API Connection Exception', ['message' => $e->getMessage(), 'ip' => $request->ip()]);

            return response()->json([
                'success' => false,
                'error' => 'Не удалось связаться с AI-сервисом. Проверьте соединение и попробуйте позже.',
            ] + $this->debugPayload($e->getMessage()), 504);
        } catch (\Throwable $e) {
            Log::error('Timeweb API Exception', ['message' => $e->getMessage(), 'ip' => $request->ip()]);

            return response()->json([
                'success' => false,
                'error' => 'Внутренняя ошибка сервиса. Попробуйте позже или обратитесь к администратору.',
            ] + $this->debugPayload($e->getMessage()), 500);
        }
    }

    private function upstreamError(int $status, ?string $upstreamMessage)
    {
        switch (true) {
            case $status === 400:
                $message = 'Некорректный запрос к AI-сервису.';
                $httpStatus = 400;
                break;
            case $status === 401:
            case $status === 403:
                $message = 'Ошибка авторизации в AI-сервисе. Проверьте API-ключ или ограничения по IP.';
                $httpStatus = 502;
                break;
            case $status === 404:
                $message = 'AI-агент не найден. Проверьте идентификатор агента в настройках.';
                $httpStatus = 502;
                break;
            case $status === 429:
                $message = 'AI-сервис получает слишком много запросов. Попробуйте позже.';
                $httpStatus = 429;
                break;
            case $status >= 500:
                $message = 'AI-сервис временно недоступен. Попробуйте через 1-2 минуты.';
                $httpStatus = 503;
                break;
            default:
                $message = 'Не удалось получить ответ от AI.';
                $httpStatus = 502;
        }

        $payload = ['success' => false, 'error' => $message];

        if (config('app.debug')) {
            $payload['debug'] = [
                'upstream_status' => $status,
                'upstream_message' => is_string($upstreamMessage) ? mb_substr($upstreamMessage, 0, 500) : $upstreamMessage,
            ];
        }

        return response()->json($payload, $httpStatus);
    }

    private function debugPayload(?string $detail): array
    {
        return config('app.debug') ? ['debug' => ['detail' => $detail]] : [];
    }
}
