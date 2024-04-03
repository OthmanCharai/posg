<?php

namespace App\Http\Controllers\Depot;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepotRequest;
use App\src\Services\Depot\DepotServiceInterface;

class CreateDepotController extends Controller
{
    public function __construct(private readonly DepotServiceInterface $depotService)
    {
        parent::__construct();
    }

    public function __invoke(StoreDepotRequest $request): \Illuminate\Http\JsonResponse
    {
        $depot = $this->depotService->create($request->validated());

        return $this->response->withArray($depot->toArray());
    }
}
