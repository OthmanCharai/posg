<?php

namespace App\Http\Resources;

use App\src\Models\TaxVariant\Enums\TaxVariantTypeEnum;
use App\src\Models\TaxVariant\TaxVariant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaxVariantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /* @var TaxVariant $taxVariant */
        $taxVariant = $this;

        return [
            TaxVariant::NAME_COLUMN  => $taxVariant->getName(),
            TaxVariant::VALUE_COLUMN => $taxVariant->getValue(),
            TaxVariant::TYPE_COLUMN  => TaxVariantTypeEnum::from($taxVariant->getType()),
        ];
    }
}
