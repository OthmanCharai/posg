<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
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

        return $this->response->withSuccess('user updated with success');
    }
}
