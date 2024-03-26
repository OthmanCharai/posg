<?php

namespace App\src\Repositories\AdminRole;

use App\src\Models\AdminRole\AdminRole;
use App\src\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use YouCanShop\QueryOption\Laravel\UsesQueryOption;
use YouCanShop\QueryOption\QueryOption;

class AdminRoleRepository extends BaseRepository
{
    use UsesQueryOption;

    /**
     * @inheritDoc
     */
    public function getModelClass(): string
    {
        return AdminRole::class;
    }

    public function checkPermissionExistenceInRoles(int $permissions, ?string $roleId = null): bool
    {
        $query = $this->getQueryBuilder()
            ->where(AdminRole::PERMISSIONS_COLUMN, $permissions);
        if ($roleId) {
            $query->where(AdminRole::ID_COLUMN, '!=', $roleId);
        }

        return $query->count() > 0;
    }

    public function getPaginated(QueryOption $queryOption): LengthAwarePaginator
    {
        $query = $this->getQueryBuilder();

        [$query, $queryOption] = $this->pipeThroughCriterias($query, $queryOption);

        $query->select(
            sprintf("%s.*", AdminRole::TABLE_NAME)
        );

        return $query->paginate(
            $queryOption->getLimit(),
            '*',
            'page',
            $queryOption->getPage()
        );
    }

    protected function getQueryOptionCriterias(): array
    {
        return [
        ];
    }
}
