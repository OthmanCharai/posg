<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Http\Resources\SupplierResource;
use App\src\Services\Supplier\SupplierServiceInterface;
use Illuminate\Http\Request;
use YouCanShop\QueryOption\QueryOptionFactory;

class ListSupplierController extends Controller
{
    public function __construct(private readonly SupplierServiceInterface $supplierService)
    {
        parent::__construct();
    }

    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        $suppliers = $this->supplierService->getPaginated(QueryOptionFactory::createFromIlluminateRequest($request));

        $suppliers = map_paginator($suppliers, SupplierResource::class);

        return $this->response->withArray($suppliers->toArray());
    }
}
