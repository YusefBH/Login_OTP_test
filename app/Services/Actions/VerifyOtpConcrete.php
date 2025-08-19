<?php

namespace App\Services\Actions;

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
            throw new \Exception(__('custom.expire_otp'));
        }

        if ($realOtp != $otp) {
            throw new \Exception(__('custom.invalid_otp'));
        }

        Cache::forget('otp:'.$phone_number);
    }
}
