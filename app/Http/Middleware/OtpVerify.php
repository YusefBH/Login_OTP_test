<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OtpVerify
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('otp_verified')) {
            return redirect()->route('login.form', ['locale' => app()->getLocale()]);
        }
        return $next($request);
    }
}
