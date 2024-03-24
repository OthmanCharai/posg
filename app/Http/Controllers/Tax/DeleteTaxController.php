<?php

namespace App\Http\Controllers\Tax;

use App\Http\Controllers\Controller;
use App\src\Models\Tax\Tax;
use App\src\Services\Tax\TaxServiceInterface;

class DeleteTaxController extends Controller
{
    public function __construct(private readonly TaxServiceInterface $taxService)
    {
        parent::__construct();
    }

    public function __invoke(Tax $tax): \Illuminate\Http\JsonResponse
    {
        $this->taxService->delete($tax);

        return $this->response->withSuccess('tax was delete with success');
    }
}
