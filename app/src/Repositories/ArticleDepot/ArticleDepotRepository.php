<?php

namespace App\src\Repositories\ArticleDepot;

use App\src\Models\ArticleDepot\ArticleDepot;
use App\src\Repositories\BaseRepository;

class ArticleDepotRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function getModelClass(): string
    {
        return ArticleDepot::class;
    }
}
