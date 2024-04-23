<?php

namespace App\src\Services\Tax;

use App\src\Services\BaseInterface;
use Illuminate\Database\Eloquent\Collection;
use YouCanShop\QueryOption\QueryOption;

interface TaxServiceInterface extends BaseInterface
{
    public function getPaginated(QueryOption $queryOption): Collection;
}
