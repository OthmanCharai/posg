<?php

namespace App\Http\Transformers;

use App\src\Models\Compatibility\Compatibility;

class CompatibilityTransformer
{
    public static function transform(Compatibility $compatibility)
    {
        return [
            Compatibility::NAME_COLUMN => $compatibility->getName(),
            Compatibility::ID_COLUMN   => $compatibility->getId(),
        ];
    }
}
