<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\src\Models\User\User;
use App\src\Services\User\UserServiceInterface;

class DeleteAdminController extends Controller
{
    public function __construct(private readonly UserServiceInterface $userService)
    {
        parent::__construct();
    }

    public function __invoke(User $user): \Illuminate\Http\JsonResponse
    {
        $this->userService->delete($user);

        return $this->response->withSuccess('user deleted with success');
    }
}
