<?php

namespace App\src\Models\ArticleCategory;

use App\src\Models\UuidModel;

class ArticleCategory extends UuidModel
{
    private const ID_PREFIX = "aca_";

    public const NAME_COLUMN = 'name';
    public const TABLE_NAME = "article_categories";

    public static function getPrefix(): string
    {
        return self::ID_PREFIX;
    }

    public function getName(): string
    {
        return $this->getAttribute(self::NAME_COLUMN);
    }
}
