<?php

namespace App\Http\Controllers\Tax;

use App\Http\Controllers\Controller;
use App\Http\Transformers\TaxTransformer;
use App\src\Models\Tax\Tax;

class ShowTaxController extends Controller
{
    public function __invoke(Tax $tax): \Illuminate\Http\JsonResponse
    {
        $tax->load(Tax::TAX_VARIANT_RELATION);

        return $this->response->withItem($tax, new TaxTransformer($tax));
    }
}