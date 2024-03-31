<?php

namespace App\src\Services\ArticleCategory;

use App\src\Repositories\ArticleCategory\ArticleCategoryRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class ArticleCategoryServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(
            ArticleCategoryServiceInterface::class,
            fn() => new ArticleCategoryService(new ArticleCategoryRepository())
        );
    }

    public function provides(): array
    {
        return [ArticleCategoryServiceInterface::class];
    }
}
