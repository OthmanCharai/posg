<?php

namespace App\Http\Resources;

use App\src\Models\Tax\Tax;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaxResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /* @var Tax $tax */
        $tax = $this;

        return [
            Tax::NAME_COLUMN => $tax->getName(),
            'tax_variants'   => TaxVariantCollection::make($this->whenLoaded(Tax::TAX_VARIANT_RELATION)),
        ];
    }
}
