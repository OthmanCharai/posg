<?php

namespace App\Http\Controllers;

use App\src\Entities\UserLocator;
use App\src\Http\Response;

abstract class Controller
{
    protected Response $response;
    protected UserLocator $userLocator;

    public function __construct()
    {
        $this->response = app(Response::class);
        $this->userLocator = app(UserLocator::class);
    }
}
