<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Transformers\SupplierTransformer;
use App\src\Models\Supplier\Supplier;
use App\src\Services\Supplier\SupplierServiceInterface;

class StoreSupplierController extends Controller
{
    public function __construct(private readonly SupplierServiceInterface $supplierService)
    {
        parent::__construct();
    }

    public function __invoke(StoreSupplierRequest $request): \Illuminate\Http\JsonResponse
    {
        /* @var Supplier $supplier */
        $supplier = $this->supplierService->create($request->validated());

        return $this->response->withArray(SupplierTransformer::transform($supplier));
    }
}
