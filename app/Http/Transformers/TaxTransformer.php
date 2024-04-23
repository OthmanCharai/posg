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
    public static function transform(Tax $tax): array
    {
        $data = [
            Tax::ID_COLUMN   => $tax->getId(),
            Tax::NAME_COLUMN => $tax->getName(),
        ];

        if ($tax->relationLoaded(Tax::RELATIONS[TaxVariant::class])) {
            $data['tax_variants'] = $tax->getVariants();
        }

        return $data;
    }
}
