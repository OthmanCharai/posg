<?php

namespace App\src\Entities\TypedCollections;

use App\src\Entities\TypedCollection;
use App\src\Models\Brands\Brand;

class BrandCollection extends TypedCollection
{
    protected static array $allowedTypes = [Brand::class];
}
