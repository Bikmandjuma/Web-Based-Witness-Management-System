<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Usage in routes: ->middleware('role:investigator')
     * or for multiple roles: ->middleware('role:investigator,admin')
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user || ! in_array($user->role, $roles, true)) {
            abort(403, 'You are not authorized to access this page.');
        }

        if (! $user->is_active) {
            Auth::logout();
            abort(403, 'Your account has been deactivated. Please contact an administrator.');
        }

        return $next($request);
    }
}
