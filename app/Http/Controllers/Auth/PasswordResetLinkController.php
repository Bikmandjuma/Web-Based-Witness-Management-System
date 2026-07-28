<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    public function create()
    {
        return view('Auth.forgot-password');
    }

    /** Field name matches Auth/forgot-password.blade.php exactly: name="email" */
    public function store(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Always respond the same way whether or not the email exists, so the
        // form can't be used to check which addresses are registered.
        Password::sendResetLink($request->only('email'));

        // The view keys its "check your inbox" success panel off session('status')
        // === 'success', and re-displays the address via old('email').
        return back()->with('status', 'success')->withInput();
    }
}
