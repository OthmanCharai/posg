<?php

namespace App\src\Services\User;

use App\src\Entities\TypedCollections\UserCollection;
use App\src\Models\User\User;
use App\src\Services\BaseInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use YouCanShop\QueryOption\QueryOption;

interface UserServiceInterface extends BaseInterface
{
    public function getPaginated(QueryOption $queryOption): LengthAwarePaginator;

    public function findByEmail(string $email): ?User;

    public function get(): UserCollection;
}
