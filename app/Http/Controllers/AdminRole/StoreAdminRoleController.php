<?php

namespace App\Http\Controllers\AdminRole;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRoleRequest;
use App\src\Domain\Permissions\Traits\ComputedPermissions;
use App\src\Models\AdminRole\AdminRole;
use App\src\Services\AdminRole\AdminRoleServiceInterface;
use App\src\Services\AdminRole\Exceptions\DuplicateRolePermissionException;
use Illuminate\Support\Arr;

class StoreAdminRoleController extends Controller
{
    use ComputedPermissions;

    public function __construct(private readonly AdminRoleServiceInterface $adminRoleService)
    {
        parent::__construct();
    }

    /**
     * @throws \Throwable
     */
    public function __invoke(StoreAdminRoleRequest $request): \Illuminate\Http\JsonResponse
    {
        $attributes = $request->validated();
        $permissions = $this->compute(...Arr::get($attributes, AdminRole::PERMISSIONS_COLUMN));
        throw_if(
            $this->adminRoleService->checkPermissionExistenceInRoles($permissions),
            new DuplicateRolePermissionException($permissions)
        );

        $role = $this->adminRoleService->create(
            array_merge(
                $attributes,
                [
                    AdminRole::PERMISSIONS_COLUMN => $permissions,
                ]
            )
        );

        return $this->response->withArray($role->toArray());
    }
}