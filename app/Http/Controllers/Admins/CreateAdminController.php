<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Transformers\UserTransformer;
use App\src\Models\User\User;
use App\src\Services\User\UserServiceInterface;

class CreateAdminController extends Controller
{
    public function __construct(private readonly UserServiceInterface $userService)
    {
        parent::__construct();
    }

    public function __invoke(StoreUserRequest $request): \Illuminate\Http\JsonResponse
    {
        /* @var User $user */
        $user = $this->userService->create($request->validated());

        return $this->response->withArray(
            [
                'user' => UserTransformer::transform($user),
            ]
        );
    }
}
