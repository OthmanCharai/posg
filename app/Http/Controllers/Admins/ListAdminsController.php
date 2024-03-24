<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\src\Services\User\UserServiceInterface;

class ListAdminsController extends Controller
{
    public function __construct(private readonly UserServiceInterface $userService)
    {
        parent::__construct();
    }

    public function __invoke(): \Illuminate\Http\JsonResponse
    {
        return $this->response->withArray($this->userService->getPaginated()->toArray());
    }
}
