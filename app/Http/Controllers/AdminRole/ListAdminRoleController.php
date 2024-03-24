<?php

namespace App\Http\Controllers\AdminRole;

use App\Http\Controllers\Controller;
use App\src\Services\AdminRole\AdminRoleServiceInterface;
use Illuminate\Http\JsonResponse;

class ListAdminRoleController extends Controller
{
    public function __construct(private readonly AdminRoleServiceInterface $adminRoleService)
    {
        parent::__construct();
    }

    public function __invoke(): JsonResponse
    {
        return $this->response->withArray($this->adminRoleService->getPaginated()->toArray());
    }
}
