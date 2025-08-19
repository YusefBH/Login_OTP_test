<?php

namespace App\Services\Contracts;

interface SubmitLoginInterface
{
    public function submitLogin(string $phone_number): string;
}
