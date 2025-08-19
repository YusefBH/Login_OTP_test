<?php

namespace App\Providers;

use App\Services\Actions\AuthConcrete;
use App\Services\Contracts\AuthInterface;
use Illuminate\Support\ServiceProvider;

class BindServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->bind(AuthInterface::class, AuthConcrete::class);
    }
}
