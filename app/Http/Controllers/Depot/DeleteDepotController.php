<?php

namespace App\Http\Controllers\Depot;

use App\Http\Controllers\Controller;
use App\src\Models\Depot\Depot;
use App\src\Services\Depot\DepotServiceInterface;

class DeleteDepotController extends Controller
{
    public function __construct(private readonly DepotServiceInterface $depotService)
    {
        parent::__construct();
    }

    public function __invoke(Depot $depot): \Illuminate\Http\JsonResponse
    {
        $this->depotService->delete($depot);

        return $this->response->withSuccess('depot deletd with success');
    }
}
