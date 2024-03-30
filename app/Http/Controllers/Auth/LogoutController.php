<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;

class LogoutController extends Controller
{
    /**
     * @throws UserNotDefinedException
     */
    public function __invoke(): \Illuminate\Http\JsonResponse
    {
        auth()->logout($this->userLocator->getUser());

        return $this->response->withSuccess('admin logged out with success');
    }
}
