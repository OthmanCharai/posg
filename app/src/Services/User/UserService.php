<?php

namespace App\src\Services\User;

use App\src\Domain\Media\Exceptions\FileDeleteFromS3FailedException;
use App\src\Domain\Media\Exceptions\FileUploadToS3FailedException;
use App\src\Domain\Media\MediaService;
use App\src\Entities\TypedCollections\UserCollection;
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
        private readonly HashManager $hashManager,
        private readonly MediaService $mediaService
    ) {
    }

    public function find(string $value, string $columnName = 'id'): ?User
    {
        /* @var User/null */
        return $this->userRepository->find($value, $columnName);
    }

    /**
     * @throws FileUploadToS3FailedException
     * @throws FileDeleteFromS3FailedException
     */
    public function update(User|Model $model, array $attributes): bool
    {
        if ($uploadedFile = Arr::get($attributes, User::LOGO_COLUMN)) {
            $this->mediaService->delete($model?->getLogo());
            $uploadedFile = $this->mediaService->save('usr_', $uploadedFile);
        }

        return $this->userRepository->update(
            $model->getId(),
            array_merge(
                $attributes,
                [
                    User::PASSWORD_COLUMN => $this->hashManager->make(Arr::get($attributes, User::PASSWORD_COLUMN)),
                    User::LOGO_COLUMN     => $uploadedFile,
                ]
            )
        );
    }

    /**
     * @throws FileUploadToS3FailedException
     */
    public function create(array $attributes): User
    {
        if ($uploadedFile = Arr::get($attributes, User::LOGO_COLUMN)) {
            $uploadedFile = $this->mediaService->save('usr_', $uploadedFile);
        }

        /* @var User */
        return $this->userRepository->create(
            array_merge(
                $attributes,
                [
                    User::PASSWORD_COLUMN => $this->hashManager->make(Arr::get($attributes, User::PASSWORD_COLUMN)),
                    User::LOGO_COLUMN     => $uploadedFile,
                ]
            )
        );
    }

    /**
     * @throws FileDeleteFromS3FailedException
     */
    public function delete(User|Model $model, string $columnName = 'id'): bool
    {
        if ($path = $model->getLogo()) {
            $this->mediaService->delete($path);
        }

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

    public function get(): UserCollection
    {
        return $this->userRepository->get();
    }
}
