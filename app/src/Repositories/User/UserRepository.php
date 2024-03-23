<?php

namespace App\src\Repositories\User;

use App\src\Models\User\User;
use App\src\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function getModelClass(): string
    {
        return User::class;
    }
}
