<?php

namespace CoderStudios\Middleware;

use Illuminate\Http\Request;

class HSTS
{
    public function handle(Request $request, \Closure $next)
    {
        $response = $next($request);

        // $response->header('Strict-Transport-Security', 'max-age=600; includeSubdomains'); // 10 minutes
        $response->header('Strict-Transport-Security', 'max-age=31536000; includeSubdomains'); // 1 year

        return $response;
    }
}
