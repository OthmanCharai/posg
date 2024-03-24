<?php

namespace App\src\Repositories\Tax;

use App\src\Models\Tax\Tax;
use App\src\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TaxRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function getModelClass(): string
    {
        return Tax::class;
    }

    public function getPaginated(): LengthAwarePaginator
    {
        return $this->getQueryBuilder()->paginate(10);
    }
}
