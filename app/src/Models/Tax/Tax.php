<?php

namespace App\src\Models\Tax;

use App\src\Models\UuidModel;

/**
 * @property mixed $taxVariants
 */
class Tax extends UuidModel
{
    use HasRelations;

    private const ID_PREFIX = 'tax_';

    public const TABLE_NAME = 'taxes';
    public const NAME_COLUMN = 'name';
    protected $guarded = [];

    public static function getPrefix(): string
    {
        return self::ID_PREFIX;
    }

    public function getName(): string
    {
        return $this->getAttribute(self::NAME_COLUMN);
    }
}
