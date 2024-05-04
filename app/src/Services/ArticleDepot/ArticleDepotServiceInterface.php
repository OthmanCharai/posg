<?php

namespace App\src\Services\ArticleDepot;

use App\src\Models\Article\Article;
use App\src\Services\BaseInterface;
use Illuminate\Support\Collection;

interface ArticleDepotServiceInterface extends BaseInterface
{
    public function createMany(Article $article, array $attributes): Collection;
}