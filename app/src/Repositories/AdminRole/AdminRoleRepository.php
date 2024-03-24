<?php

namespace App\src\Repositories\AdminRole;

use App\src\Models\AdminRole\AdminRole;
use App\src\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AdminRoleRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function getModelClass(): string
    {
        return AdminRole::class;
    }

    public function checkPermissionExistenceInRoles(int $permissions, ?string $roleId = null): bool
    {
        $query = $this->getQueryBuilder()
            ->where(AdminRole::PERMISSIONS_COLUMN, $permissions);
        if ($roleId) {
            $query->where(AdminRole::ID_COLUMN, '!=', $roleId);
        }

        return $query->count() > 0;
    }

    public function getPaginated(): LengthAwarePaginator
    {
        return $this->getQueryBuilder()->paginate(10);
    }
}
