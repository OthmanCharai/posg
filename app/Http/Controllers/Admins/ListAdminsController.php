<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Transformers\DepotTransformer;
use App\Http\Transformers\UserTransformer;
use App\src\Services\Depot\DepotServiceInterface;
use App\src\Services\User\UserServiceInterface;
use Illuminate\Http\Request;
use YouCanShop\QueryOption\QueryOptionFactory;

class ListAdminsController extends Controller
{
    public function __construct(
        private readonly UserServiceInterface $userService,
        private readonly DepotServiceInterface $depotService
    ) {
        parent::__construct();
    }

    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        $admins = $this->userService->getPaginated(QueryOptionFactory::createFromIlluminateRequest($request));

        return $this->response->withArray(
            [
                'users'  => transform_paginator($admins, UserTransformer::class),
                'depots' => transform_collection(
                    $this->depotService->get(),
                    DepotTransformer::class
                ),

            ]
        );
    }
}
