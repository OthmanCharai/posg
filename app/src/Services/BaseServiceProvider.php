<?php

namespace App\src\Services;

use App\src\Services\AdminRole\AdminRoleServiceProvider;
use App\src\Services\BankAccount\BankAccountServiceProvider;
use App\src\Services\CompanySetting\CompanyServiceProvider;
use App\src\Services\Supplier\SupplierServiceProvider;
use App\src\Services\Tax\TaxServiceProvider;
use App\src\Services\TaxVariant\TaxVariantServiceProvider;
use App\src\Services\User\UserServiceProvider;
use Illuminate\Support\ServiceProvider;

class BaseServiceProvider extends ServiceProvider
{
    protected array $providers = [
        UserServiceProvider::class,
        AdminRoleServiceProvider::class,
        CompanyServiceProvider::class,
        BankAccountServiceProvider::class,
        TaxServiceProvider::class,
        TaxVariantServiceProvider::class,
        SupplierServiceProvider::class,
    ];

    public function register(): void
    {
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
    }
}