<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\UserController;
use App\Models\Payment;
use Carbon\Carbon;
use App\Http\Controllers\TestEmailController;

Route::get('/send-test-email', [TestEmailController::class, 'sendTest']);


Route::post('/login', [ApiAuthController::class, 'login']);
Route::post('/logout', [ApiAuthController::class, 'logout']);

Route::post('/user/initial_registration', [UserController::class, 'register']);
Route::post('/user/verify/code_to_register/{email}', [UserController::class, 'verify_code_to_register']);
Route::post('/user/fill_missed_info/{email}', [UserController::class, 'fill_missed_info']);

Route::get('/getVisitCount', [UserController::class, 'getVisitCount']);
Route::post('/incrementVisitCount', [UserController::class, 'incrementVisitCount'])->name('increment.visit.count');
Route::get('/visit/Count/total', [UserController::class, 'getTotalVisits']);

Route::post('/user/forgot-password',[UserController::class,'submit_forgot_password']);

Route::post('/code_to_reset_pswd/{email}',[UserController::class,'code_to_reset_pswd']);

Route::post('/reset/password/{email}/{code}',[UserController::class,'resetPassword']);

//User/Seeker routes
Route::group(['prefix'=>'user' , 'middleware'=>'userAuth'],function(){
    Route::get('/dashboard', [UserController::class, 'dashboard']);
    Route::get('/profile', [UserController::class, 'profile_picture']);
    Route::get('/view_info', [UserController::class, 'View_information']);
    Route::post('/update_info', [UserController::class, 'edit_info']);
    Route::post('/submit_job_category', [UserController::class, 'submitCategories']);
    Route::get('/fetch_user_job_categories', [UserController::class, 'fetch_user_job_Categories']);
    Route::get('/UserCount_job_category', [UserController::class, 'count_job_category']);
    Route::delete('/remove_job_category/{id}', [UserController::class, 'remove_job_category']);
    Route::post('/modify_password', [UserController::class, 'modify_password']);
    // Route::post('/payment-callback', [PaymentController::class, 'handleCallback']);
    
    Route::get('/checkUserAccess',[UserController::class,'checkUserAccess']);
});

    Route::post('/guest/request_advertisment',[UserController::class,'request_advertisment']);
    Route::post('/guest/contact_us',[UserController::class,'contact_us']);

Route::get('/mifotra-proxy', function () {
    $json = file_get_contents('https://recruitment.mifotra.gov.rw/api/recruitment/open-advertisements');
    return response($json)->header('Content-Type', 'application/json');
});

