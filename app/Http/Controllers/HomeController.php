<?php

namespace App\Http\Controllers;

use App\Support\Genla;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /** Главная — GENLA OS. */
    public function index(): View
    {
        return view('home', [
            'gridLabs' => Genla::gridLabs(),
        ]);
    }
}
