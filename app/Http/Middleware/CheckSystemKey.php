<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSystemKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ambil key dari header request
        $headerKey = $request->header('X-System-Key');

        // Ambil key dari .env
        $validKey = env('SYSTEM_API_KEY');

        if ($headerKey !== $validKey) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized. Invalid system key.'
            ], 401);
        }

        return $next($request);
    }
}
