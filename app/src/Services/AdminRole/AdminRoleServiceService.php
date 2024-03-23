<?php

namespace App\src\Services\AdminRole;

use App\src\Models\AdminRole\AdminRole;
use App\src\Repositories\AdminRole\AdminRoleRepository;

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

    public function update(string $id, array $attributes): bool
    {
        return $this->adminRoleRepository->update($id, $attributes);
    }

    public function create(array $attributes): AdminRole
    {
        /* @var AdminRole */
        return $this->adminRoleRepository->create($attributes);
    }

    public function delete(string $value, string $columnName = 'id'): bool
    {
        return $this->adminRoleRepository->delete($value, $columnName);
    }
}
