<?php

namespace App\src\Repositories\Article;

use App\src\Models\Article\Article;
use App\src\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use YouCanShop\QueryOption\QueryOption;

class ArticleRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function getModelClass(): string
    {
        return Article::class;
    }

    /**
     * @param QueryOption $queryOption
     *
     * @return LengthAwarePaginator
     */
    public function getPaginated(QueryOption $queryOption): LengthAwarePaginator
    {
        $query = $this->getQueryBuilder();

        [$query, $queryOption] = $this->pipeThroughCriterias($query, $queryOption);

        $query->select(
            sprintf('%s.*', Article::TABLE_NAME)
        );

        return $query->paginate(
            $queryOption->getLimit(),
            '*',
            'page',
            $queryOption->getPage()
        );
    }

    protected function getQueryOptionCriterias(): array
    {
        return [

        ];
    }
}
