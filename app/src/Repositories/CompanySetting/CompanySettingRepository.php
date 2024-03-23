<?php

namespace App\src\Repositories\CompanySetting;

use App\src\Models\CompanySetting\CompanySetting;
use App\src\Repositories\BaseRepository;

class CompanySettingRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function getModelClass(): string
    {
        return CompanySetting::class;
    }
}
