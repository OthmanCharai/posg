<?php

namespace App\src\Repositories\User;

use App\src\Entities\TypedCollections\UserCollection;
use App\src\Models\AdminRole\AdminRole;
use App\src\Models\User\User;
use App\src\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use YouCanShop\QueryOption\QueryOption;

class UserRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function getModelClass(): string
    {
        return User::class;
    }

    public function getPaginated(QueryOption $queryOption): LengthAwarePaginator
    {
        $query = $this->getQueryBuilder();

        [$query, $queryOption] = $this->pipeThroughCriterias($query, $queryOption);

        $query->with(User::RELATIONS[AdminRole::class]);

        $query->select(
            sprintf('%s.*', User::TABLE_NAME)
        );

        return $query->paginate(
            $queryOption->getLimit(),
            '*',
            'page',
            $queryOption->getPage()
        );
    }

    public function get(): UserCollection
    {
        return UserCollection::make(
            $this->getQueryBuilder()->get()
        );
    }

    protected function getQueryOptionCriterias(): array
    {
        return [

        ];
    }
}
