<?php

namespace App\Http\Transformers;

use App\src\Models\TaxVariant\Enums\TaxVariantTypeEnum;
use App\src\Models\TaxVariant\TaxVariant;

class TaxVariantTransformer
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function transform(TaxVariant $taxVariant): array
    {
        return [
            TaxVariant::NAME_COLUMN  => $taxVariant->getName(),
            TaxVariant::VALUE_COLUMN => $taxVariant->getValue(),
            TaxVariant::TYPE_COLUMN  => TaxVariantTypeEnum::from($taxVariant->getType()),
        ];
    }
}
