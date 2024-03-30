<?php

namespace App\src\Services\Brand;

use App\src\Domain\Media\MediaService;
use App\src\Models\Brands\Brand;
use App\src\Repositories\Brand\BrandRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
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

    public function update(Model|Brand $model, array $attributes): bool
    {
        $this->brandRepository->update($model->getId(), $attributes);
    }

    public function create(array $attributes): Brand
    {
        /* @var  Brand|null */
        return $this->brandRepository->create($attributes);
    }

    public function delete(Model|Brand $model, string $columnName = 'id'): bool
    {
        return $this->brandRepository->delete($model->getId(), $columnName);
    }

    public function getPaginated(QueryOption $queryOption): LengthAwarePaginator
    {
        return $this->brandRepository->getPaginated($queryOption);
    }
}
