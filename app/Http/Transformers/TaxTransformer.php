<?php

namespace App\Http\Transformers;

use App\src\Models\Tax\Tax;
use App\src\Models\TaxVariant\TaxVariant;

class TaxTransformer
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function transform(Tax $tax): array
    {
        $data = [
            Tax::NAME_COLUMN => $tax->getName(),
        ];

        if ($tax->relationLoaded(Tax::RELATIONS[TaxVariant::class])) {
            $data['tax_variants'] = $tax->getVariants();
        }

        return $data;
    }
}
