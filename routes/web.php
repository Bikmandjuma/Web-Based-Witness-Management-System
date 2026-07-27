<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\WebAuthController;
use App\Http\Controllers\Web\AdminController;
use App\Http\Controllers\Web\GuestController;
use Illuminate\Support\Facades\Http;

Route::group(['prefix'=>'owner' , 'middleware'=>'ownerAuth','throttle:100,1'],function(){
    
    Route::get('/dashboard', [AdminController::class, 'home'])->name('owner.dashboard');
    
    Route::get('/view_info', [AdminController::class, 'View_information']);
    
    Route::get('/count_seekers', [AdminController::class, 'count_seekers']);
    
    Route::get('/count_seekers_today', [AdminController::class, 'count_seekers_today']);
    
    Route::post('/update_password', [AdminController::class, 'update_password']);
    
    Route::post('/update_info', [AdminController::class, 'edit_info']);
    
    Route::post('/logout', [WebAuthController::class, 'logout'])->name('owner.logout');
    
    Route::get('/display_paid_users', [AdminController::class, 'display_paid_users'])->name('owner.display_paid_users');

    Route::get('/view_all_users',[AdminController::class,'view_all_users'])->name('owner.view_all_users');

    Route::get('/view_all_users_joined_today',[AdminController::class,'view_all_users_joined_today'])->name('owner.view_all_users_joined_today');
    
    Route::get('/search_users_payment', [AdminController::class, 'search_users_payment'])->name('owner.search_users_payment');

    Route::get('/assign_payment_ToUser/{id}', [AdminController::class, 'assign_payment_ToUser'])->name('owner.assign_payment_ToUser');

    Route::post('/submit_payment_ToUser/{id}', [AdminController::class, 'submit_payment_ToUser'])->name('owner.submit_payment_ToUser');
});
Route::get('/refresh_counts', [AdminController::class, 'refresh_counts'])->name('owner.refresh_counts');

Route::get('/login', [WebAuthController::class, 'login_form'])->name('owner.login');
Route::post('/submit_login', [WebAuthController::class, 'submit_login'])->name('owner.submit.login');

// routes/web.php
// Route::get('/proxy/env', function () {
//     $response = Http::get('https://recruitment.mifotra.gov.rw/api/recruitment/open-advertisements');
//     return response($response->body(), $response->status())
//         ->header('Content-Type', $response->header('Content-Type'));
// });

// Route::get('/proxy/env', function () {
//     $response = Http::withHeaders([
//         'Accept-Encoding' => 'gzip, deflate',
//         'Accept' => 'application/json'
//     ])->get('https://recruitment.mifotra.gov.rw/api/recruitment/open-advertisements');

//     return $response->json(); // this will parse JSON if available
// });

// Route::get('/proxy/env', function () {
//     $raw = Http::get('https://recruitment.mifotra.gov.rw/api/recruitment/open-advertisements')->body();

//     // try decompressing
//     $decoded = @gzdecode($raw);

//     return response($decoded ?: $raw)
//         ->header('Content-Type', 'application/json');
// });

Route::get('/proxy/env', function () {
    $response = Http::withHeaders([
        'Accept-Encoding' => 'gzip, deflate',
        'Accept' => 'application/json',
    ])->get('https://recruitment.mifotra.gov.rw/api/recruitment/open-advertisements');

    // get raw binary
    $raw = $response->getBody()->getContents();

    // decompress gzip
    $decoded = @gzdecode($raw);

    if ($decoded === false) {
        return response()->json(['error' => 'Failed to decompress API response']);
    }

    // parse JSON
    $json = json_decode($decoded, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        return response()->json(['error' => 'Failed to parse JSON']);
    }

    return response()->json($json);
});

Route::get('/forgot-password', [WebAuthController::class, 'forgot_password'])->name('guest.forgot-password');
Route::post('submit-forgot-password',[WebAuthController::class, 'submit_forgot_password'])->name('guest.submit-forgot-password');


Route::get('/', [GuestController::class, 'home'])->name('guest.home');
Route::get('/ibitabo', [GuestController::class, 'books'])->name('guest.books');
Route::get('/abasheikh', [GuestController::class, 'teachers'])->name('guest.teachers');
Route::get('/amatangazo', [GuestController::class, 'news'])->name('guest.news');
Route::get('/inyandiko-zabamenyi', [GuestController::class, 'inyandiko_zabamenyi'])->name('guest.inyandiko_zabamenyi');
Route::get('/shakisha', [GuestController::class, 'search'])->name('guest.search');
Route::get('/inyigisho-zabasheikh', [GuestController::class, 'teacher_darsa'])->name('guest.teacher-darsa');

Route::get('/live-visits', [GuestController::class, 'liveVisits'])->name('guest.live.visits');