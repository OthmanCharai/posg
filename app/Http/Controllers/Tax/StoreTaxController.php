<?php

namespace App\Http\Controllers\Tax;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaxRequest;
use App\src\Services\Tax\TaxServiceInterface;

class StoreTaxController extends Controller
{
    public function __construct(private readonly TaxServiceInterface $taxService)
    {
        parent::__construct();
    }

    public function __invoke(StoreTaxRequest $request): \Illuminate\Http\JsonResponse
    {
        $tax = $this->taxService->create($request->validated());

        return $this->response->withArray($tax->toArray());
    }
}
