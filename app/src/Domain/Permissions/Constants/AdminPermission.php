<?php

namespace App\src\Domain\Permissions\Constants;


final readonly class AdminPermission
{
    public const SUPER = 1 << 0;

    public const PERMISSIONS = [
        'general' => [
            self::SUPER => 'super',
        ],
    ];
}
