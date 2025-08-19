<?php

namespace App\Services\Actions;

use App\DTOs\RegisterDTO;
use App\Models\User;
use App\Services\Contracts\CompleteRegisterInterface;

class CompleteRegisterConcrete implements CompleteRegisterInterface
{

    public function completeRegister(RegisterDTO $registerDTO): User
    {
        return User::create([
            'name' => $registerDTO->name,
            'last_name' => $registerDTO->last_name,
            'national_code' => $registerDTO->national_code,
            'phone_number' => $registerDTO->phone_number,
            'password' => $registerDTO->password,
        ]);
    }
}
