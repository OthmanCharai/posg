<?php

namespace App\src\Repositories\ArticleCategory;

use App\src\Entities\TypedCollections\ArticleCategoryCollection;
use App\src\Models\ArticleCategory\ArticleCategory;
use App\src\Repositories\BaseRepository;

class ArticleCategoryRepository extends BaseRepository
{

    /**
     * @inheritDoc
     */
    public function getModelClass(): string
    {
        return ArticleCategory::class;
    }

    public function getPaginated(\YouCanShop\QueryOption\QueryOption $queryOption)
    {
        $query = $this->getQueryBuilder();

        [$query, $queryOption] = $this->pipeThroughCriterias($query, $queryOption);

        $query->select(
            sprintf('%s.*', ArticleCategory::TABLE_NAME)
        );

        return $query->paginate(
            $queryOption->getLimit(),
            '*',
            'page',
            $queryOption->getPage()
        );
    }

    public function get(): ArticleCategoryCollection
    {
        return ArticleCategoryCollection::make($this->getQueryBuilder()->get());
    }

    protected function getQueryOptionCriterias(): array
    {
        return [

        ];
    }
}
