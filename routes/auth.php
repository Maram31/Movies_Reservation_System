<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;


// guest routes: do not need any authentication
Route::group(['middleware' => 'guest'], function(){

//register form
Route::get('/register', [RegisteredUserController::class, 'create'])
                ->name('register');
//login form
 Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

Route::post('/register', [RegisteredUserController::class, 'store']);


Route::post('/login', [AuthenticatedSessionController::class, 'store']);

});


// authenticated user type: customer
Route::group(['middleware' => 'auth'], function(){
    
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});

// authenticated user routes , type: manager
Route::group(['middleware' => 'manager-auth'], function(){

    // TO DO 
    Route::post('/manager-logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
});

// authenticated user routes ,type: site admin
Route::group(['middleware' => 'admin-auth'], function(){

        // TO DO 
        Route::post('/admin-logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});