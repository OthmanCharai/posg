<?php

namespace App\src\Repositories\Tax;

use App\src\Models\Tax\Tax;
use App\src\Repositories\BaseRepository;

class TaxRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function getModelClass(): string
    {
        return Tax::class;
    }
}
