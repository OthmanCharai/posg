<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSupplierRequest;
use App\Http\Resources\SupplierResource;
use App\src\Models\Supplier\Supplier;
use App\src\Services\Supplier\SupplierServiceInterface;

class UpdateSupplierController extends Controller
{
    public function __construct(private readonly SupplierServiceInterface $supplierService)
    {
        parent::__construct();
    }

    public function __invoke(Supplier $supplier, UpdateSupplierRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->supplierService->update($supplier, $request->validated());

        return $this->response->withItem($supplier, new SupplierResource($supplier));
    }
}
