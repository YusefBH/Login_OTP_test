<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('{locale?}')->middleware('web')->group(function () {

    Route::controller(AuthController::class)->group(function () {
        Route::middleware('guest')->prefix('login')->name('login.')->group(function () {
            Route::get('/', 'showLoginForm')->name('form');
            Route::post('/submit', 'submitLogin')->name('submit');
            Route::get('/password', 'showPasswordForm')->name('password.form');
            Route::post('/password', 'submitPassword')->name('password.submit');
        });

        Route::middleware('guest')->prefix('register')->name('register.')->group(function () {
            Route::get('/show-otp', 'showOtpForm')->name('otp.form');
            Route::post('/verify-otp', 'verifyOtpForm')->name('otp.verify');
            Route::get('/complete', 'completeRegisterForm')->name('complete.form');
            Route::post('/complete', 'completeRegister')->name('complete');
        });

    });

    Route::middleware('auth')->group(function () {
        Route::get('/home', function () {
            return 'home';
        })->name('home');
    });
});
