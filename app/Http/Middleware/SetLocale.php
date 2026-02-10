<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->segment(1);

        if (in_array($locale, ['fr', 'ar', 'en'])) {
            App::setLocale($locale);
        } else {
            // Default to fr if no valid locale in segment 1
            App::setLocale('fr');
        }

        return $next($request);
    }
}
