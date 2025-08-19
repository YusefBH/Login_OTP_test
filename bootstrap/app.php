<?php

use App\Http\Middleware\OtpVerify;
use App\Http\Middleware\PersianToEnglish;
use App\Http\Middleware\SetLocale;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo(fn() => route('login.form', ['locale' => app()->getLocale() ?: 'fa']));
        $middleware->redirectUsersTo(fn() => route('home', ['locale' => app()->getLocale() ?: 'fa']));


        $middleware->appendToGroup('web', SetLocale::class);
        $middleware->appendToGroup('web', PersianToEnglish::class);
        $middleware->alias(['otp.verified' => OtpVerify::class]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
