<?php

namespace App\src\Services\ArticleIso;

use App\src\Repositories\ArticleIso\ArticleIsoRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class ArticleIsoServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(ArticleIsoServiceInterface::class, fn() => new ArticleIsoService(new ArticleIsoRepository()));
    }

    public function provides(): array
    {
        return [ArticleIsoServiceInterface::class];
    }
}
