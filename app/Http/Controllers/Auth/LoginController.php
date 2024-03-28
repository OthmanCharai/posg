<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\src\Models\User\User;
use Illuminate\Config\Repository;
use Illuminate\Support\Arr;

class LoginController extends Controller
{
    public function __construct(private readonly Repository $repository)
    {
        parent::__construct();
    }

    public function __invoke(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        $token = auth()->attempt(
            Arr::only(
                $request->validated(),
                [
                    User::EMAIL_COLUMN,
                    User::PASSWORD_COLUMN,
                ]
            ),
            true
        );
        if (!$token) {
            return $this->response->withError('Unauthorized');
        }

        $user = auth()->user();

        if (!$user instanceof User) {
            return $this->response->withError('user not found');
        }

        cookie($this->repository->get('globals.auth_cookie_name'), $token, 10);

        return $this->response->withArray(array_merge($user->toArray(), ['access_token' => $token]))->withCookie(
            cookie($this->repository->get('globals.auth_cookie_name'), $token, 1000)
        );
    }
}
