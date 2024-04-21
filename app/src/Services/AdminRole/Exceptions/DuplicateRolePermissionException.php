<?php

namespace App\src\Services\AdminRole\Exceptions;

use App\src\Exceptions\CommonException;
use Psr\Log\LogLevel;

class DuplicateRolePermissionException extends CommonException
{
    public const DEFAULT_CODE = 1;
    public function getLevel(): string
    {
        return LogLevel::ERROR;
    }
}
