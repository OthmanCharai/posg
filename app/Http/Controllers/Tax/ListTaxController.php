<?php

namespace App\Http\Controllers\Tax;

use App\Http\Controllers\Controller;
use App\src\Services\Tax\TaxServiceInterface;

class ListTaxController extends Controller
{
    public function __construct(private readonly TaxServiceInterface $taxService)
    {
        parent::__construct();
    }

    public function __invoke(): \Illuminate\Http\JsonResponse
    {
        $taxes = $this->taxService->getPaginated();

        return $this->response->withArray($taxes->toArray());
    }
}