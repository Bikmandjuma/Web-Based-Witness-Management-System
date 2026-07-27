<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiAuthController extends Controller
{
    // Example function to login and generate token
    public function login(Request $request)
    {
        try {
            // Validate input fields
            $request->validate([
                'username' => 'required|string',
                'password' => 'required|string',
            ], [
                'username.required' => 'The username is required.',
                'password.required' => 'The password is required.',
            ]);

            // Determine if username is email or phone
            $loginField = filter_var($request->input('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

            // Attempt to authenticate with the 'user' guard
            if ($token = Auth::guard('user')->attempt([
                $loginField => $request->input('username'),
                'password' => $request->input('password'),
            ])) {
                $user = Auth::guard('user')->user();

                return response()->json([
                    'status' => 'success',
                    'message' => 'User login successfully!',
                    'user' => $user,
                    'role' => 'user',
                    'authorisation' => [
                        'token' => $token,
                        'type' => 'bearer',
                    ],
                ]);
            }

            // Return error if authentication fails
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Username or Password, try again!',
            ], 401);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors occurred.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            // Log unexpected errors
            \Log::error('Login failed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred. Please try again later.',
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the session token to prevent CSRF attacks
        $request->session()->regenerateToken();

        return response()->json([
            'status' => 'success',
            'message' => 'You have been logged out.'
        ]);
    }
}
