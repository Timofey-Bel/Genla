<?php

namespace App\Http\Controllers;

use App\Support\Genla;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LabController extends Controller
{
    /** Path-режим: /{lab}. */
    public function show(string $lab): View|RedirectResponse
    {
        return $this->render($lab);
    }

    /** Subdomain-режим: {lab}.genla.ru — slug приходит из домена. */
    public function showSub(string $lab): View|RedirectResponse
    {
        return $this->render($lab);
    }

    private function render(string $slug): View|RedirectResponse
    {
        // Переехавшие направления (genbox → genfleet и т.п.) — 301 на актуальное.
        $moved = config('genla.moved_labs', [])[$slug] ?? null;
        if ($moved !== null) {
            return redirect(Genla::url($moved), 301);
        }

        $lab = Genla::lab($slug);

        abort_if($lab === null, 404);

        return view('labs.show', [
            'lab' => $lab,
            'others' => Genla::otherLabs($slug),
        ]);
    }
}
