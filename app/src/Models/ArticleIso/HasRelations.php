<?php

namespace App\src\Models\ArticleIso;

use App\src\Models\Article\Article;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasRelations
{
    public final const RELATIONS = [
        Article::class => 'article',
    ];

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}
