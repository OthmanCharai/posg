<?php

namespace App\Http\Controllers\AdminRole;

use App\Http\Controllers\Controller;
use App\src\Models\AdminRole\AdminRole;

class ShowAdminRoleController extends Controller
{
    public function __invoke(AdminRole $adminRole): \Illuminate\Http\JsonResponse
    {
        return $this->response->withArray($adminRole->toArray());
    }
}
