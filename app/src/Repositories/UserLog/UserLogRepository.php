<?php

namespace App\src\Repositories\UserLog;

use Yungts97\LaravelUserActivityLog\Models\Log;

class UserLogRepository
{
    public function create(array $attributes): Log
    {
        /* @var Log */
        return Log::query()->create($attributes);
    }

    public function find(int $id): ?Log
    {
        /* @var Log|null */
        return Log::query()->find($id);
    }

    public function update(int $id, array $attributes): bool
    {
        return Log::query()->where('id', $id)->first()?->update($attributes) > 0;
    }

    public function delete(int $id): bool
    {
        return $this->find($id)?->delete() > 0;
    }
}
