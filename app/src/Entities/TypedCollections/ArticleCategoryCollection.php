<?php

namespace App\src\Entities\TypedCollections;

use App\src\Entities\TypedCollection;
use App\src\Models\ArticleCategory\ArticleCategory;

class ArticleCategoryCollection extends TypedCollection
{
    protected static array $allowedTypes = [ArticleCategory::class];
}
