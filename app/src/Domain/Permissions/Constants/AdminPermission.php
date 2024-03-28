<?php

namespace App\src\Domain\Permissions\Constants;


final readonly class AdminPermission
{
    public final const SUPER = 1 << 0;
    public final const MANAGE_ROLES = 1 << 1;
    public final const MANAGE_ADMINS = 1 << 2;
    public final const MANAGE_COMPANY_SETTING = 1 << 3;
    public final const  MANAGE_TAXES = 1 << 4;
    public final const MANAGE_BANK_ACCOUNT = 1 << 5;
    public final const MANAGE_SUPPLIER = 1 << 6;

    public final const PERMISSIONS = [
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
        'bank-accounts'   => [
            self::MANAGE_BANK_ACCOUNT => 'manage bank account',
        ],
        'manage_supplier' => [
            self::MANAGE_SUPPLIER => 'manage suppliers',
        ],
    ];
}
