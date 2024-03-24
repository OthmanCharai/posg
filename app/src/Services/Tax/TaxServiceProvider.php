<?php

namespace App\src\Services\Tax;

use App\src\Repositories\Tax\TaxRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class TaxServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(TaxServiceInterface::class, fn() => new TaxService(new TaxRepository()));
    }

    public function provides(): array
    {
        return [TaxServiceInterface::class];
    }
}
