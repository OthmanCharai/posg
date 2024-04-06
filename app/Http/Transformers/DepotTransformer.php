<?php

namespace App\Http\Transformers;

use App\src\Models\Depot\Depot;

class DepotTransformer
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public static function transform(Depot $depot): array
    {
        return [
            Depot::ADDRESS_COLUMN => $depot->getAddress(),
            Depot::ID_COLUMN      => $depot->getId(),
        ];
    }
}