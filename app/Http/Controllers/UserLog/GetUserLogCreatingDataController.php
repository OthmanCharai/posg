<?php

namespace App\Http\Controllers\UserLog;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class GetUserLogCreatingDataController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return $this->response->withArray(
            [
                'tables' => DB::select('SHOW TABLES'),
            ]
        );
    }
}
