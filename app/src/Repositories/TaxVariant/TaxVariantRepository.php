<?php

namespace App\src\Repositories\TaxVariant;

use App\src\Models\TaxVariant\TaxVariant;
use App\src\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class TaxVariantRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function getModelClass(): string
    {
        return TaxVariant::class;
    }

    public function getTaxVariants(string $taxId): Collection|array
    {
        return $this->getQueryBuilder()->where(TaxVariant::TAX_ID_COLUMN, $taxId)->get();
    }
}
