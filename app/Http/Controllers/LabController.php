<?php

namespace App\Http\Controllers;

use App\Support\Genla;
use Illuminate\Contracts\View\View;

class LabController extends Controller
{
    /** Path-режим: /{lab}. */
    public function show(string $lab): View
    {
        return $this->render($lab);
    }

    /** Subdomain-режим: {lab}.genla.ru — slug приходит из домена. */
    public function showSub(string $lab): View
    {
        return $this->render($lab);
    }

    private function render(string $slug): View
    {
        $lab = Genla::lab($slug);

        abort_if($lab === null, 404);

        return view('labs.show', [
            'lab' => $lab,
            'others' => Genla::otherLabs($slug),
        ]);
    }
}
