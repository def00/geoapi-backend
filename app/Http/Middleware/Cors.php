<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Response;


class Cors
{
    private const HEADERS = [
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
        'Access-Control-Allow-Headers' => 'Content-Type, Origin, Authorization, Access-Control-Allow-Headers, Cache-Control, X-Requested-With',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->getMethod() === 'OPTIONS') {
            return Response::make('OK', 200, self::HEADERS);
        }

        $response = $next($request);

        foreach (self::HEADERS as $header => $value) {
            $response->header($header, $value);
        }

        return $response;
    }
}
