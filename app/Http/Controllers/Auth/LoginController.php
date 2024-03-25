<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\src\Models\User\User;
use Illuminate\Support\Arr;

class LoginController extends Controller
{
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

        return $this->response->withArray(array_merge($user->toArray(), ['access_token' => $token]));
    }
}
