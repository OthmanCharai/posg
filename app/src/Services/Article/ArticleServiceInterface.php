<?php

namespace App\src\Services\Article;

use App\src\Services\BaseInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use YouCanShop\QueryOption\QueryOption;

interface ArticleServiceInterface extends BaseInterface
{
    public function getPaginated(QueryOption $queryOption): LengthAwarePaginator;
}
