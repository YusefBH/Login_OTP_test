<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('{locale?}')->middleware('web')->group(function () {

    Route::controller(AuthController::class)->group(function () {
        Route::middleware('guest')->prefix('login')->name('login.')->group(function () {
            Route::get('/', 'showLoginForm')->name('form');
            Route::post('/submit', 'submitLogin')->name('submit');
        });
    });
});
