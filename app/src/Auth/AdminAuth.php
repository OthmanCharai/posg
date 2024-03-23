<?php

namespace App\src\Auth;

use App\src\Models\User\User;
use App\src\Services\User\UserServiceInterface;
use Illuminate\Auth\AuthManager;
use Illuminate\Auth\SessionGuard;
use Illuminate\Contracts\Foundation\Application;

class AdminAuth extends AuthManager
{
    public const GUARD_NAME = 'admins';

    public function __construct(Application $app, private readonly UserServiceInterface $userService)
    {
        parent::__construct($app);
    }

    public function user(): ?User
    {
        $admin = $this->guard()->user();
        if (!$admin instanceof User) {
            return null;
        }

        /* @var User|null */
        return $this->userService->find($admin->getId());
    }

    public function guard($name = null): SessionGuard
    {
        return parent::guard(self::GUARD_NAME);
    }
}
