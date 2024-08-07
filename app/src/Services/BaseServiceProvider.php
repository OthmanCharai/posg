<?php

namespace App\src\Services;

use App\src\Services\AdminRole\AdminRoleServiceProvider;
use App\src\Services\Article\ArticleServiceProvider;
use App\src\Services\ArticleCategory\ArticleCategoryServiceProvider;
use App\src\Services\ArticleDepot\ArticleDepotServiceProvider;
use App\src\Services\ArticleIso\ArticleIsoServiceProvider;
use App\src\Services\BankAccount\BankAccountServiceProvider;
use App\src\Services\Brand\BrandServiceProvider;
use App\src\Services\CompanySetting\CompanyServiceProvider;
use App\src\Services\Compatibility\CompatibilityServiceProvider;
use App\src\Services\Depot\DepotServiceProvider;
use App\src\Services\Supplier\SupplierServiceProvider;
use App\src\Services\Tax\TaxServiceProvider;
use App\src\Services\TaxVariant\TaxVariantServiceProvider;
use App\src\Services\User\UserServiceProvider;
use App\src\Services\UserLog\UserLogServiceProvider;
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
        BrandServiceProvider::class,
        ArticleCategoryServiceProvider::class,
        DepotServiceProvider::class,
        ArticleServiceProvider::class,
        CompanyServiceProvider::class,
        ArticleIsoServiceProvider::class,
        ArticleDepotServiceProvider::class,
        CompatibilityServiceProvider::class,
        UserLogServiceProvider::class,
    ];

    public function register(): void
    {
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
    }
}
