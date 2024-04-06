<?php

namespace App\Http\Controllers\Brands;

use App\Http\Controllers\Controller;
use App\Http\Transformers\BrandTransformer;
use App\src\Models\Brands\Brand;

class ShowBrandController extends Controller
{
    public function __invoke(Brand $brand): \Illuminate\Http\JsonResponse
    {
        return $this->response->withArray(BrandTransformer::staticToArray($brand));
    }
}