<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\PasswordRequest;
use App\Services\Contracts\SubmitLoginInterface;
use App\Services\Contracts\SubmitPasswordInterface;
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
}
