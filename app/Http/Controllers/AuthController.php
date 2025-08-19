<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\OtpRequest;
use App\Http\Requests\Auth\PasswordRequest;
use App\Services\Contracts\SubmitLoginInterface;
use App\Services\Contracts\SubmitPasswordInterface;
use App\Services\Contracts\VerifyOtpInterface;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm(Request $request)
    {
        return view('auth.login');
    }

    public function submitLogin(LoginRequest $request, SubmitLoginInterface $submitLogin)
    {
        $routeName = $submitLogin->submitLogin($request->phone_number);
        session(['phone_number' => $request->phone_number]);
        return redirect(route($routeName, app()->getLocale()));
    }

    public function showPasswordForm(Request $request)
    {
        return view('auth.password');
    }

    public function submitPassword(PasswordRequest $request, SubmitPasswordInterface $submitPassword)
    {
        try {
            $user = $submitPassword->submitPassword(
                phone_number: session('phone_number'),
                password: $request->password
            );
            Auth::login($user);

            return redirect(route('home' , app()->getLocale()));

        } catch (AuthenticationException $e) {

            return back()->withErrors([
                'password' => $e->getMessage(),
            ]);
        }
    }

    public function showOtpForm(Request $request)
    {
        return view('auth.otp');
    }

    public function verifyOtpForm(OtpRequest $request , VerifyOtpInterface $verifyOtp)
    {
        try {
            $verifyOtp->verifyOtp(
                phone_number: session('phone_number'),
                otp: $request->otp
            );

            return redirect(route('register.complete.form' , app()->getLocale()));
        }catch (\Exception $e){
            return redirect()->back()->withErrors([
                'otp' => $e->getMessage(),
            ]);
        }
    }

    public function completeRegisterForm(Request $request)
    {
        return view('auth.register');
    }
}
