<?php

namespace App\Services\Contracts;

use App\DTOs\RegisterDTO;
use App\Models\User;

interface CompleteRegisterInterface
{
    public function completeRegister(RegisterDTO $registerDTO):User;
}
