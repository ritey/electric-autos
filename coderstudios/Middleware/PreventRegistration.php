<?php

namespace CoderStudios\Middleware;

class PreventRegistration
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        if ($request->is('register') && !$request->get('bypass_blocker')) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
