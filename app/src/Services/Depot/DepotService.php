<?php

namespace App\src\Services\Depot;

use App\src\Models\Depot\Depot;
use App\src\Repositories\Depot\DepotRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use YouCanShop\QueryOption\QueryOption;

class DepotService implements DepotServiceInterface
{
    public function __construct(private readonly DepotRepository $depotRepository)
    {
    }

    public function find(string $value, string $columnName = 'id'): ?Depot
    {
        /* @var Depot|null */
        return $this->depotRepository->find($value, $columnName);
    }

    public function update(Model|Depot $model, array $attributes): bool
    {
        return $this->depotRepository->update(
            $model->getId(),
            Arr::only(
                $attributes,
                [
                    Depot::ADDRESS_COLUMN,
                    Depot::NAME_COLUMN,
                ]
            )
        );
    }

    public function create(array $attributes): Depot
    {
        /* @var Depot */
        return $this->depotRepository->create(
            Arr::only(
                $attributes,
                [
                    Depot::ADDRESS_COLUMN,
                    Depot::NAME_COLUMN,
                ]
            )
        );
    }

    public function delete(Model|Depot $model, string $columnName = 'id'): bool
    {
        return $this->depotRepository->delete($model->getId());
    }

    public function getPaginated(QueryOption $queryOption): LengthAwarePaginator
    {
        return $this->depotRepository->getPaginated($queryOption);
    }

    public function get(): Collection
    {
        return $this->depotRepository->get();
    }
}
