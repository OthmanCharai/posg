<?php

namespace App\src\Models\Tax;

use App\src\Models\TaxVariant\TaxVariant;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasRelations
{
    public const TAX_VARIANT_RELATION = 'taxVariants';

    public function taxVariants(): HasMany
    {
        return $this->hasMany(TaxVariant::class);
    }
}
