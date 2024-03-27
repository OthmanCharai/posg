<?php

namespace App\src\Services\User;

use App\src\Models\User\User;
use App\src\Services\BaseInterface;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserServiceInterface extends BaseInterface
{
    public function getPaginated(): LengthAwarePaginator;

    public function findByEmail(string $email): ?User;
}