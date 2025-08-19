<?php

namespace App\Services\Actions;

use App\Models\User;
use App\Services\Contracts\SubmitLoginInterface;

class SubmitLoginConcrete implements SubmitLoginInterface
{
    public function submitLogin(string $phone_number): string
    {
        $flag = User::where('phone_number', $phone_number)->exists();

        if ($flag) {
            return 'login.password.form';
        } else {
            return 'register.otp.form';
        }
    }
}
