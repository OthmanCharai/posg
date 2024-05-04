<?php

namespace App\Http\Transformers;

use App\src\Models\ArticleDepot\ArticleDepot;

class ArticleDepotTransformer
{
    public static function transform(ArticleDepot $articleDepot): array
    {
        return [
            ArticleDepot::ARTICLE_ID_COLUMN => $articleDepot->getArticleId(),
            ArticleDepot::QUANTITY_COLUMN   => $articleDepot->getQuantity(),
            ArticleDepot::DEPOT_ID_COLUMN   => $articleDepot->getDepotId(),
        ];
    }
}
