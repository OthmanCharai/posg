<?php

namespace App\src\Services\Brand;

use App\src\Domain\Media\Exceptions\FileDeleteFromS3FailedException;
use App\src\Domain\Media\Exceptions\FileUploadToS3FailedException;
use App\src\Domain\Media\MediaService;
use App\src\Models\Brands\Brand;
use App\src\Repositories\Brand\BrandRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use YouCanShop\QueryOption\QueryOption;

class BrandService implements BrandServiceInterface
{
    public function __construct(
        private readonly BrandRepository $brandRepository,
        private readonly MediaService $mediaService
    ) {
    }

    public function find(string $value, string $columnName = 'id'): ?Brand
    {
        /* @var  Brand|null */
        return $this->brandRepository->find($value, $columnName);
    }

    /**
     * @throws FileUploadToS3FailedException
     * @throws FileDeleteFromS3FailedException
     */
    public function update(Model|Brand $model, array $attributes): bool
    {
        $path = $model->getLogo();

        if (!is_null($uploadedFile = Arr::get($attributes, Brand::LOGO_COLUMN))) {
            $this->mediaService->delete($model->getLogo());
            $path = $this->mediaService->save('brand-id', $uploadedFile);
        }

        return $this->brandRepository->update(
            $model->getId(),
            array_merge($attributes, [Brand::LOGO_COLUMN => $path])
        );
    }

    /**
     * @throws FileUploadToS3FailedException
     */
    public function create(array $attributes): Brand
    {
        $path = $this->mediaService->save('brand-id', Arr::get($attributes, Brand::LOGO_COLUMN));

        /* @var  Brand|null */
        return $this->brandRepository->create(array_merge($attributes, [Brand::LOGO_COLUMN => $path]));
    }

    /**
     * @throws FileDeleteFromS3FailedException
     */
    public function delete(Model|Brand $model, string $columnName = 'id'): bool
    {
        $this->mediaService->delete($model->getLogo());

        return $this->brandRepository->delete($model->getId(), $columnName);
    }

    public function getPaginated(QueryOption $queryOption): LengthAwarePaginator
    {
        return $this->brandRepository->getPaginated($queryOption);
    }
}
