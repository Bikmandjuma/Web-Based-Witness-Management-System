<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UpdateLastActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next , $guard = null): Response
    {
        if (Auth::guard('user')->check()) {
            $user = Auth::guard('user')->user();
            $user->update(['last_active_at' => now()]);

            // Log to check if middleware is running
            Log::info('User last_active_at updated', ['user_id' => $user->id, 'time' => now()]);
        } else {
            Log::warning('Middleware executed but user not authenticated');
        }
        return $next($request);
    }
}
