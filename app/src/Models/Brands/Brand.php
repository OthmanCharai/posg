<?php

namespace App\src\Models\Brands;

use App\src\Models\UuidModel;

class Brand extends UuidModel
{
    use HasRelations;

    private const ID_PREFIX = 'brd_';

    public final const NAME_COLUMN = 'name';
    public final const LOGO_COLUMN = 'path';
    public final const ABBREVIATION_COLUMN = 'abbreviation';
    public final const TABLE_NAME = 'brands';

    protected $guarded = [];

    public static function getPrefix(): string
    {
        return self::ID_PREFIX;
    }

    public function getName(): string
    {
        return $this->getAttribute(self::NAME_COLUMN);
    }

    public function getLogo(): ?string
    {
        return $this->getAttribute(self::LOGO_COLUMN);
    }

    public function getAbbriviation(): ?string
    {
        return $this->getAttribute(self::ABBREVIATION_COLUMN);
    }
}

