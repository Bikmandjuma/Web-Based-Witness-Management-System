<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('Auth.register');
    }

    /**
     * Field names match Auth/register.blade.php exactly:
     * name="name", name="email", name="phone", name="password", name="password_confirm", name="terms"
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:100',
            'email'            => 'required|string|email|max:100|unique:' . User::class,
            'phone'            => 'required|string|max:15',
            'password'         => ['required', 'string', Rules\Password::min(8)->mixedCase()->numbers()],
            'password_confirm' => 'required|string',
            'terms'            => 'required|accepted',
        ], [
            'terms.required' => 'You must confirm the details you submit are accurate.',
        ]);

        if ($validated['password'] !== $validated['password_confirm']) {
            return back()->withErrors(['password_confirm' => 'Passwords do not match.'])->withInput();
        }

        $user = User::create([
            'full_name' => $validated['name'],
            'name'      => $validated['name'],
            'email'     => $validated['email'],
            'phone'     => $validated['phone'],
            'password'  => Hash::make($validated['password']),
            // role defaults to 'witness' via the migration
        ]);

        event(new Registered($user));

        ActivityLog::record('user_registered', "{$user->full_name} created a witness account");

        Auth::login($user);

        return redirect()->route('witness.dashboard')
            ->with('status', 'Welcome to Umutekano! You can report a crime whenever you\'re ready.');
    }
}
