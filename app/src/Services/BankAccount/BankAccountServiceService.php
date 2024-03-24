<?php

namespace App\src\Services\BankAccount;

use App\src\Models\BankAccount\BankAccount;
use App\src\Repositories\BankAccount\BankAccountRepository;
use Illuminate\Database\Eloquent\Model;

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

    public function update(BankAccount|Model $model, array $attributes): bool
    {
        return $this->accountRepository->update($model->getId(), $attributes);
    }

    public function create(array $attributes): BankAccount
    {
        /* @var BankAccount */
        return $this->accountRepository->create($attributes);
    }

    public function delete(BankAccount|Model $model, string $columnName = 'id'): bool
    {
        return $this->accountRepository->delete($model->getId(), $columnName);
    }
}
