<?php

namespace App\Http\Controllers;

use App\DTOs\RegisterDTO;
use App\Enums\UserStatus;
use App\Exceptions\ExpiredOtpException;
use App\Exceptions\InvalidOtpException;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\OtpRequest;
use App\Http\Requests\Auth\PasswordRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Contracts\CompleteRegisterInterface;
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
        $userStatus = $submitLogin->submitLogin($request->phone_number);
        session(['phone_number' => $request->phone_number]);
        if ($userStatus == UserStatus::EXISTS) {
            return redirect(route('login.password.form', app()->getLocale()));
        } else {
            return redirect(route('register.otp.form', app()->getLocale()));
        }
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

            return redirect(route('home', app()->getLocale()));

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

    public function verifyOtpForm(OtpRequest $request, VerifyOtpInterface $verifyOtp)
    {
        try {
            $verifyOtp->verifyOtp(
                phone_number: session('phone_number'),
                otp: $request->otp
            );

            return redirect(route('register.complete.form', app()->getLocale()));
        } catch (ExpiredOtpException | InvalidOtpException $e) {
            return redirect()->back()->withErrors([
                'otp' => $e->getMessage(),
            ]);
        }
    }

    public function completeRegisterForm(Request $request)
    {
        return view('auth.register');
    }

    public function completeRegister(RegisterRequest $request, CompleteRegisterInterface $completeRegister)
    {
        $registerDto = new RegisterDTO(
            name: $request->name,
            last_name: $request->last_name,
            national_code: $request->national_code,
            phone_number: session('phone_number'),
            password: $request->password
        );

        $user = $completeRegister->completeRegister($registerDto);
        Auth::login($user);
        session()->forget(['phone_number', 'otp_verified']);
        return redirect(route('home', app()->getLocale()));
    }
}
