<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Http\Transformers\SupplierTransformer;
use App\src\Models\Supplier\Supplier;

class ShowSupplierController extends Controller
{
    public function __invoke(Supplier $supplier): \Illuminate\Http\JsonResponse
    {
        return $this->response->withArray(SupplierTransformer::transform($supplier));
    }
}
