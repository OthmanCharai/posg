<?php

namespace App\src\Services\CompanySetting;

use App\src\Models\CompanySetting\CompanySetting;
use App\src\Services\BaseInterface;

interface CompanySettingServiceInterface extends BaseInterface
{
    public function getFirst(): ?CompanySetting;
}
