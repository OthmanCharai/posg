<?php

namespace App\Http\Controllers\AdminRole;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAdminRoleRequest;
use App\src\Domain\Permissions\Traits\ComputedPermissions;
use App\src\Models\AdminRole\AdminRole;
use App\src\Services\AdminRole\AdminRoleServiceInterface;
use App\src\Services\AdminRole\Exceptions\DuplicateRolePermissionException;
use Illuminate\Support\Arr;

class UpdateAdminRoleController extends Controller
{
    use ComputedPermissions;

    public function __construct(private readonly AdminRoleServiceInterface $adminRoleService)
    {
        parent::__construct();
    }

    /**
     * @throws \Throwable
     */
    public function __invoke(AdminRole $adminRole, UpdateAdminRoleRequest $request)
    {
        $attributes = $request->validated();

        $permissions = $this->compute(...Arr::get($attributes, AdminRole::PERMISSIONS_COLUMN));

        throw_if(
            $this->adminRoleService->checkPermissionExistenceInRoles($permissions, $adminRole),
            new DuplicateRolePermissionException($permissions)
        );

        $this->adminRoleService->update(
            $adminRole,
            array_merge(
                $attributes,
                [
                    AdminRole::PERMISSIONS_COLUMN => $permissions,
                ]
            )
        );
        /* @var AdminRole $adminRole */
        $adminRole = $this->adminRoleService->find($adminRole->getId());

        return $this->response->withArray($adminRole->toArray());
    }
}
