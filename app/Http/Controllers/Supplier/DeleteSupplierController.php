<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\src\Models\Supplier\Supplier;
use App\src\Services\Supplier\SupplierServiceInterface;

class DeleteSupplierController extends Controller
{
    public function __construct(private readonly SupplierServiceInterface $supplierService)
    {
        parent::__construct();
    }

    public function __invoke(Supplier $supplier): \Illuminate\Http\JsonResponse
    {
        $this->supplierService->delete($supplier);

        return $this->response->withSuccess('supplier was deleted');
    }
}
