<?php

namespace App\Http\Controllers\TaxVariant;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaxVariantCollection;
use App\src\Models\Tax\Tax;
use App\src\Services\TaxVariant\TaxVariantServiceInterface;

class GetTaxVariantsController extends Controller
{
    public function __construct(private readonly TaxVariantServiceInterface $taxVariantService)
    {
        parent::__construct();
    }

    public function __invoke(Tax $tax): \Illuminate\Http\JsonResponse
    {
        $taxVariants = $this->taxVariantService->getTaxVariants($tax);

        return $this->response->withItems($taxVariants, new TaxVariantCollection($taxVariants));
    }
}