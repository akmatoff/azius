<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $locale = $request->segment(1);

        if (in_array($locale, ['en', 'ru'])) {
            App::setLocale($locale);
            session(['locale' => $locale]);
        } elseif (session()->has('locale')) {
            App::setLocale(session('locale'));
        }

        return $next($request);
    }
}

