<?php

namespace App\src\Services\AdminRole;

use App\src\Models\AdminRole\AdminRole;
use App\src\Repositories\AdminRole\AdminRoleRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use YouCanShop\QueryOption\QueryOption;

readonly class AdminRoleServiceService implements AdminRoleServiceInterface
{
    public function __construct(private AdminRoleRepository $adminRoleRepository)
    {
    }

    public function find(string $value, string $columnName = 'id'): ?AdminRole
    {
        /* @var AdminRole|null */
        return $this->adminRoleRepository->find($value, $columnName);
    }

    public function update(AdminRole|Model $model, array $attributes): bool
    {
        return $this->adminRoleRepository->update($model->getId(), $attributes);
    }

    public function create(array $attributes): AdminRole
    {
        /* @var AdminRole */
        return $this->adminRoleRepository->create($attributes);
    }

    public function delete(AdminRole|Model $model, string $columnName = 'id'): bool
    {
        return $this->adminRoleRepository->delete($model->getId(), $columnName);
    }

    public function checkPermissionExistenceInRoles(int $permissions, ?AdminRole $role = null): bool
    {
        return $this->adminRoleRepository->checkPermissionExistenceInRoles($permissions, $role);
    }

    public function getPaginated(QueryOption $queryOption): LengthAwarePaginator
    {
        return $this->adminRoleRepository->getPaginated($queryOption);
    }

    public function get(): Collection
    {
        return $this->adminRoleRepository->get();
    }
}
