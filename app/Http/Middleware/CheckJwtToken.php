<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;

class CheckJwtToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            if (!request()->bearerToken() && isset($_COOKIE['jwt_token'])) {
                request()->headers->set('Authorization', 'Bearer ' . $_COOKIE['jwt_token']);
            }

            $user = JWTAuth::parseToken()->authenticate();
            auth()->login($user);
        } catch (Exception $e) {
            return redirect('/login')->with('error', 'You must be logged in.');
        }

        return $next($request);
    }
}
