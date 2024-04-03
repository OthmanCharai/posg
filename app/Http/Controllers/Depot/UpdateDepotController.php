<?php

namespace App\Http\Controllers\Depot;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateDepotRequest;
use App\src\Models\Depot\Depot;
use App\src\Services\Depot\DepotServiceInterface;

class UpdateDepotController extends Controller
{
    public function __construct(private readonly DepotServiceInterface $depotService)
    {
        parent::__construct();
    }

    public function __invoke(Depot $depot, UpdateDepotRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->depotService->update($depot, $request->validated());
        /* @var Depot $updatedDepot */
        $updatedDepot = $this->depotService->find($depot->getId());

        return $this->response->withArray($updatedDepot->toArray());
    }
}
