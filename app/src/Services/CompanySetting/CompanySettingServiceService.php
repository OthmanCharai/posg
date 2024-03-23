<?php

namespace App\src\Services\CompanySetting;

use App\src\Models\CompanySetting\CompanySetting;
use App\src\Repositories\CompanySetting\CompanySettingRepository;
use Illuminate\Database\Eloquent\Model;

readonly class CompanySettingServiceService implements CompanySettingServiceInterface
{
    public function __construct(private CompanySettingRepository $companySettingRepository)
    {
    }

    public function find(string $value, string $columnName = 'id'): ?CompanySetting
    {
        /* @var  CompanySetting|null */
        return $this->companySettingRepository->find($value, $columnName);
    }

    public function update(string $id, array $attributes): bool
    {
        return $this->companySettingRepository->update($id, $attributes);
    }

    public function create(array $attributes): Model
    {
        /* @var CompanySetting */
        return $this->companySettingRepository->create($attributes);
    }

    public function delete(string $value, string $columnName = 'id'): bool
    {
        return $this->companySettingRepository->delete($value, $columnName);
    }
}
