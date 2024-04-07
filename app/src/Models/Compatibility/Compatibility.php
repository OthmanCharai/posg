<?php

namespace App\src\Models\Compatibility;

use App\src\Models\UuidModel;

class Compatibility extends UuidModel
{
    public final const TABLE_NAME = 'compatibilities';
    private const ID_PREFIX = 'cmp_';

    public static function getPrefix(): string
    {
        return self::ID_PREFIX;
    }
}