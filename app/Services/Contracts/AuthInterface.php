<?php

namespace App\Services\Contracts;

interface AuthInterface
{
    public function submitLogin(string $phone_number): string;
}
