<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Transformers\RoleTransformer;
use App\Http\Transformers\UserTransformer;
use App\src\Models\User\User;
use App\src\Services\AdminRole\AdminRoleServiceInterface;

class ShowAdminController extends Controller
{
    public function __construct(private readonly AdminRoleServiceInterface $adminRoleService)
    {
        parent::__construct();
    }

    public function __invoke(User $user): \Illuminate\Http\JsonResponse
    {
        return $this->response->withArray(
            [
                'user'  => UserTransformer::transform($user),
                'roles' => transform_collection($this->adminRoleService->get(), RoleTransformer::class)->toArray(),
            ]
        );
    }
}
