<?php

namespace App\Services\Contracts;

use App\Enums\UserStatus;

interface SubmitLoginInterface
{
    public function submitLogin(string $phone_number): UserStatus;
}
