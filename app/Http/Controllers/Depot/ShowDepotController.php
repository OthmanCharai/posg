<?php

namespace App\Http\Controllers\Depot;

use App\Http\Controllers\Controller;
use App\src\Models\Depot\Depot;

class ShowDepotController extends Controller
{
    public function __invoke(Depot $depot): \Illuminate\Http\JsonResponse
    {
        return $this->response->withArray($depot->toArray());
    }
}
