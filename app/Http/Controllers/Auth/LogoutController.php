<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function __invoke(): \Illuminate\Http\JsonResponse
    {
        $this->adminAuth->logout();

        return $this->response->withSuccess('admin logged out with success');
    }
}
