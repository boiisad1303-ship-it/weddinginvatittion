<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->session()->get('locale', 'kh');

        if (! in_array($locale, ['kh', 'en'], true)) {
            $locale = 'kh';
        }

        App::setLocale($locale);

        return $next($request);
    }
}
