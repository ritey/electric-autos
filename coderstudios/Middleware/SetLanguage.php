<?php

namespace CoderStudios\Middleware;

use Closure;

class SetLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!session()->has('language_chosen')) {
            session()->put('language_chosen', 'en');
        }
        if ($request->route()->parameter('language') && in_array($request->route()->parameter('language'), available_languages())) {
            session()->put('language_chosen', strtolower($request->route()->parameter('language')));
        }

        return $next($request);
    }
}
