<?php

namespace App\src\Models\Article;

use App\src\Models\ArticleCategory\ArticleCategory;
use App\src\Models\ArticleIso\ArticleIso;
use App\src\Models\Brands\Brand;
use App\src\Models\Compatibility\Compatibility;
use App\src\Models\Depot\Depot;
use App\src\Models\Supplier\Supplier;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasRelations
{
    public final const RELATIONS = [
        Supplier::class        => 'supplier',
        ArticleCategory::class => 'articleCategory',
        Brand::class           => 'brand',
        Depot::class           => 'depots',
        Compatibility::class   => 'compatibilities',
        ArticleIso::class      => 'articleIso',
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

    public function compatibilities(): BelongsToMany
    {
        return $this->belongsToMany(Compatibility::class);
    }

    public function getCompatibilities(): Collection
    {
        return $this->getAttribute(self::RELATIONS[Compatibility::class]);
    }

    public function articleIso(): HasMany
    {
        return $this->hasMany(ArticleIso::class);
    }
}
