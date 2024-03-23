<?php

namespace App\src\Services\BankAccount;

use App\src\Models\BankAccount\BankAccount;
use App\src\Repositories\BankAccount\BankAccountRepository;

readonly class BankAccountServiceService implements BankAccountServiceInterface
{
    public function __construct(private BankAccountRepository $accountRepository)
    {
    }

    public function find(string $value, string $columnName = 'id'): ?BankAccount
    {
        /* @var BankAccount|null */
        return $this->accountRepository->find($value, $columnName);
    }

    public function update(string $id, array $attributes): bool
    {
        return $this->accountRepository->update($id, $attributes);
    }

    public function create(array $attributes): BankAccount
    {
        /* @var BankAccount */
        return $this->accountRepository->create($attributes);
    }

    public function delete(string $value, string $columnName = 'id'): bool
    {
        return $this->accountRepository->delete($value, $columnName);
    }
}
