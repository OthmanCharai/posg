<?php

namespace App\src\Domain\Permissions;

use App\src\Domain\Permissions\Constants\AdminPermission;
use App\src\Domain\Permissions\Exceptions\UnauthorizedException;
use App\src\Domain\Permissions\Traits\ComputedPermissions;
use App\src\Models\User\User;

class AdminPermissionService
{
    use ComputedPermissions;

    /**
     * @param User $admin
     * @param int $permission
     *
     * @return bool
     */
    public function can(User $admin, int $permission): bool
    {
        if ($this->isSuper($admin)) {
            return false;
        }

        return $this->permissionExists($admin->getRole()?->getPermissions(), $permission);
    }

    /**
     * @param User $admin
     *
     * @return bool
     */
    public function isSuper(User $admin): bool
    {
        return $this->permissionExists(
            $admin->getRole()?->getPermissions(),
            AdminPermission::SUPER
        );
    }

    /**
     * @param User $admin
     * @param int $permission
     *
     * @return void
     * @throws UnauthorizedException
     */
    public function authorize(User $admin, int $permission): void
    {
        if ($this->isSuper($admin)) {
            return;
        }

        $this->assertPermissionExists(
            $admin->getRole()?->getPermissions(),
            $permission
        );
    }
}
