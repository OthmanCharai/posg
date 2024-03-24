<?php

namespace App\src\Services\User;

use App\src\Repositories\User\UserRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(UserServiceInterface::class, fn() => new UserService(new UserRepository()));
    }

    public function provides(): array
    {
        return [UserServiceInterface::class];
    }

}
