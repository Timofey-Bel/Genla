<?php

namespace App\Http\Controllers;

use App\Services\GenlaAi\Contracts\AssistantDriver;
use App\Support\Genla;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /** Ответ GENLA AI. */
    public function reply(Request $request, AssistantDriver $assistant): JsonResponse
    {
        $data = $request->validate([
            'message' => ['required', 'string', 'max:2000'],
            'history' => ['sometimes', 'array', 'max:20'],
            'history.*.role' => ['required_with:history', 'string', 'in:user,assistant'],
            'history.*.content' => ['required_with:history', 'string', 'max:4000'],
            'parent_message_id' => ['sometimes', 'nullable', 'string', 'max:100'],
        ]);

        // На английской версии — добавляем инструкцию агенту отвечать по-английски.
        $message = $data['message'];
        if (app()->getLocale() === 'en') {
            $message = "[Reply in English only]\n".$message;
        }

        $reply = $assistant->reply(
            $message,
            $data['history'] ?? [],
            $data['parent_message_id'] ?? null
        );

        $payload = [
            'reply' => $reply->text,
            'suggestions' => $reply->suggestions,
            'action' => $reply->action,
            'lab' => null,
            'lab_name' => null,
            'lab_url' => null,
            'parent_id' => $reply->id,
        ];

        if ($reply->lab !== null && ($lab = Genla::lab($reply->lab)) !== null) {
            $payload['lab'] = $reply->lab;
            $payload['lab_name'] = $lab['name'];
            $payload['lab_url'] = Genla::url($reply->lab);
        }

        return response()->json($payload);
    }
}
