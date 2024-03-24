<?php

namespace App\src\Services\User;

use App\src\Models\User\User;
use App\src\Repositories\User\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

readonly class UserService implements UserServiceInterface
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function find(string $value, string $columnName = 'id'): ?User
    {
        /* @var User/null */
        return $this->userRepository->find($value, $columnName);
    }

    public function update(User|Model $model, array $attributes): bool
    {
        return $this->userRepository->update($model->getId(), $attributes);
    }

    public function create(array $attributes): User
    {
        /* @var User */
        return $this->userRepository->create($attributes);
    }

    public function delete(User|Model $model, string $columnName = 'id'): bool
    {
        return $this->userRepository->delete($model->getId(), $columnName);
    }

    public function getPaginated(): LengthAwarePaginator
    {
        return $this->userRepository->getPaginated();
    }
}
