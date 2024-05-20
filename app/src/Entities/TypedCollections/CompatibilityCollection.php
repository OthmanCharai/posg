<?php

namespace App\src\Entities\TypedCollections;

use App\src\Entities\TypedCollection;
use App\src\Models\Compatibility\Compatibility;

class CompatibilityCollection extends TypedCollection
{
    protected static array $allowedTypes = [Compatibility::class];
}
