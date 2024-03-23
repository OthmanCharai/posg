<?php

namespace App\src\Repositories\BankAccount;

use App\src\Models\BankAccount\BankAccount;
use App\src\Repositories\BaseRepository;

class BankAccountRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function getModelClass(): string
    {
        return BankAccount::class;
    }
}
