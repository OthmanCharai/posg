<?php

namespace App\Http\Controllers;

use App\src\Http\Response;
use App\src\Models\User\User;

abstract class Controller
{
    protected ?User $user;
    protected Response $response;

    public function __construct()
    {
        $this->response = app(Response::class);
    }
}
