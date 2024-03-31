<?php

namespace App\src\Services\ArticleCategory;

use App\src\Services\BaseInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use YouCanShop\QueryOption\QueryOption;

interface ArticleCategoryServiceInterface extends BaseInterface
{
    public function getPaginated(QueryOption $queryOption): LengthAwarePaginator;
}
