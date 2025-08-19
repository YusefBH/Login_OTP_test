<?php

namespace App\Services\Actions;

use App\Exceptions\ExpiredOtpException;
use App\Exceptions\InvalidOtpException;
use App\Services\Contracts\VerifyOtpInterface;
use Exception;
use Illuminate\Support\Facades\Cache;

class VerifyOtpConcrete implements VerifyOtpInterface
{
    /**
     * @throws Exception
     */
    public function verifyOtp(string $phone_number, string $otp): void
    {
        $realOtp = Cache::get('otp:'.$phone_number);

        if (!$realOtp) {
            throw new ExpiredOtpException(__('custom.expire_otp'));
        }

        if ($realOtp != $otp) {
            throw new InvalidOtpException(__('custom.expire_otp'));
        }

        Cache::forget('otp:'.$phone_number);

        session()->put('otp_verified', true);
    }
}
