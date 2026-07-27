<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Owner;
use App\Models\Payment;
use App\Models\SeekerContactUs;
use App\Models\RequestForAdvertisement;
use Carbon\Carbon;
use App\Models\CodeToRegister;
use App\Models\JobCategory;
use App\Mail\CodeToRegisterMail;
use App\Mail\newSeekerRegisteredMail;
use App\Models\Visit;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Models\ResetCodePassword;
use App\Mail\SendCodeResetPasswordMail;
use Illuminate\Support\Facades\Validator;
use App\Services\SendGridService;

class UserController extends Controller
{

    // public function register(Request $request){
    //     try {
    //         // Validate request data
    //         $validatedData = $request->validate([
    //             'user_name' => 'required|string|max:255',
    //             'email' => 'required|email|max:100|unique:users,email|unique:owners,email',
    //             'phone' => [
    //                 'required',
    //                 'numeric',
    //                 'digits:10',
    //                 'unique:users,phone',
    //                 'unique:owners,phone',
    //                  'regex:/^(072|078|073|079)\d{7}$/',
    //             ],
    //         ]);

    //         // Create seeker_code logic...
    //         $lastUserCode = DB::table('users')->max('user_code');
    //         if ($lastUserCode) {
    //             preg_match('/\d+$/', $lastUserCode, $matches);
    //             $sequenceNumber = isset($matches[0]) ? (int)$matches[0] + 1 : 1;
    //         } else {
    //             $sequenceNumber = 1;
    //         }

    //         $prefix = date('y');
    //         $middle = 'JSR';
    //         $formattedNumber = str_pad($sequenceNumber, 5, '0', STR_PAD_LEFT);
    //         $seeker_code = $prefix . $middle . $formattedNumber;

    //         // Create the user
    //         $user = User::create([
    //             'user_code' => $seeker_code,
    //             'provider_name' => 'Usual_reg',
    //             'user_name' => $request->user_name,
    //             'email' => $request->email,
    //             'phone' => $request->phone,
    //         ]);

    //         // Log the  user creation for debugging
    //         \Log::info('User created: ' . $user->id);

    //         // Log the successful token creation
    //         $token = Auth::guard('user')->login($user);
    //         \Log::info('Auth token generated: ' . $token);

    //         // Delete old codes for this email
    //         CodeToRegister::where('email', $user->email)->delete();

    //         // Generate a new verification code
    //         $data = [
    //             'email' => $user->email,
    //             'code' => mt_rand(100000, 999999),
    //         ];

    //         // Store the new code in the database
    //         $got_data = CodeToRegister::create($data);

    //         // Send the email with the verification code
    //         // Mail::to($user->email)->send(new CodeToRegisterMail($got_data->email,$got_data->code));
            
    //         $email = $got_data->email;
            
    //         $code = $got_data->code;

    //         // Render Blade template to HTML
    //         $html = view('emails.code_to_register', ['code' => $code])->render();

    //         // Send reset code via SendGrid
    //         SendGridService::send(
    //             $reset_data->$email,
    //             'Code to Register',
    //             $html
    //         );

    //         // Return response
    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'User created successfully',
    //             'user' => $user,
    //             'authorisation' => [
    //                 'token' => $token,
    //                 'type' => 'bearer',
    //             ]
    //         ]);
            
    //     } catch (\Illuminate\Validation\ValidationException $e) {
    //         // Return validation errors as JSON response
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Validation errors occurred.',
    //             'errors' => $e->errors() // This will return the validation error details
    //         ], 422);
    //     } catch (\Exception $e) {
    //         // Log the error to Laravel logs
    //         \Log::error('Registration failed: ' . $e->getMessage());

    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Registration failed. ' . $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function register(Request $request)
    {
        try {
            // Validate request data
            $validatedData = $request->validate([
                'user_name' => 'required|string|max:255',
                'email' => 'required|email|max:100|unique:users,email|unique:owners,email',
                'phone' => [
                    'required',
                    'numeric',
                    'digits:10',
                    'unique:users,phone',
                    'unique:owners,phone',
                    'regex:/^(072|078|073|079)\d{7}$/',
                ],
            ]);

            // Generate user code
            $lastUserCode = DB::table('users')->max('user_code');
            $sequenceNumber = $lastUserCode ? (int) preg_replace('/\D/', '', $lastUserCode) + 1 : 1;
            $prefix = date('y');
            $middle = 'JSR';
            $formattedNumber = str_pad($sequenceNumber, 5, '0', STR_PAD_LEFT);
            $seeker_code = $prefix . $middle . $formattedNumber;

            // Create the user
            $user = User::create([
                'user_code' => $seeker_code,
                'provider_name' => 'Usual_reg',
                'user_name' => $request->user_name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            // Generate auth token
            $token = Auth::guard('user')->login($user);

            // Delete old codes for this email
            CodeToRegister::where('email', $user->email)->delete();

            // Generate a new verification code
            $data = [
                'email' => $user->email,
                'code' => mt_rand(100000, 999999),
            ];

            // Store the code
            $got_data = CodeToRegister::create($data);

            // Render HTML from Blade
            $html = view('emails.code_to_register', ['code' => $got_data->code])->render();

            // Send via SendGrid
            SendGridService::send(
                $got_data->email,
                'Code to Register',
                $html
            );

            // Return response
            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors occurred.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Registration failed: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Registration failed. ' . $e->getMessage()
            ], 500);
        }
    }


    // Start of fill missed info
    public function fill_missed_info(Request $request, $email){

        try {

            $validated = $request->validate([
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'gender' => 'required|string',
                'birthdate' => 'required|date',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $user = User::where('email', $email)->first();

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found',
                ], 404);
            }

            $user->firstname = $validated['firstname'];
            $user->lastname = $validated['lastname'];
            $user->gender = $validated['gender'];
            $user->birthdate = $validated['birthdate'];
            $user->image = 'user.png';
            $user->password = bcrypt($validated['password']);
            $user->save();

            $my_system_email = "jobsphererwanda@gmail.com";
            $count_users = collect(User::all())->count();

            Mail::to($my_system_email)->send(new newSeekerRegisteredMail($user->firstname, $user->lastname,$user->gender,$email,$user->birthdate,$count_users));

            $token = Auth::guard('user')->login($user);

            \Log::info('User updated: ', ['user' => $user]);

            return response()->json([
                'status' => 'success',
                'message' => 'User updated successfully',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ],

            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors occurred.',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {

            \Log::error('Update failed: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Update failed. ' . $e->getMessage()
            ], 500);

        }

    }
    // End of fill-missed-info


    public function View_information(){
        $user = Auth::guard('user')->user();

        if ($user) {

            return response()->json([
                'status' => 'Auth user info',
                'user_info' => $user
            ], 200);

        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }


    public function edit_info(Request $request){

        try {
        
            $userId = Auth::guard('user')->user()->id;

            $validatedData = $request->validate([
                'user_name' => 'required|string|max:255',
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'gender' => 'required|string|max:255',
                'phone' => [
                    'required',
                    'numeric',
                    'digits:10',
                    'regex:/^(072|078|073|079)\d{7}$/',
                    'unique:users,phone,' . $userId,
                    'unique:owners,phone,',
                ],
                    'email' => [
                    'required',
                    'email',
                    'unique:users,email,' . $userId,
                    'unique:owners,email,' . $userId,
                ],
                    'birthdate' => [
                    'required',
                    'date',
                ],

            ]);

            $user = User::find($userId);

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found.'
                ], 404);
            }

            $user->update($validatedData);

            return response()->json([
                'status' => 'success',
                'message' => 'Data updated successfully!',
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
        
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors occurred.',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            
            \Log::error('Error occurred while editing user info: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred. Please try again later.',
            ], 500);
        
        }
        
    }


    public function profile_picture(){
        return 'profile public';
    }


    public function verify_code_to_register(Request $request, $email){
        try{
            // Validate the code input
            $request->validate([
                'code' => 'required|numeric|digits:6' // Ensure a 6-digit code is required
            ]);

            // Check if the code is in an array and implode if so
            if (is_array($request->code)) {
                $code = implode('', $request->code);
            } else {
                $code = $request->code;
            }

            // Check if the code exists in the database for the given email
            $register_Code = CodeToRegister::where('email', $email)->where('code', $code)->first();

            if ($register_Code) {
                // Check if the code is older than one hour
                if ($register_Code->created_at->diffInMinutes(now()) > 60) {
                    // Code expired
                    $register_Code->delete();
                    return response()->json(['error' => 'Your code is expired!'], 400);
                } else {
                    // Code is valid, delete the code after use
                    $register_Code->delete();
                    return response()->json(['info' => 'Code is valid , Now fill missed info!'], 200);
                }
            
            }else {
                // Invalid code
                return response()->json([
                    'status' => 'error',
                    'message' => 'The code is not valid. Please try again.',
                ], 400);
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors occurred.',
                'error' => $e->errors(),
            ], 422); // Unprocessable Entity
        } catch (\Exception $e) {
            \Log::error('Code verification failed: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while processing your request. ' . $e->getMessage(),
            ], 500); // Internal Server Error
        }

    }

    public function submitCategories(Request $request){

        // Validate that 'selectedItems' is provided and is an array
        $validated = $request->validate([
            'selectedItems' => 'required|array',
        ]);

        // Retrieve the selected categories from the request
        $selectedCategories = $request->input('selectedItems');
        
        // Set the user ID (hardcoded for now)
        $userId = Auth::guard('user')->user()->id;

        // Check if user is authenticated (this part is optional if user ID is set)
        if (!$userId) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        // Array of categories that are already stored
        $storedCategories = [];

        // Check if selectedCategories is an array before using foreach
        if (is_array($selectedCategories)) {
            foreach ($selectedCategories as $category) {
                $existingCategory = JobCategory::where('category_name', $category)
                                                ->where('user_fk_id', $userId)
                                                ->first();

                if (!$existingCategory) {
                    JobCategory::create([
                        'category_name' => $category,
                        'user_fk_id' => $userId
                    ]);

                    // Add the new category to the storedCategories array
                    $storedCategories[] = $category;
                }
            }

            return response()->json([
                'message' => 'Job categories submitted successfully',
                'storedCategories' => $storedCategories
            ]);
        } else {
            return response()->json(['message' => 'Selected categories must be an array'], 400);
        }
    }

    public function fetch_user_job_Categories()
    {

        $userId = Auth::guard('user')->user()->id;

        $jobCategories = JobCategory::where('user_fk_id', $userId)
                                     ->select('id', 'category_name as skills')
                                     ->get();

        return response()->json([
            'category_names' => $jobCategories
        ]);

        
    }

    public function count_job_category(){
        $userId = Auth::guard('user')->user()->id;

        $jobCategories = JobCategory::where('user_fk_id', $userId)
                                     ->pluck('category_name');

        $count_jobCategories = collect($jobCategories)->count();

        return response()->json([
            'count_categories' => $count_jobCategories
        ]);
        
    }

    public function removeJobCategory($categoryId){

        $userId = Auth::guard('user')->user()->id;
        
        $category = JobCategory::where('id', $categoryId)
                               ->where('user_fk_id', $userId)
                               ->first();

        if ($category) {
            $category->delete();
            return response()->json(['message' => 'Category removed successfully'], 200);
        } else {
            return response()->json(['error' => 'Category not found or unauthorized'], 404);
        }
    }


    public function remove_job_category(Request $request,$id){
        $userId = Auth::guard('user')->user()->id;

        $RemovejobCategories = JobCategory::where('user_fk_id', $userId)
                                ->where('id', $id)
                                ->delete();

        if($RemovejobCategories){
            return response()->json([
                'success' => "category removed !"
            ]);
        }else{
            return response()->json([
                'error' => "Error to remove category ,try again !"
            ]);
        }
        
    }

    public function getVisitCount()
    {
        $today = now()->toDateString();
        $visit = Visit::where('date', $today)->first();
        $count = $visit ? $visit->count : 0;
        return response()->json(['count' => $this->formatNumber($count)]);
    }

    public function getTotalVisits()
    {
        $total = Visit::sum('count');
        return response()->json(['total' => $this->formatNumber($total)]);
    }

    private function formatNumber($number)
    {
        if ($number >= 1000000000) {
            return round($number / 1000000000, 1) . 'B';
        } elseif ($number >= 1000000) {
            return round($number / 1000000, 1) . 'M';
        } elseif ($number >= 1000) {
            return round($number / 1000, 1) . 'k';
        }

        return $number;
    }

    public function incrementVisitCount()
    {
        $today = now()->toDateString();

        $visit = Visit::where('date', $today)->first();

        if (!$visit) {
            Visit::create([
                'count' => 1,
                'date' => $today,
            ]);
        } else {
            $visit->increment('count');
        }

        return response()->json(['message' => 'Visit count incremented']);
    }

    public function modify_password(Request $request){

        try {
            
            $request->merge([
                'current_password' => trim($request->current_password),
                'new_password' => trim($request->new_password),
                'confirm_new_password' => trim($request->confirm_new_password),
            ]);

            $validator = Validator::make($request->all(), [
                'current_password' => 'required|string',
                'new_password' => 'required|string|between:8,32|same:confirm_new_password',
                'confirm_new_password' => 'required|string',
            ]);

            if ($validator->fails()) {
                throw new \Illuminate\Validation\ValidationException($validator);
            }

            $user = auth()->guard('user')->user();

            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Current password does not match.',
                ], 401);
            }

            $user->password = Hash::make($request->new_password);
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Password changed successfully.',
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors occurred.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Password update failed: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Update failed. ' . $e->getMessage(),
            ], 500);
        }
        
    }

    public function submit_forgot_password(Request $request)
    {
        try {
            // Validate email input
            $request->validate([
                'email' => 'required|email',
            ], [
                'email.required' => 'Please enter an email!',
                'email.email' => 'Please enter a valid email address!',
            ]);

            $email = $request->input('email');

            // Check if email exists in Admins or Users table
            $existsInAdmins = Owner::where('email', $email)->exists();
            $existsInUsers = User::where('email', $email)->exists();

            if (!$existsInAdmins && !$existsInUsers) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'The email doesn\'t exist in our database!',
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

            return response()->json([
                'status' => 'success',
                'message' => 'A reset code has been sent to your email.',
            ], 200); // OK

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation exceptions
            return response()->json([
                'status'  => 'error',
                'message' => 'Validation errors occurred.',
                'errors'  => $e->errors(),
            ], 422); // Unprocessable Entity
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Forgot password failed: ' . $e->getMessage());

            // Handle any other exceptions
            return response()->json([
                'status'  => 'error',
                'message' => 'An error occurred while processing your request. ' . $e->getMessage(),
            ], 500); // Internal Server Error
        }
    }


    public function code_to_reset_pswd(Request $request, $email){

        try {
            // Validate the code
            $request->validate([
                'code' => 'required|numeric|digits:6',
            ]);

            $code = $request->input('code'); // Get code from body

            // Find the registered code from the database
            $register_Code = ResetCodePassword::where('email', $email)->where('code', $code)->first();

            if ($register_Code) {
                // Check if the code is expired (older than 60 minutes)
                if ($register_Code->created_at->diffInMinutes(now()) > 60) {
                    $register_Code->delete();
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Your code is expired.',
                    ], 400);
                } else {
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Code is valid, reset password now!',
                    ], 200);
                }
            } else {
                // Invalid code
                return response()->json([
                    'status' => 'error',
                    'message' => 'The code is not valid. Please try again.',
                ], 400);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors occurred.',
                'errors' => $e->errors(),
            ], 422); // Unprocessable Entity
        } catch (\Exception $e) {
            \Log::error('Code verification failed: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while processing your request. ' . $e->getMessage(),
            ], 500); // Internal Server Error
        }
    
    }

    public function resetPassword(Request $request,$email,$code){

        try {

            $request->validate([
                'password' => 'required|string|min:8|confirmed',
            ]);

            $password = $request->password;

            $passwordResetCode = ResetCodePassword::where('code', $code)
                ->where('email', $email)
                ->first();

            if (!$passwordResetCode) {

                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid or expired reset code.',
                ], 400);

            }

            $user = User::where('email', $passwordResetCode->email)->first();
            $admin = Owner::where('email', $passwordResetCode->email)->first();

            if ($user) {
            
                $user->update(['password' => bcrypt($password)]);
                $passwordResetCode->delete();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Password updated successfully!',
                ], 200);
            } elseif ($admin) {
                
                $admin->update(['password' => bcrypt($password)]);
                $passwordResetCode->delete();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Password updated successfully!',
                ], 200);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Email\'s owner not found.',
            ], 404);

        } catch (\Illuminate\Validation\ValidationException $e) {
  
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors occurred.',
                'error' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            
            \Log::error('Password reset failed: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while processing your request. ' . $e->getMessage(),
            ], 500);
        }

    }

    public function checkUserAccess(){
        try {
            // Get the authenticated user ID
            $user_id = Auth::guard('user')->user()->id;
            // $user_id = $id;

            // Check if a user is authenticated
            if (!$user_id) {
                return response()->json([
                    'message' => 'No user found in system!',
                ], 401);  // 401 for unauthenticated user error code
            }

            // Perform an inner join to check if the user has payments
            $payment = Payment::join('users', 'users.id', '=', 'payments.user_id')
                ->where('payments.user_id', $user_id)
                ->orderBy('payments.created_at', 'desc')
                ->select('payments.*')
                ->first();

            // If no payment record exists for the user
            if (!$payment) {
                return response()->json([
                    'status' => 'noPayment',
                    'message' => 'No payment found. Please make a payment.',
                ], 400);
            }

            // If a payment record is found, check if it is valid
            $currentDate = Carbon::today(); // Get today's date

            // Check the start and end date of the payment
            $startDate = Carbon::parse($payment->start_date)->startOfDay();
            $endDate = Carbon::parse($payment->end_date)->endOfDay();

            // Debug: Output the payment start and end dates
            \Log::info('Payment Start Date: ' . $startDate->toDateString());
            \Log::info('Payment End Date: ' . $endDate->toDateString());

            // Check if the current date is within the start and end date of the payment
            if ($currentDate->between($startDate, $endDate)) {
                // Debug: Output a success message when access is granted
                \Log::info('Access Granted');
                return response()->json([
                    'status' => 'paid',
                    'message' => 'Access granted!',
                    'start_date' => $startDate->toDateString(),
                    'end_date' => $endDate->toDateString(),
                ]);
            }

            // If the payment is expired
            return response()->json([
                'status' => 'overdue',
                'message' => 'Access expired. Please renew payment.',
            ], 403);

        } catch (\Exception $e) {
            // Catch any exceptions and log the error
            \Log::error('Error in checkUserAccess: ' . $e->getMessage());

            // Return a generic error message with status 500 (Internal Server Error)
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong. Please try again later.',
            ], 500);
        }

    }

    // Start of send request ads
    public function request_advertisment(Request $request){

        try {
            // Validate request
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'description' => 'required|string',
            ]);

            // Store data using mass assignment
            RequestForAdvertisement::create($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Request sent successfully',
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors occurred.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Submission failed: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }
    // End of request ads   


    #start of contact us
    public function contact_us(Request $request){

        try {
            // Validate request
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'subject' => 'required|string',
                'message' => 'required|string',
            ]);

            // Store data using mass assignment
            SeekerContactUs::create($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Message sent !',
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors occurred.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Submission failed: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }

    #end of contact us 

}
