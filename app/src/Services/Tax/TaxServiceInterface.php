<?php

namespace App\src\Services\Tax;

use App\src\Services\BaseInterface;
use Illuminate\Pagination\LengthAwarePaginator;

interface TaxServiceInterface extends BaseInterface
{
    public function getPaginated(): LengthAwarePaginator;
}
