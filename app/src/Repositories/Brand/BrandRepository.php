<?php

namespace App\src\Repositories\Brand;

use App\src\Models\Brands\Brand;
use App\src\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use YouCanShop\QueryOption\QueryOption;

class BrandRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function getModelClass(): string
    {
        return Brand::class;
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
            sprintf('%s.*', Brand::TABLE_NAME)
        );

        return $query->paginate(
            $queryOption->getLimit(),
            '*',
            'page',
            $queryOption->getPage()
        );
    }
}
