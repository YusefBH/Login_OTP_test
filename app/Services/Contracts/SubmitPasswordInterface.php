<?php

namespace App\Services\Contracts;

use App\Models\User;

interface SubmitPasswordInterface
{
    public function submitPassword(string $phone_number , string $password):User;
}
