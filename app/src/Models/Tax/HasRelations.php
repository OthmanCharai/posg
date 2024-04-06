<?php

namespace App\src\Models\Tax;

use App\src\Models\TaxVariant\TaxVariant;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasRelations
{
    public const RELATIONS = [
        TaxVariant::class => 'taxVariants',
    ];

    public function taxVariants(): HasMany
    {
        return $this->hasMany(TaxVariant::class);
    }

    public function getVariants(): Collection
    {
        return $this->getAttribute(self::RELATIONS[TaxVariant::class]);
    }
}
