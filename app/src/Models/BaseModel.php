<?php

namespace App\src\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

abstract class BaseModel extends Model
{
    public const CREATED_AT_COLUMN = 'created_at';
    public const UPDATED_AT_COLUMN = 'updated_at';

    public function getCreatedAt(): Carbon
    {
        return $this->getAttribute(self::CREATED_AT_COLUMN);
    }

    public function getUpdatedAt(): Carbon
    {
        return $this->getAttribute(self::UPDATED_AT_COLUMN);
    }
}