<?php

namespace App\src\Models\Compatibility;

use App\src\Models\UuidModel;

class Compatibility extends UuidModel
{
    use HasRelations;

    public final const TABLE_NAME = 'compatibilities';

    public final const NAME_COLUMN = 'name';
    private const ID_PREFIX = 'cmp_';

    public static function getPrefix(): string
    {
        return self::ID_PREFIX;
    }

    public function getName(): string
    {
        return $this->getAttribute(self::NAME_COLUMN);
    }
}