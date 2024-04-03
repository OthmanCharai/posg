<?php

namespace App\src\Repositories\Depot;

use App\src\Models\Depot\Depot;
use App\src\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use YouCanShop\QueryOption\QueryOption;

class DepotRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function getModelClass(): string
    {
        return Depot::class;
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
            sprintf('%s.*', Depot::TABLE_NAME)
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
