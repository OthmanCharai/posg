<?php

namespace App\Http\Controllers\Depot;

use App\Http\Controllers\Controller;
use App\src\Services\Depot\DepotServiceInterface;
use Illuminate\Http\Request;
use YouCanShop\QueryOption\QueryOptionFactory;

class ListDepotController extends Controller
{
    public function __construct(private readonly DepotServiceInterface $depotService)
    {
        parent::__construct();
    }

    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        $depots = $this->depotService->getPaginated(QueryOptionFactory::createFromIlluminateRequest($request));

        return $this->response->withArray(
            [
                'depots' => $depots,
            ]
        );
    }
}
