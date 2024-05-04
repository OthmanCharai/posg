<?php

namespace App\src\Services\ArticleDepot;

use App\src\Repositories\ArticleDepot\ArticleDepotRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class ArticleDepotServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(
            ArticleDepotServiceInterface::class,
            fn() => new ArticleDepotService(new ArticleDepotRepository())
        );
    }

    public function provides(): array
    {
        return [ArticleDepotServiceInterface::class];
    }
}
