<?php

namespace App\src\Services\UserLog;

use App\src\Repositories\UserLog\UserLogRepository;
use Yungts97\LaravelUserActivityLog\Models\Log;

readonly class UserLogService implements UserLogServiceInterface
{
    public function __construct(private UserLogRepository $userLogRepository)
    {
    }

    public function find(int $value): ?Log
    {
        /* @var Log|null */
        return $this->userLogRepository->find($value);
    }

    public function update(Log $model, array $attributes): bool
    {
        return $this->userLogRepository->update($model->getAttribute('id'), $attributes);
    }

    public function create(array $attributes): Log
    {
        /* @var Log */
        return $this->userLogRepository->create($attributes);
    }

    public function delete(Log $log): bool
    {
        return $this->userLogRepository->delete($log->getAttribute('id'));
    }
}
