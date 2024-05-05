<?php

namespace App\src\Services\Brand;

use App\src\Entities\TypedCollections\BrandCollection;
use App\src\Services\BaseInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use YouCanShop\QueryOption\QueryOption;

interface BrandServiceInterface extends BaseInterface
{
    public function getPaginated(QueryOption $queryOption): LengthAwarePaginator;

    public function get(): BrandCollection;
}
