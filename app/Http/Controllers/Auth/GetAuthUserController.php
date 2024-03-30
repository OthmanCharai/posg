<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\src\Models\User\User;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;

class GetAuthUserController extends Controller
{
    /**
     * @throws UserNotDefinedException
     */
    public function __invoke(): \Illuminate\Http\JsonResponse
    {
        $user = auth()->user();
        if (!$user instanceof User) {
            throw new UserNotDefinedException();
        }

        return $this->response->withArray($user->toArray());
    }
}
