<?php

namespace App\src\Services\AdminRole;

use App\src\Models\AdminRole\AdminRole;
use App\src\Services\BaseInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use YouCanShop\QueryOption\QueryOption;

interface AdminRoleServiceInterface extends BaseInterface
{
    public function checkPermissionExistenceInRoles(int $permissions, ?AdminRole $role = null): bool;

    public function getPaginated(QueryOption $queryOption): LengthAwarePaginator;
}