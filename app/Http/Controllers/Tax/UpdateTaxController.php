<?php

namespace App\Http\Controllers\Tax;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTaxRequest;
use App\src\Models\Tax\Tax;
use App\src\Services\Tax\TaxServiceInterface;

class UpdateTaxController extends Controller
{
    public function __construct(private readonly TaxServiceInterface $taxService)
    {
        parent::__construct();
    }

    public function __invoke(Tax $tax, UpdateTaxRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->taxService->update($tax, $request->validated());

        $updatedTax = $this->taxService->find($tax->getId());

        return $this->response->withArray($updatedTax?->toArray());
    }
}
