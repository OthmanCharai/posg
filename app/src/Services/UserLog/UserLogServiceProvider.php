<?php

namespace App\src\Services\UserLog;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class UserLogServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(UserLogServiceInterface::class, fn() => make(UserLogService::class));
    }

    public function provides(): array
    {
        return [UserLogServiceInterface::class];
    }
}
