<?php

namespace App\Http\Controllers\UserLog;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserLogRequest;
use App\src\Services\UserLog\UserLogServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class CreateUserLogController extends Controller
{
    public function __construct(private readonly UserLogServiceInterface $userLogService)
    {
        parent::__construct();
    }

    public function __invoke(StoreUserLogRequest $request): JsonResponse
    {
        $log = $this->userLogService->create(
            array_merge(
                $request->validated(),
                [
                    'log_datetime' => Carbon::now(),
                    'request_info' => $request->validated(),
                ]
            )
        );

        return $this->response->withArray(
            [
                'log' => $log->toArray(),
            ]
        );
    }
}
