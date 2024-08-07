<?php

namespace App\src\Services\Tax;

use App\src\Models\Tax\Tax;
use App\src\Repositories\Tax\TaxRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use YouCanShop\QueryOption\QueryOption;

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

    public function update(Tax|Model $model, array $attributes): bool
    {
        return $this->taxRepository->update($model->getId(), $attributes);
    }

    public function create(array $attributes): Tax
    {
        /* @var Tax */
        return $this->taxRepository->create($attributes);
    }

    public function delete(Tax|Model $model, string $columnName = 'id'): bool
    {
        return $this->taxRepository->delete($model->getId(), $columnName);
    }

    public function getPaginated(QueryOption $queryOption): Collection
    {
        return $this->taxRepository->getPaginated($queryOption);
    }
}
