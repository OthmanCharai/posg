<?php

namespace App\src\Services;

use Illuminate\Database\Eloquent\Model;

interface BaseInterface
{
    public function find(string $value, string $columnName = 'id'): ?Model;

    public function update(string $id, array $attributes): bool;

    public function create(array $attributes): Model;

    public function delete(string $value, string $columnName = 'id'): bool;
}
