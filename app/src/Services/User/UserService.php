<?php

namespace App\src\Services\User;

use App\src\Models\User\User;
use App\src\Repositories\User\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Hashing\HashManager;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use YouCanShop\QueryOption\QueryOption;

readonly class UserService implements UserServiceInterface
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly HashManager $hashManager
    ) {
    }

    public function find(string $value, string $columnName = 'id'): ?User
    {
        /* @var User/null */
        return $this->userRepository->find($value, $columnName);
    }

    public function update(User|Model $model, array $attributes): bool
    {
        return $this->userRepository->update(
            $model->getId(),
            array_merge(
                $attributes,
                [
                    User::PASSWORD_COLUMN => $this->hashManager->make(Arr::get($attributes, User::PASSWORD_COLUMN)),
                ]
            )
        );
    }

    public function create(array $attributes): User
    {
        /* @var User */
        return $this->userRepository->create(
            array_merge(
                $attributes,
                [
                    User::PASSWORD_COLUMN => $this->hashManager->make(Arr::get($attributes, User::PASSWORD_COLUMN)),
                ]
            )
        );
    }

    public function delete(User|Model $model, string $columnName = 'id'): bool
    {
        return $this->userRepository->delete($model->getId(), $columnName);
    }

    public function getPaginated(QueryOption $queryOption): LengthAwarePaginator
    {
        return $this->userRepository->getPaginated($queryOption);
    }

    public function findByEmail(string $email): ?User
    {
        /* @var User/null */
        return $this->userRepository->find($email, User::EMAIL_COLUMN);
    }
}
