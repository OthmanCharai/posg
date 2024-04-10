<?php

namespace App\src\Repositories\Compatibility;

use App\src\Models\Compatibility\Compatibility;
use App\src\Repositories\BaseRepository;

class CompatibilityRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function getModelClass(): string
    {
        return Compatibility::class;
    }

    public function get(): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->getQueryBuilder()->get();
    }
}
