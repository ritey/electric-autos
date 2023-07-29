<?php

namespace CoderStudios\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LogRoute
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
        $response = $next($request);

        if (config('logging.log_routes')) {
            $log = [
                '======== LogRoute ========' => '================',
                'SERVER' => $_SERVER,
                'URI' => $request->getUri(),
                'METHOD' => $request->getMethod(),
                'REQUEST_BODY' => $request->all(),
                'RESPONSE' => $response->getContent(),
                '======== LogRoute ========' => '================',
            ];

            Log::info(json_encode($log));
        }

        return $response;
    }
}
