<?php

namespace App\src\Domain\Permissions\Traits;

use App\src\Domain\Permissions\Exceptions\UnauthorizedException;

trait ComputedPermissions
{
    /**
     * compute fn take a number of permission as arguments <READ,WRITE,DELETE>.
     * do $carry=$carry | $permission, foreach ($permission in $permissions).
     * at final return int =[] of permissions
     *
     * @param int ...$permissions
     *
     * @return int
     */
    private function compute(int ...$permissions): int
    {
        return array_reduce($permissions, static fn($carry, $item) => $carry | $item, 0x0);
    }

    /**
     * @param int $computed
     * @param int $permission
     *
     * @return void
     * @throws UnauthorizedException
     */
    private function assertPermissionExists(int $computed, int $permission): void
    {
        if ($this->permissionExists($computed, $permission)) {
            return;
        }

        throw new UnauthorizedException($computed, $permission);
    }

    /**
     * C = A | B | D
     * C & Q = 0X0 !== Q
     * C &  B = B == B
     *
     * @param int $computed
     * @param int $permission
     *
     * @return bool
     */
    private function permissionExists(int $computed, int $permission): bool
    {
        return ($computed & $permission) === $permission;
    }
}
