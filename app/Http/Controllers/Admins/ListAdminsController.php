<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\src\Services\User\UserServiceInterface;
use Illuminate\Http\Request;
use YouCanShop\QueryOption\QueryOptionFactory;

class ListAdminsController extends Controller
{
    public function __construct(private readonly UserServiceInterface $userService)
    {
        parent::__construct();
    }

    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->response->withArray(
            $this->userService->getPaginated(QueryOptionFactory::createFromIlluminateRequest($request))->toArray()
        );
    }
}
