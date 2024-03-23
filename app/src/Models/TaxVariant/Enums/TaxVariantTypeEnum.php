<?php

namespace App\src\Models\TaxVariant\Enums;

enum TaxVariantTypeEnum: int
{
    case PERCENTAGE = 0;
    case NUMBER = 1;
}
