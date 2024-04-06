<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Transformers\DepotTransformer;
use App\Http\Transformers\UserTransformer;
use App\src\Models\Depot\Depot;
use App\src\Models\User\User;
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
                User::TABLE_NAME  => transform_paginator($admins, UserTransformer::class),
                Depot::TABLE_NAME => transform_collection(
                    $this->depotService->get(),
                    DepotTransformer::class
                ),

            ]
        );
    }
}
