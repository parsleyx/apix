<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Closure;

class ApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $requiredHeaders = ['uuid', 'model', 'os-version', 'channel-name', 'package-name'];

        foreach ($requiredHeaders as $header) {
            if (!$request->hasHeader($header)) {
                return response()->json([
                    'code' => 400,
                    'message' => "缺少必需的请求头: {$header}"
                ], 400);
            }
        }

        return $next($request);
    }
}
