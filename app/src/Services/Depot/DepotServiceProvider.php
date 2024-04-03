<?php

namespace App\src\Services\Depot;

use App\src\Repositories\Depot\DepotRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class DepotServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(DepotServiceInterface::class, fn() => new DepotService(new DepotRepository()));
    }

    public function provides(): array
    {
        return [DepotServiceInterface::class];
    }
}
