<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class SendOtpSmsJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public string $phone_number,
        public string $code,
    ) {
    }

    public function handle(): void
    {
        $message = $this->phone_number." ==> ".__('custom.otp_code').$this->code;
        Log::info($message);
    }
}
