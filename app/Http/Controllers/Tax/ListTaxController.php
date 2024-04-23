<?php

namespace App\Http\Controllers\Tax;

use App\Http\Controllers\Controller;
use App\Http\Transformers\TaxTransformer;
use App\src\Models\Tax\Tax;
use App\src\Models\TaxVariant\TaxVariant;
use App\src\Services\Tax\TaxServiceInterface;
use Illuminate\Http\Request;
use YouCanShop\QueryOption\QueryOptionFactory;

class ListTaxController extends Controller
{
    public function __construct(private readonly TaxServiceInterface $taxService)
    {
        parent::__construct();
    }

    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        $taxes = $this->taxService->getPaginated(QueryOptionFactory::createFromIlluminateRequest($request));
        $taxes = map_paginator($taxes, [$this, 'hydrate']);

        return $this->response->withArray(transform_paginator($taxes, TaxTransformer::class)->toArray());
    }

    public function hydrate(Tax $tax): Tax
    {
        return $tax->load(Tax::RELATIONS[TaxVariant::class]);
    }
}
