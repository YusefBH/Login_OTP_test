<?php

namespace App\Services\Contracts;

interface VerifyOtpInterface
{
    public function verifyOtp(string $phone_number, string $otp):void;
}
