<?php

namespace App\Services\Actions;

use App\Enums\UserStatus;
use App\Jobs\SendOtpSmsJob;
use App\Models\User;
use App\Services\Contracts\SubmitLoginInterface;
use Illuminate\Support\Facades\Cache;

class SubmitLoginConcrete implements SubmitLoginInterface
{
    public function submitLogin(string $phone_number): UserStatus
    {
        $flag = User::where('phone_number', $phone_number)->exists();

        if ($flag) {
            return UserStatus::EXISTS;
        } else {
            $otpCode = rand(10000, 99999);

            Cache::put('otp:'.$phone_number, $otpCode, now()->addMinute());

            SendOtpSmsJob::dispatch($phone_number, $otpCode);

            return UserStatus::NEW;
        }
    }
}
