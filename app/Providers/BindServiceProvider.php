<?php

namespace App\Providers;

use App\Services\Actions\SubmitLoginConcrete;
use App\Services\Actions\SubmitPasswordConcrete;
use App\Services\Actions\VerifyOtpConcrete;
use App\Services\Contracts\SubmitLoginInterface;
use App\Services\Contracts\SubmitPasswordInterface;
use App\Services\Contracts\VerifyOtpInterface;
use Illuminate\Support\ServiceProvider;

class BindServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->bind(SubmitLoginInterface::class, SubmitLoginConcrete::class);
        $this->app->bind(SubmitPasswordInterface::class, SubmitPasswordConcrete::class);
        $this->app->bind(VerifyOtpInterface::class, VerifyOtpConcrete::class);
    }
}
