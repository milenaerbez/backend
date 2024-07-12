<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Exception;
use Illuminate\Support\Facades\Log;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            //    Log::info("User je " . $user);
            if ($user->role === 'user' || $user->role === 'admin') {
                return $next($request);
            } else {
                return response()->json(['error' => 'Unauthorized. Only users can access this route.'], 403);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Unauthorized. Invalid token.'], 401);
        }
    }
}
