<?php

namespace App\src\Services\Compatibility;

use App\src\Repositories\Compatibility\CompatibilityRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class CompatibilityServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(
            CompatibilityServiceInterface::class,
            fn() => new CompatibilityService(new CompatibilityRepository())
        );
    }

    public function provides(): array
    {
        return [CompatibilityServiceInterface::class];
    }
}
