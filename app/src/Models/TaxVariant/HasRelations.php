<?php

namespace App\src\Models\TaxVariant;

use App\src\Models\Tax\Tax;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasRelations
{
    public function tax(): BelongsTo
    {
        return $this->belongsTo(Tax::class);
    }
}
