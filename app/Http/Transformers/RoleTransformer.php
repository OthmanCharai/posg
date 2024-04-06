<?php

namespace App\Http\Transformers;

use App\src\Models\AdminRole\AdminRole;

class RoleTransformer
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public static function transform(AdminRole $adminRole): array
    {
        return [
            AdminRole::ID_COLUMN          => $adminRole->getId(),
            AdminRole::NAME_COLUMN        => $adminRole->getName(),
            AdminRole::DESCRIPTION_COLUMN => $adminRole->getDescription(),
            AdminRole::PERMISSIONS_COLUMN => $adminRole->getPermissions(),
        ];
    }
}
