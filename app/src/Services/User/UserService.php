<?php

namespace App\src\Services\User;

use App\src\Models\User\User;
use App\src\Repositories\User\UserRepository;

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

    public function update(string $id, array $attributes): bool
    {
        return $this->userRepository->update($id, $attributes);
    }

    public function create(array $attributes): User
    {
        /* @var User */
        return $this->userRepository->create($attributes);
    }

    public function delete(string $value, string $columnName = 'id'): bool
    {
        return $this->userRepository->delete($value, $columnName);
    }
}
