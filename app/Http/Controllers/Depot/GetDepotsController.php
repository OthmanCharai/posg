<?php

namespace App\Http\Controllers\Depot;

use App\Http\Controllers\Controller;
use App\src\Services\Depot\DepotServiceInterface;

class GetDepotsController extends Controller
{
    public function __construct(private readonly DepotServiceInterface $depotService)
    {
        parent::__construct();
    }

    public function __invoke()
    {
        $depots = $this->depotService->get();
    }
}
