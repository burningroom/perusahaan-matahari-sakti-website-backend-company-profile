<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->hasHeader('X-API-KEY')) {
            return response()->json([
                'status' => 'error',
                'message' => 'API Key is missing from header'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $apiKey = $request->header('X-API-KEY');
        $validApiKey = config('app.api.app_api_key');

        // Log::info('api key', [
        //     'server' => $apiKey,
        //     'valid' => $validApiKey
        // ]);
        if ($apiKey !== $validApiKey) {
            // Log::info('api key not valid', [
            //     'server' => $apiKey,
            //     'valid' => $validApiKey
            // ]);
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid API Key'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);

    }
}
