<?php

namespace App\src\Services\Supplier;

use App\src\Entities\TypedCollections\SupplierCollection;
use App\src\Models\Supplier\Supplier;
use App\src\Repositories\Supplier\SupplierRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use YouCanShop\QueryOption\QueryOption;

class SupplierService implements SupplierServiceInterface
{
    public function __construct(private readonly SupplierRepository $supplierRepository)
    {
    }

    public function find(string $value, string $columnName = 'id'): ?Supplier
    {
        /* @var Supplier|null */
        return $this->supplierRepository->find($value, $columnName);
    }

    public function update(Supplier|Model $model, array $attributes): bool
    {
        return $this->supplierRepository->update($model->getId(), $attributes);
    }

    public function create(array $attributes): Supplier
    {
        /* @var Supplier */
        return $this->supplierRepository->create($attributes);
    }

    public function delete(Supplier|Model $model, string $columnName = 'id'): bool
    {
        return $this->supplierRepository->delete($model->getId(), $columnName);
    }

    public function getPaginated(QueryOption $queryOption): LengthAwarePaginator
    {
        return $this->supplierRepository->getPaginated($queryOption);
    }

    public function get(): SupplierCollection
    {
        return $this->supplierRepository->get();
    }
}
