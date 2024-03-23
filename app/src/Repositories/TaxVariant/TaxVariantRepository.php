<?php

namespace App\src\Repositories\TaxVariant;

use App\src\Models\TaxVariant\TaxVariant;
use App\src\Repositories\BaseRepository;

class TaxVariantRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function getModelClass(): string
    {
        return TaxVariant::class;
    }
}
