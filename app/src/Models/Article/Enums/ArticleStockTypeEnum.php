<?php

namespace App\src\Models\Article\Enums;

enum ArticleStockTypeEnum: int
{
    case STOCKED = 0;

    case NON_STOCKED = 1;
}
