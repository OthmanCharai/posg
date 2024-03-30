<?php

namespace App\src\Services\Brand;

use App\src\Domain\Media\MediaService;
use App\src\Repositories\Brand\BrandRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class BrandServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(
            BrandServiceInterface::class,
            fn() => new BrandService(new BrandRepository(), app(MediaService::class))
        );
    }

    public function provides(): array
    {
        return [BrandServiceInterface::class];
    }
}
