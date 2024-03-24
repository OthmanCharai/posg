<?php

namespace App\src\Services\CompanySetting;

use App\src\Repositories\CompanySetting\CompanySettingRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class CompanyServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(
            CompanySettingServiceInterface::class,
            fn() => new CompanySettingServiceService(new CompanySettingRepository())
        );
    }

    public function provides(): array
    {
        return [CompanySettingServiceInterface::class];
    }
}
