<?php

namespace App\Http\Controllers\Brands;

use App\Http\Controllers\Controller;
use App\Http\Transformers\BrandTransformer;
use App\src\Services\Brand\BrandServiceInterface;
use Illuminate\Http\Request;
use YouCanShop\QueryOption\QueryOptionFactory;

class ListBrandsController extends Controller
{
    public function __construct(private readonly BrandServiceInterface $brandService)
    {
        parent::__construct();
    }

    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        $brands = $this->brandService->getPaginated(QueryOptionFactory::createFromIlluminateRequest($request));

        $brands = transform_paginator($brands, BrandTransformer::class);

        return $this->response->withArray($brands->toArray());
    }
}

