<?php

namespace App\src\Services\Compatibility;

use App\src\Entities\TypedCollections\CompatibilityCollection;
use App\src\Services\BaseInterface;

interface CompatibilityServiceInterface extends BaseInterface
{
    public function get(): CompatibilityCollection;
}