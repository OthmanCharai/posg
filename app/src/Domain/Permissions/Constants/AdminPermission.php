<?php

namespace App\src\Domain\Permissions\Constants;


final readonly class AdminPermission
{
    public const SUPER = 1 << 0;
    public const MANAGE_ROLES = 1 << 1;
    public const MANAGE_ADMINS = 1 << 2;
    public const MANAGE_COMPANY_SETTING = 1 << 3;
    public const MANAGE_TAXES = 1 << 4;

    public const PERMISSIONS = [
        'general'         => [
            self::SUPER => 'super',
        ],
        'roles'           => [
            self::MANAGE_ROLES => 'manage roles',
        ],
        'admins'          => [
            self::MANAGE_ROLES => 'manage admins',
        ],
        'company-setting' => [
            self::MANAGE_COMPANY_SETTING => 'manage company setting',
        ],
        'taxes'           => [
            self::MANAGE_TAXES => 'manage taxes',
        ],
    ];
}
