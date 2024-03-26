<?php

namespace App\src\Repositories\Supplier;

use App\src\Models\Supplier\Supplier;
use App\src\Repositories\BaseRepository;

class SupplierRepository extends BaseRepository
{

    /**
     * @inheritDoc
     */
    public function getModelClass(): string
    {
        return Supplier::class;
    }

    public function getPaginated(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->getQueryBuilder()->paginate(10);
    }
}
