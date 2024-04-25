<?php

namespace App\src\Repositories\Tax;

use App\src\Models\Tax\Tax;
use App\src\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
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

    public function getPaginated(QueryOption $queryOption): Collection
    {
        $query = $this->getQueryBuilder();

        [$query, $queryOption] = $this->pipeThroughCriterias($query, $queryOption);

        $query->select(
            sprintf('%s.*', Tax::TABLE_NAME)
        );

        return $query->get();
    }

    protected function getQueryOptionCriterias(): array
    {
        return [

        ];
    }
}
