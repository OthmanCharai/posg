<?php

namespace App\src\Models\Tax;

use App\src\Models\TaxVariant\TaxVariant;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasRelations
{
    public function taxVariants(): HasMany
    {
        return $this->hasMany(TaxVariant::class);
    }
}
