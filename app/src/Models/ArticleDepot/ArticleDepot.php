<?php

namespace App\src\Models\ArticleDepot;

use App\src\Models\UuidModel;

class ArticleDepot extends UuidModel
{
    private const ID_PREFIX = 'adp_';

    public const DEPOT_ID_COLUMN = 'depot_id';
    public const ARTICLE_ID_COLUMN = 'article_id';
    public const QUANTITY_COLUMN = 'quantity';

    protected $guarded = [];

    public static function getPrefix(): string
    {
        return self::ID_PREFIX;
    }

    public function getDepotId(): string
    {
        return $this->getAttribute(self::DEPOT_ID_COLUMN);
    }

    public function getArticleId(): string
    {
        return $this->getAttribute(self::ARTICLE_ID_COLUMN);
    }

    public function getQuantity(): int
    {
        return $this->getAttribute(self::QUANTITY_COLUMN);
    }
}
