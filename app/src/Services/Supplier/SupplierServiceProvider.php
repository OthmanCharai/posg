<?php

namespace App\src\Services\Supplier;

use App\src\Repositories\Supplier\SupplierRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class SupplierServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(SupplierServiceInterface::class, fn() => new SupplierService(new SupplierRepository()));
    }

    public function provides(): array
    {
        return [SupplierServiceInterface::class];
    }
}
