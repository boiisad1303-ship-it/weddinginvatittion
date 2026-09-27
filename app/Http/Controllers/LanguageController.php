<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function switchLang(string $locale): RedirectResponse
    {
        abort_unless(in_array($locale, ['kh', 'en'], true), 404);

        session(['locale' => $locale]);
        App::setLocale($locale);

        return redirect()->back();
    }
}
