<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Transformers\UserTransformer;
use App\src\Models\User\User;
use App\src\Services\User\UserServiceInterface;

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

        /* @var User $admin */
        return $this->response->withArray(
            [
                'user' => UserTransformer::transform($user),
            ]
        );
    }
}
