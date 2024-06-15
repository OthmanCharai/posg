<?php

namespace App\Http\Controllers\UserLog;

use App\Http\Controllers\Controller;
use App\src\Services\UserLog\UserLogServiceInterface;
use Illuminate\Http\JsonResponse;
use Yungts97\LaravelUserActivityLog\Models\Log;

class DeleteUserLogController extends Controller
{
    public function __construct(private readonly UserLogServiceInterface $userLogService)
    {
        parent::__construct();
    }

    public function __invoke(Log $log): JsonResponse
    {
        $this->userLogService->delete($log);

        return $this->response->withSuccess('user log was deleted with success');
    }
}
