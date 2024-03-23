<?php

namespace App\src\Services\TaxVariant;

use App\src\Repositories\TaxVariant\TaxVariantRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class TaxVariantServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->register(
            TaxVariantServiceInterface::class,
            fn() => new TaxVariantService(new TaxVariantRepository())
        );
    }

    public function provides(): array
    {
        return [TaxVariantServiceInterface::class];
    }
}
