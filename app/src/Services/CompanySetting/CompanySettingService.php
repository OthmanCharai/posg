<?php

namespace App\src\Services\CompanySetting;

use App\src\Domain\Media\Exceptions\FileDeleteFromS3FailedException;
use App\src\Domain\Media\Exceptions\FileUploadToS3FailedException;
use App\src\Domain\Media\MediaService;
use App\src\Models\CompanySetting\CompanySetting;
use App\src\Repositories\CompanySetting\CompanySettingRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

readonly class CompanySettingService implements CompanySettingServiceInterface
{
    public function __construct(
        private CompanySettingRepository $companySettingRepository,
        private readonly MediaService $mediaService
    ) {
    }

    public function find(string $value, string $columnName = 'id'): ?CompanySetting
    {
        /* @var  CompanySetting|null */
        return $this->companySettingRepository->find($value, $columnName);
    }

    /**
     * @throws FileDeleteFromS3FailedException
     * @throws FileUploadToS3FailedException
     */
    public function update(CompanySetting|Model $model, array $attributes): bool
    {
        $this->mediaService->delete($model->getPath());
        $path = $this->mediaService->save($model->getId(), Arr::get($attributes, CompanySetting::PATH_COLUMN));

        return $this->companySettingRepository->update(
            $model->getId(),
            array_merge(
                $attributes,
                [
                    CompanySetting::PATH_COLUMN => $path,
                ]
            )
        );
    }

    /**
     * @throws FileUploadToS3FailedException
     */
    public function create(array $attributes): CompanySetting
    {
        $path = $this->mediaService->save('company-id', Arr::get($attributes, CompanySetting::PATH_COLUMN));

        /* @var CompanySetting */
        return $this->companySettingRepository->create(
            array_merge($attributes, [CompanySetting::PATH_COLUMN => $path])
        );
    }

    /**
     * @throws FileDeleteFromS3FailedException
     */
    public function delete(CompanySetting|Model $model, string $columnName = 'id'): bool
    {
        $this->mediaService->delete($model->getPath());

        return $this->companySettingRepository->delete($model->getId(), $columnName);
    }

    public function getFirst(): ?CompanySetting
    {
        return $this->companySettingRepository->getFirst();
    }
}
