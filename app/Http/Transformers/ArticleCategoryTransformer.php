<?php

namespace App\Http\Transformers;

use App\src\Models\ArticleCategory\ArticleCategory;

class ArticleCategoryTransformer
{
    public static function transform(ArticleCategory $articleCategory): array
    {
        return [
            ArticleCategory::NAME_COLUMN => $articleCategory->getName(),
            ArticleCategory::ID_COLUMN   => $articleCategory->getId(),
        ];
    }
}
