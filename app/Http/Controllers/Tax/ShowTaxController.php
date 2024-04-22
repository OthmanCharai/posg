<?php

namespace App\Http\Controllers\Tax;

use App\Http\Controllers\Controller;
use App\Http\Transformers\TaxTransformer;
use App\src\Models\Tax\Tax;
use App\src\Models\TaxVariant\TaxVariant;

class ShowTaxController extends Controller
{
    public function __invoke(Tax $tax): \Illuminate\Http\JsonResponse
    {
        $tax->load(Tax::RELATIONS[TaxVariant::class]);

        return $this->response->withArray(
            [
                'tax' => TaxTransformer::transform($tax),
            ]
        );
    }
}