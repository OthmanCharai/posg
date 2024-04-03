<?php

namespace App\src\Models\Depot;

use App\src\Models\UuidModel;

class Depot extends UuidModel
{
    use HasRelations;

    private const ID_PREFIX = 'dpt_';

    public final const NAME_COLUMN = 'name';
    public final const ADDRESS_COLUMN = 'address';
    public final const TABLE_NAME = 'depots';

    protected $guarded = [];

    public function getName(): string
    {
        return $this->getAttribute(self::NAME_COLUMN);
    }

    public function getAddress(): string
    {
        return $this->getAttribute(self::ADDRESS_COLUMN);
    }

    public static function getPrefix(): string
    {
        return self::ID_PREFIX;
    }
}
