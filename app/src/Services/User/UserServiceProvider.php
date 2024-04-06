<?php

namespace App\src\Services\User;

use App\src\Domain\Media\MediaService;
use App\src\Repositories\User\UserRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Hashing\HashManager;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(
            UserServiceInterface::class,
            fn() => new UserService(new UserRepository(), app(HashManager::class), app(MediaService::class))
        );
    }

    public function provides(): array
    {
        return [UserServiceInterface::class];
    }

}
