<?php

namespace App\src\Entities\TypedCollections;

use App\src\Entities\TypedCollection;
use App\src\Models\Supplier\Supplier;

class SupplierCollection extends TypedCollection
{
    protected static array $allowedTypes = [Supplier::class];
}
