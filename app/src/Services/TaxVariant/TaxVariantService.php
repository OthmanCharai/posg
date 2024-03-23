<?php

namespace App\src\Services\TaxVariant;

use App\src\Models\TaxVariant\TaxVariant;
use App\src\Repositories\TaxVariant\TaxVariantRepository;

class TaxVariantService implements TaxVariantServiceInterface
{
    public function __construct(private readonly TaxVariantRepository $taxVariantRepository)
    {
    }

    public function find(string $value, string $columnName = 'id'): ?TaxVariant
    {
        /* @var  TaxVariant|null */
        return $this->taxVariantRepository->find($value, $columnName);
    }

    public function update(string $id, array $attributes): bool
    {
        return $this->taxVariantRepository->update($id, $attributes);
    }

    public function create(array $attributes): TaxVariant
    {
        /* @var TaxVariant */
        return $this->taxVariantRepository->create($attributes);
    }

    public function delete(string $value, string $columnName = 'id'): bool
    {
        return $this->taxVariantRepository->delete($value, $columnName);
    }
}