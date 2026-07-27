<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Owner;
use App\Models\User;

class WebAuthController extends Controller
{
    public function login_form()
    {
        return view('Auth.login');
    }

    public function forgot_password()
    {
        return view('Auth.forgot-password');
    }

    public function submit_login(Request $request){

            $request->validate([
                'username' => 'required|string',
                'password' => 'required|string',
            ], [
                'username.required' => 'nta imeyili cga nimero ya telefone wanditse.',
                'password.required' => 'nta mubarebanga wanditse.',
            ]);

            $loginField = filter_var($request->input('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

            if (Auth::guard('owner')->attempt([
                $loginField => $request->input('username'),
                'password' => $request->input('password'),
            ])) {
                $request->session()->regenerate();
                
                return redirect()->route('owner.dashboard')->with('info', 'Welcome '.Auth::guard('owner')->user()->firstname);
            }

            return back()->with([
                'error' => 'Invalid username/password, try again !',
            ]);

    }

    public function submit_forgot_password(Request $request){
        try {
            // Validate email input
            $request->validate([
                'email' => 'required|email',
            ], [
                'email.required' => 'Nta imeyili wanditse !',
                'email.email' => 'Andika imeyili yanyayo !',
            ]);

            $email = $request->input('email');

            // Check if email exists in Admins or Users table
            $existsInAdmins = Owner::where('email', $email)->exists();
            $existsInUsers = User::where('email', $email)->exists();

            if (!$existsInAdmins && !$existsInUsers) {
                return back()->with([
                    'status' => 'error',
                    'message' => 'Imeyili ntibonetse mububiko !',
                ], 404); // Not Found
            }

            // Delete all previous reset codes for this email
            ResetCodePassword::where('email', $email)->delete();

            // Generate a new reset code
            $data = [
                'email' => $email,
                'code'  => mt_rand(100000, 999999),
            ];

            // Create a new reset code record
            $reset_data = ResetCodePassword::create($data);

            // Render Blade template to HTML
            $html = view('emails.send-code-reset-password', ['code' => $reset_data->code])->render();

            // Send reset code via SendGrid
            SendGridService::send(
                $reset_data->email,
                'Reset password',
                $html
            );

            return back()->with([
                'status' => 'success',
                'reset_code' => 'kode yoherejwe kuri imeyili.',
            ]); // OK

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation exceptions
            return back()->with([
                'status'  => 'error',
                'message' => 'Validation errors occurred.',
                'errors'  => $e->errors(),
            ]); // Unprocessable Entity
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Forgot password failed: ' . $e->getMessage());

            // Handle any other exceptions
            return back()->with([
                'status'  => 'error',
                'message' => 'An error occurred while processing your request. ' . $e->getMessage(),
            ]); // Internal Server Error
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('owner')->logout();

        // Invalidate the session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('owner.login')->with('info', 'You have been logged out.');
    }

}
