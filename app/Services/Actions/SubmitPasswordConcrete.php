<?php

namespace App\Services\Actions;

use App\Models\User;
use App\Services\Contracts\SubmitPasswordInterface;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;

class SubmitPasswordConcrete implements SubmitPasswordInterface
{
    /**
     * @throws AuthenticationException
     */
    public function submitPassword(string $phone_number, string $password): User
    {
        $user = User::where('phone_number', $phone_number)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            throw new AuthenticationException(__('auth.failed'));
        }
        return $user;
    }
}
