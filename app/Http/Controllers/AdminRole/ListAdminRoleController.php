<?php

namespace App\Http\Controllers\AdminRole;

use App\Http\Controllers\Controller;
use App\src\Services\AdminRole\AdminRoleServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use YouCanShop\QueryOption\QueryOptionFactory;

class ListAdminRoleController extends Controller
{
    public function __construct(private readonly AdminRoleServiceInterface $adminRoleService)
    {
        parent::__construct();
    }

    public function __invoke(Request $request): JsonResponse
    {
        return $this->response->withArray(
            $this->adminRoleService->getPaginated(
                QueryOptionFactory::createFromIlluminateRequest($request)
            )->toArray()
        );
    }
}
