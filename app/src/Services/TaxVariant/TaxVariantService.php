<?php

namespace App\src\Services\TaxVariant;

use App\src\Models\Tax\Tax;
use App\src\Models\TaxVariant\TaxVariant;
use App\src\Repositories\TaxVariant\TaxVariantRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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

    public function update(TaxVariant|Model $model, array $attributes): bool
    {
        return $this->taxVariantRepository->update($model->getId(), $attributes);
    }

    public function create(array $attributes): TaxVariant
    {
        /* @var TaxVariant */
        return $this->taxVariantRepository->create($attributes);
    }

    public function delete(TaxVariant|Model $model, string $columnName = 'id'): bool
    {
        return $this->taxVariantRepository->delete($model->getId(), $columnName);
    }

    public function getTaxVariants(Tax $tax): Collection
    {
        return $this->taxVariantRepository->getTaxVariants($tax->getId());
    }
}