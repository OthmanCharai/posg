<?php

namespace App\Http\Controllers\TaxVariant;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaxVariantRequest;
use App\src\Models\Tax\Tax;
use App\src\Models\TaxVariant\TaxVariant;
use App\src\Services\TaxVariant\TaxVariantServiceInterface;

class StoreTaxVariantController extends Controller
{
    public function __construct(private readonly TaxVariantServiceInterface $taxVariantService)
    {
        parent::__construct();
    }

    public function __invoke(Tax $tax, StoreTaxVariantRequest $request): \Illuminate\Http\JsonResponse
    {
        $taxVariant = $this->taxVariantService->create(
            array_merge($request->validated(), [TaxVariant::TAX_ID_COLUMN => $tax->getId()])
        );

        return $this->response->withArray($taxVariant->toArray());
    }
}
