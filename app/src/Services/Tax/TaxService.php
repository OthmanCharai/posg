<?php

namespace App\src\Services\Tax;

use App\src\Models\Tax\Tax;
use App\src\Repositories\Tax\TaxRepository;

class TaxService implements TaxServiceInterface
{
    public function __construct(private readonly TaxRepository $taxRepository)
    {
    }

    public function find(string $value, string $columnName = 'id'): ?Tax
    {
        /* @var Tax|null */
        return $this->taxRepository->find($value, $columnName);
    }

    public function update(string $id, array $attributes): bool
    {
        return $this->taxRepository->update($id, $attributes);
    }

    public function create(array $attributes): Tax
    {
        /* @var Tax */
        return $this->taxRepository->create($attributes);
    }

    public function delete(string $value, string $columnName = 'id'): bool
    {
        return $this->taxRepository->delete($value, $columnName);
    }
}
