<?php

namespace App\src\Repositories\User;

use App\src\Models\User\User;
use App\src\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function getModelClass(): string
    {
        return User::class;
    }

    public function getPaginated(): LengthAwarePaginator
    {
        return $this->getQueryBuilder()->paginate(10);
    }
}
