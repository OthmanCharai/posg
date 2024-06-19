<?php

namespace App\Http\Controllers\UserLog;

use App\Http\Controllers\Controller;
use App\Http\Transformers\UserTransformer;
use App\src\Services\User\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class GetUserLogCreatingDataController extends Controller
{
    public function __construct(private readonly UserServiceInterface $userService)
    {
        parent::__construct();
    }

    public function __invoke(): JsonResponse
    {

        $users = $this->userService->get();

        return $this->response->withArray(
            [
                'tables' => DB::select('SHOW TABLES'),
                'users'  => transform_collection($users, UserTransformer::class),
            ]
        );
    }
}
