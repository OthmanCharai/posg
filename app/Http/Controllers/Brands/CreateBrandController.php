<?php

namespace App\Http\Controllers\Brands;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Transformers\BrandTransformer;
use App\src\Models\Brands\Brand;
use App\src\Services\Brand\BrandServiceInterface;
use Illuminate\Contracts\Container\BindingResolutionException;

class CreateBrandController extends Controller
{
    public function __construct(private readonly BrandServiceInterface $brandService)
    {
        parent::__construct();
    }

    /**
     * @throws BindingResolutionException
     */
    public function __invoke(StoreBrandRequest $request): \Illuminate\Http\JsonResponse
    {
        /* @var  Brand $brand */
        $brand = $this->brandService->create($request->validated());

        return $this->response->withArray(BrandTransformer::transform($brand));
    }
}