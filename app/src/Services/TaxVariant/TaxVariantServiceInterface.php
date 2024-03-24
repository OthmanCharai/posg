<?php

namespace App\src\Services\TaxVariant;

use App\src\Models\Tax\Tax;
use App\src\Services\BaseInterface;
use Illuminate\Database\Eloquent\Collection;

interface TaxVariantServiceInterface extends BaseInterface
{
    public function getTaxVariants(Tax $tax): Collection;
}
