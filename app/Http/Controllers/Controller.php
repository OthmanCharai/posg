<?php

namespace App\Http\Controllers;

use App\src\Auth\AdminAuth;
use App\src\Http\Response;
use App\src\Models\User\User;

abstract class Controller
{
    protected AdminAuth $adminAuth;
    protected ?User $user;
    protected Response $response;

    public function __construct()
    {
        $this->adminAuth = app(AdminAuth::class);
        $this->response = app(Response::class);
    }
}
