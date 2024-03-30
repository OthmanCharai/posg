<?php

namespace App\Http\Controllers\Brands;

use App\Http\Controllers\Controller;
use App\src\Models\Brands\Brand;
use App\src\Services\Brand\BrandServiceInterface;

class DeleteBrandController extends Controller
{
    public function __construct(private readonly BrandServiceInterface $brandService)
    {
        parent::__construct();
    }

    public function __invoke(Brand $brand): \Illuminate\Http\JsonResponse
    {
        $this->brandService->delete($brand);

        return $this->response->withSuccess('brand was deleted with success');
    }
}
