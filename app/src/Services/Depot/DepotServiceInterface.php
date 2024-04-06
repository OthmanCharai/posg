<?php

namespace App\src\Services\Depot;

use App\src\Services\BaseInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use YouCanShop\QueryOption\QueryOption;

interface DepotServiceInterface extends BaseInterface
{
    public function get(): Collection;

    public function getPaginated(QueryOption $queryOption): LengthAwarePaginator;
}