<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Services\Contracts\AuthInterface;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm(Request $request)
    {
        return view('auth.login');
    }

    public function submitLogin(LoginRequest $request, AuthInterface $auth)
    {
        $routeName = $auth->submitLogin($request->phone_number);
        return redirect(route($routeName));
    }
}
