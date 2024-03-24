<?php

namespace App\Http\Controllers\TaxVariant;

use App\Http\Controllers\Controller;
use App\src\Models\TaxVariant\TaxVariant;

class ShowTaxVariantController extends Controller
{
    public function __invoke(TaxVariant $taxVariant): \Illuminate\Http\JsonResponse
    {
        return $this->response->withArray($taxVariant->toArray());
    }
}
