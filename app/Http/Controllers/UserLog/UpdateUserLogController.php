<?php

namespace App\Http\Controllers\UserLog;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserLogRequest;
use App\src\Services\UserLog\UserLogServiceInterface;
use Carbon\Carbon;
use Yungts97\LaravelUserActivityLog\Models\Log;

class UpdateUserLogController extends Controller
{
    public function __construct(private readonly UserLogServiceInterface $userLogService)
    {
        parent::__construct();
    }

    public function __invoke(Log $log, StoreUserLogRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->userLogService->update(
            $log,
            array_merge(
                $request->validated(),
                [
                    'log_datetime' => Carbon::now(),
                    'request_info' => $request->validated(),
                ]
            )
        );

        $updateUserLog = $this->userLogService->find($log->id);

        return $this->response->withArray(
            [
                'log' => $updateUserLog?->toArray(),
            ]
        );
    }
}
