<?php

namespace App\Http\Controllers\AdminRole;

use App\Http\Controllers\Controller;
use App\src\Models\AdminRole\AdminRole;
use App\src\Services\AdminRole\AdminRoleServiceInterface;

class DeleteAdminRoleController extends Controller
{
    public function __construct(private readonly AdminRoleServiceInterface $adminRoleService)
    {
        parent::__construct();
    }

    public function __invoke(AdminRole $adminRole): \Illuminate\Http\JsonResponse
    {
        $this->adminRoleService->delete($adminRole);

        return $this->response->withSuccess('admin role was deleted with success');
    }
}
