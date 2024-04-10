<?php

namespace App\src\Models\Compatibility;

use App\src\Models\Article\Article;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasRelations
{
    public final const RELATIONS = [
        Article::class => 'articles',
    ];

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class);
    }

    public function getArticles(): Collection
    {
        return $this->getAttribute(self::RELATIONS[Article::class]);
    }
}