<?php

namespace App\src\Services\Compatibility;

use App\src\Models\Compatibility\Compatibility;
use App\src\Repositories\Compatibility\CompatibilityRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

readonly class CompatibilityService implements CompatibilityServiceInterface
{
    public function __construct(private CompatibilityRepository $compatibilityRepository)
    {
    }

    public function find(string $value, string $columnName = 'id'): ?Compatibility
    {
        /* @var Compatibility|null */
        return $this->compatibilityRepository->find($value);
    }

    public function update(Model|Compatibility $model, array $attributes): bool
    {
        return $this->compatibilityRepository->update($model->getId(), $attributes);
    }

    public function create(array $attributes): Compatibility
    {
        /* @var Compatibility */
        return $this->compatibilityRepository->create($attributes);
    }

    public function delete(Model|Compatibility $model, string $columnName = 'id'): bool
    {
        return $this->compatibilityRepository->delete($model->getId());
    }

    public function get(): Collection
    {
        return $this->compatibilityRepository->get();
    }
}
