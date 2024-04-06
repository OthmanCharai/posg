<?php

namespace App\src\Models\Article;

use App\src\Models\ArticleCategory\ArticleCategory;
use App\src\Models\Brands\Brand;
use App\src\Models\Depot\Depot;
use App\src\Models\Supplier\Supplier;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasRelations
{
    public final const RELATIONS = [
        Supplier::class        => 'supplier',
        ArticleCategory::class => 'articleCategory',
        Brand::class           => 'brand',
        Depot::class           => 'depots',
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function getSupplier(): Supplier
    {
        return $this->getAttribute(Supplier::class);
    }

    public function articleCategory(): BelongsTo
    {
        return $this->belongsTo(ArticleCategory::class);
    }

    public function getArticleCategory(): ArticleCategory
    {
        return $this->getAttribute(ArticleCategory::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function getBrand(): Brand
    {
        return $this->getAttribute(Brand::class);
    }

    public function depots(): BelongsToMany
    {
        return $this->belongsToMany(Depot::class)->withPivot('quantity');
    }

    public function getDepots(): Collection
    {
        return $this->getAttribute(self::RELATIONS[Depot::class]);
    }
}
