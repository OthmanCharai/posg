<?php

namespace App\src\Services\AdminRole;

use App\src\Repositories\AdminRole\AdminRoleRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class AdminRoleServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register()
    {
        return $this->app->register(AdminRoleServiceInterface::class, fn() => new AdminRoleServiceService(new AdminRoleRepository()));
    }

    public function provides(): array
    {
        return [AdminRoleServiceInterface::class];
    }
}
