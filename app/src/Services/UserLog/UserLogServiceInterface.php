<?php

namespace App\src\Services\UserLog;

use Yungts97\LaravelUserActivityLog\Models\Log;

interface UserLogServiceInterface
{
    public function find(int $value): ?Log;

    public function update(Log $model, array $attributes): bool;

    public function create(array $attributes): Log;

    public function delete(Log $log): bool;
}
