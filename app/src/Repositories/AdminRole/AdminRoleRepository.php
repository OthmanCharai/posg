<?php

namespace App\src\Repositories\AdminRole;

use App\src\Models\AdminRole\AdminRole;
use App\src\Repositories\BaseRepository;

class AdminRoleRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function getModelClass(): string
    {
        return AdminRole::class;
    }
}
