<?php

namespace App\Http\Controllers\TaxVariant;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTaxVariantRequest;
use App\src\Models\TaxVariant\TaxVariant;
use App\src\Services\TaxVariant\TaxVariantServiceInterface;

class UpdateTaxVariantController extends Controller
{
    public function __construct(private readonly TaxVariantServiceInterface $taxVariantService)
    {
        parent::__construct();
    }

    public function __invoke(TaxVariant $taxVariant, UpdateTaxVariantRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->taxVariantService->update(
            $taxVariant,
            $request->validated()
        );


        return $this->response->withArray($this->taxVariantService->find($taxVariant->getId())?->toArray());
    }
}
