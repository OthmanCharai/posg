<?php

namespace App\src\Repositories\ArticleIso;

use App\src\Models\ArticleIso\ArticleIso;
use App\src\Repositories\BaseRepository;

class ArticleIsoRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function getModelClass(): string
    {
        return ArticleIso::class;
    }
}
