<?php

namespace App\src\Models\AdminRole;

use App\src\Models\UuidModel;

class AdminRole extends UuidModel
{
    private const ID_PREFIX = 'adr_';

    public const NAME_COLUMN = "name";
    public const DESCRIPTION_COLUMN = "description";
    public const PERMISSIONS_COLUMN = "permissions";
    public const TABLE_NAME = 'admin_roles';

    protected $guarded = [];

    public function getName(): string
    {
        return $this->getAttribute(self::NAME_COLUMN);
    }

    public function getDescription(): string
    {
        return $this->getAttribute(self::DESCRIPTION_COLUMN);
    }

    public function getPermissions(): int
    {
        return $this->getAttribute(self::PERMISSIONS_COLUMN);
    }

    public static function getPrefix(): string
    {
        return self::ID_PREFIX;
    }
}