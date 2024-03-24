<?php

namespace App\src\Services;

use Illuminate\Database\Eloquent\Model;

interface BaseInterface
{
    public function find(string $value, string $columnName = 'id'): ?Model;

    public function update(Model $model, array $attributes): bool;

    public function create(array $attributes): Model;

    public function delete(Model $model, string $columnName = 'id'): bool;
}
