<?php

namespace App\src\Services\Supplier;

use App\src\Services\BaseInterface;
use Illuminate\Pagination\LengthAwarePaginator;

interface SupplierServiceInterface extends BaseInterface
{
    public function getPaginated(): LengthAwarePaginator;
}
