<?php

namespace App\Http\Controllers\Tax;

use App\Http\Controllers\Controller;
use App\src\Services\Tax\TaxServiceInterface;
use Illuminate\Http\Request;
use YouCanShop\QueryOption\QueryOptionFactory;

class ListTaxController extends Controller
{
    public function __construct(private readonly TaxServiceInterface $taxService)
    {
        parent::__construct();
    }

    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        $taxes = $this->taxService->getPaginated(QueryOptionFactory::createFromIlluminateRequest($request));

        return $this->response->withArray($taxes->toArray());
    }
}