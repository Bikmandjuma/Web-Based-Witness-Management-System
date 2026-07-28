<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('Auth.login');
    }

    /**
     * Field names match Auth/login.blade.php exactly:
     * name="username" (accepts an email OR a phone number), name="password", name="remember"
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Enter the email or phone number linked to your account.',
            'password.required' => 'Enter your password to continue.',
        ]);

        $throttleKey = Str::lower($request->input('username')) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            throw ValidationException::withMessages([
                'username' => "Too many login attempts. Please try again in {$seconds} seconds.",
            ]);
        }

        $loginField = filter_var($request->input('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $credentials = [
            $loginField => $request->input('username'),
            'password'  => $request->input('password'),
        ];

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            RateLimiter::hit($throttleKey, 60);

            throw ValidationException::withMessages([
                'username' => 'These credentials do not match our records.',
            ]);
        }

        RateLimiter::clear($throttleKey);
        $request->session()->regenerate();

        $user = Auth::user();

        if (! $user->is_active) {
            Auth::logout();
            throw ValidationException::withMessages([
                'username' => 'Your account has been deactivated. Please contact an administrator.',
            ]);
        }

        ActivityLog::record('login', "{$user->full_name} logged in");

        return match ($user->role) {
            'witness'      => redirect()->intended(route('witness.dashboard')),
            'investigator' => redirect()->intended(route('investigator.dashboard')),
            'admin'        => redirect()->intended(route('admin.dashboard')),
        };
    }

    public function destroy(Request $request)
    {
        ActivityLog::record('logout', (Auth::user()->full_name ?? 'A user') . ' logged out');

        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('guest.home');
    }
}
