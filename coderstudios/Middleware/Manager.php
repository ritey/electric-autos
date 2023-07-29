<?php

namespace CoderStudios\Middleware;

class Manager
{
    protected $except = [
        'admin',
        'admin/media',
        'admin/media/*',
        'admin/posts',
        'admin/posts/*',
        'admin/bookings',
        'admin/bookings/*',
        'admin/slots',
        'admin/slots/*',
    ];

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        if (!auth()->user()->isManager() && !auth()->user()->isAdmin() && $this->inExceptArray($request)) {
            return redirect()->route('home');
        }

        return $next($request);
    }

    /**
     * Determine if the request has a URI that should be accessible in maintenance mode.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    protected function inExceptArray($request)
    {
        foreach ($this->except as $except) {
            if ('/' !== $except) {
                $except = trim($except, '/');
            }

            if ($request->fullUrlIs($except) || $request->is($except)) {
                return true;
            }
        }

        return false;
    }
}
