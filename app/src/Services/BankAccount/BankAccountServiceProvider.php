<?php

namespace App\src\Services\BankAccount;

use App\src\Repositories\BankAccount\BankAccountRepository;
use Carbon\Laravel\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class BankAccountServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->register(BankAccountServiceInterface::class, fn() => new BankAccountServiceService(new BankAccountRepository()));
    }

    public function provides(): array
    {
        return [BankAccountServiceInterface::class];
    }
}

