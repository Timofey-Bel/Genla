<?php

namespace App\Services\GenlaAi\Drivers;

use App\Services\GenlaAi\AssistantReply;
use App\Services\GenlaAi\Contracts\AssistantDriver;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Драйвер внешнего агента.
 *
 * Поддерживает два формата (config genla.ai.format):
 *   - 'timeweb' — нативный API Timeweb Cloud AI:
 *       POST .../agents/{id}/call   тело {message, parent_message_id?}
 *       ответ {message, id, response_id}
 *   - 'openai'  — OpenAI-совместимый chat/completions.
 *
 * Авторизация — bearer-токен из .env (GENLA_AI_TOKEN).
 * При отсутствии токена/endpoint или любой ошибке мягко падает
 * в сценарный драйвер, чтобы диалог не «ломался».
 */
class HttpAgentDriver implements AssistantDriver
{
    /** @var array<int,string> Подсказки по умолчанию для внешнего агента. */
    private const SUGGESTIONS = ['Подобрать решение', 'Нужны GPU-серверы', 'Получить презентацию'];

    public function __construct(private ScriptedDriver $fallback)
    {
    }

    public function reply(string $message, array $history = [], ?string $parentMessageId = null): AssistantReply
    {
        $endpoint = config('genla.ai.endpoint');
        $token = config('genla.ai.token');

        // Чистим пользовательский ввод от HTML до отправки в API.
        // HTML-экранирование выполняется один раз при выводе на фронте.
        $message = trim(strip_tags($message));

        // Нет настроек или пустое сообщение — сразу локальный ассистент.
        if (empty($endpoint) || empty($token) || $message === '') {
            return $this->fallback->reply($message, $history, $parentMessageId);
        }

        try {
            $request = Http::timeout((int) config('genla.ai.timeout', 60))
                ->connectTimeout(10)
                ->retry(3, 100, null, false)
                ->acceptJson()
                ->withToken($token);

            return config('genla.ai.format', 'timeweb') === 'openai'
                ? $this->callOpenAi($request, $endpoint, $message, $history)
                : $this->callTimeweb($request, $endpoint, $message, $parentMessageId);
        } catch (Throwable $e) {
            Log::warning('GENLA AI: сбой обращения к внешнему агенту', ['error' => $e->getMessage()]);

            return $this->fallback->reply($message, $history, $parentMessageId);
        }
    }

    /** Нативный Timeweb Cloud AI. */
    private function callTimeweb($request, string $endpoint, string $message, ?string $parentMessageId): AssistantReply
    {
        $body = ['message' => $message];
        if (! empty($parentMessageId)) {
            $body['parent_message_id'] = $parentMessageId;
        }

        $response = $request->post($endpoint, $body);

        if (! $response->successful()) {
            $err = $response->json();
            Log::warning('GENLA AI (timeweb): ошибка ответа', [
                'status' => $response->status(),
                'error_code' => $err['error_code'] ?? null,
                'message' => $err['message'] ?? $err['error'] ?? null,
            ]);

            return $this->fallback->reply($message);
        }

        $data = $response->json();
        $text = $data['message'] ?? null;

        if (! is_string($text) || $text === '') {
            return $this->fallback->reply($message);
        }

        // id ответа — для продолжения диалога (parent_message_id в следующем запросе).
        return new AssistantReply($text, self::SUGGESTIONS, null, null, $data['id'] ?? null);
    }

    /** OpenAI-совместимый формат. */
    private function callOpenAi($request, string $endpoint, string $message, array $history): AssistantReply
    {
        $messages = [['role' => 'system', 'content' => config('genla.ai.system_prompt')]];

        foreach ($history as $turn) {
            $role = ($turn['role'] ?? 'user') === 'user' ? 'user' : 'assistant';
            $content = (string) ($turn['content'] ?? '');
            if ($content !== '') {
                $messages[] = ['role' => $role, 'content' => $content];
            }
        }
        $messages[] = ['role' => 'user', 'content' => $message];

        $payload = ['messages' => $messages];
        if (! empty(config('genla.ai.model'))) {
            $payload['model'] = config('genla.ai.model');
        }

        $response = $request->post($endpoint, $payload);

        if (! $response->successful()) {
            Log::warning('GENLA AI (openai): ошибка ответа', ['status' => $response->status()]);

            return $this->fallback->reply($message);
        }

        $data = $response->json();
        $text = data_get($data, 'choices.0.message.content')
            ?? data_get($data, 'message.content')
            ?? data_get($data, 'reply')
            ?? data_get($data, 'message');

        if (! is_string($text) || $text === '') {
            return $this->fallback->reply($message);
        }

        return new AssistantReply($text, self::SUGGESTIONS);
    }
}
