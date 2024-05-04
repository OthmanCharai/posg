<?php

namespace App\src\Models\ArticleIso;

use App\src\Models\UuidModel;

class ArticleIso extends UuidModel
{
    use HasRelations;

    private const ID_PREFIX = 'ais_';

    public const ARTICLE_ID_COLUMN = 'article_id';
    public const VALUE_COLUMN = 'value';
    public const TABLE_NAME = 'article_iso';

    protected $guarded = [];
    protected $table = 'article_iso';

    public function getArticleId(): string
    {
        return $this->getAttribute(self::ARTICLE_ID_COLUMN);
    }

    public function getValue(): string
    {
        return $this->getAttribute(self::VALUE_COLUMN);
    }

    public static function getPrefix(): string
    {
        return self::ID_PREFIX;
    }
}
