<?php

namespace App\Http\Transformers;

use App\src\Models\ArticleIso\ArticleIso;

class ArticleIsoTransformer
{
    public static function transform(ArticleIso $articleIso): array
    {
        return [
            ArticleIso::ARTICLE_ID_COLUMN => $articleIso->getArticleId(),
            ArticleIso::VALUE_COLUMN      => $articleIso->getValue(),
            ArticleIso::ID_COLUMN         => $articleIso->getId(),
        ];
    }
}
