<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Transformers\UserTransformer;
use App\src\Models\AdminRole\AdminRole;
use App\src\Models\User\User;
use App\src\Services\User\UserServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateAdminController extends Controller
{
    public function __construct(private readonly UserServiceInterface $userService)
    {
        parent::__construct();
    }

    public function __invoke(User $user, UpdateUserRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->userService->update($user, $request->validated());

        $admin = $this->userService->find($user->getId());
        if (!$admin instanceof User) {
            throw new ModelNotFoundException();
        }

        return $this->response->withArray(
            [
                'user' => UserTransformer::transform($admin->load(User::RELATIONS[AdminRole::class])),
            ]
        );
    }
}
