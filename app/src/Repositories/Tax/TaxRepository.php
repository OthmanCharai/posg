<?php

namespace App\src\Repositories\Tax;

use App\src\Models\Tax\Tax;
use App\src\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use YouCanShop\QueryOption\QueryOption;

class TaxRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function getModelClass(): string
    {
        return Tax::class;
    }

    public function getPaginated(QueryOption $queryOption): LengthAwarePaginator
    {
        $query = $this->getQueryBuilder();

        [$query, $queryOption] = $this->pipeThroughCriterias($query, $queryOption);

        $query->select(
            sprintf('%s.*', Tax::TABLE_NAME)
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
