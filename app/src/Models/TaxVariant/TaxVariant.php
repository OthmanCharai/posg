<?php

namespace App\src\Models\TaxVariant;

use App\src\Models\UuidModel;

class TaxVariant extends UuidModel
{
    use HasRelations;

    private const ID_PREFIX = 'tva_';

    public const TAX_ID_COLUMN = 'tax_id';
    public const NAME_COLUMN = 'name';
    public const VALUE_COLUMN = 'value';
    public const TYPE_COLUMN = 'type';

    protected $guarded = [];

    public function getName(): string
    {
        return $this->getAttribute(self::NAME_COLUMN);
    }

    public function getValue(): float
    {
        return $this->getAttribute(self::VALUE_COLUMN);
    }

    public function getType(): int
    {
        return $this->getAttribute(self::TYPE_COLUMN);
    }

    public static function getPrefix(): string
    {
        return self::ID_PREFIX;
    }
}