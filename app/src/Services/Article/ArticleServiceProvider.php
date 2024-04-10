<?php

namespace App\src\Services\Article;

use App\src\Domain\Media\MediaService;
use App\src\Repositories\Article\ArticleRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class ArticleServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(
            ArticleServiceInterface::class,
            fn() => new ArticleService(new ArticleRepository(), make(MediaService::class))
        );
    }

    public function provides(): array
    {
        return [ArticleServiceInterface::class];
    }
}
