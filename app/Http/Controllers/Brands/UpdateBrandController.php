<?php

namespace App\Http\Controllers\Brands;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateBrandRequest;
use App\Http\Resources\BrandResource;
use App\src\Models\Brands\Brand;
use App\src\Services\Brand\BrandServiceInterface;
use Illuminate\Http\JsonResponse;

class UpdateBrandController extends Controller
{
    public function __construct(private readonly BrandServiceInterface $brandService)
    {
        parent::__construct();
    }

    public function __invoke(Brand $brand, UpdateBrandRequest $request): JsonResponse
    {
        $this->brandService->update($brand, $request->validated());

        /* @var Brand $updatedBrand */
        $updatedBrand = $this->brandService->find($brand->getId());

        return $this->response->withArray(BrandResource::staticToArray($updatedBrand));
    }
}
