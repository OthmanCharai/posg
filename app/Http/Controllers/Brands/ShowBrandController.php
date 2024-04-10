<?php

namespace App\Http\Controllers\Brands;

use App\Http\Controllers\Controller;
use App\Http\Transformers\BrandTransformer;
use App\src\Models\Brands\Brand;
use Illuminate\Contracts\Container\BindingResolutionException;

class ShowBrandController extends Controller
{
    /**
     * @throws BindingResolutionException
     */
    public function __invoke(Brand $brand): \Illuminate\Http\JsonResponse
    {
        return $this->response->withArray(BrandTransformer::transform($brand));
    }
}