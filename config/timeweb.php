<?php

/*
|--------------------------------------------------------------------------
| Timeweb AI Agent — конфигурация интерфейса Genla (ai.genla.tech)
|--------------------------------------------------------------------------
| Токен берётся из GENLA_AI_TOKEN (он уже задан в .env), agent_id — наш агент.
| При желании можно переопределить отдельными переменными TIMEWEB_*.
*/

return [
    'agent_id' => env('TIMEWEB_AGENT_ID', '29461822-e79e-4e20-a36d-4ca577db1384'),
    'api_token' => env('TIMEWEB_API_TOKEN', env('GENLA_AI_TOKEN')),
    'api_url' => env('TIMEWEB_API_URL', 'https://api.timeweb.cloud/api/v1/cloud-ai/agents'),
];
