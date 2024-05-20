<?php

namespace App\src\Services\Supplier;

use App\src\Entities\TypedCollections\SupplierCollection;
use App\src\Services\BaseInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use YouCanShop\QueryOption\QueryOption;

interface SupplierServiceInterface extends BaseInterface
{
    public function getPaginated(QueryOption $queryOption): LengthAwarePaginator;

    public function get(): SupplierCollection;
}
