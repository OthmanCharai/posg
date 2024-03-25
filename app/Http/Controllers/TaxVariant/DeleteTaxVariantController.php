<?php

namespace App\Http\Controllers\TaxVariant;

use App\Http\Controllers\Controller;
use App\src\Models\TaxVariant\TaxVariant;
use App\src\Services\TaxVariant\TaxVariantServiceInterface;

class DeleteTaxVariantController extends Controller
{
    public function __construct(private readonly TaxVariantServiceInterface $taxVariantService)
    {
        parent::__construct();
    }

    public function __invoke(TaxVariant $taxVariant): \Illuminate\Http\JsonResponse
    {
        $this->taxVariantService->delete($taxVariant);

        return $this->response->withSuccess('tax variant was deleted with success');
    }
}
