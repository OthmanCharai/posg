<?php

namespace App\src\Repositories\Supplier;

use App\src\Models\Supplier\Supplier;
use App\src\Repositories\BaseRepository;
use YouCanShop\QueryOption\QueryOption;

class SupplierRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function getModelClass(): string
    {
        return Supplier::class;
    }

    public function getPaginated(QueryOption $queryOption): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $query = $this->getQueryBuilder();

        [$query, $queryOption] = $this->pipeThroughCriterias($query, $queryOption);

        $query->select(
            sprintf('%s.*', Supplier::TABLE_NAME)
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
