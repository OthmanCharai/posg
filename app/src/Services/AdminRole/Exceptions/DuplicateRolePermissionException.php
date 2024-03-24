<?php

namespace App\src\Services\AdminRole\Exceptions;

use App\src\Exceptions\CommonException;
use Psr\Log\LogLevel;

class DuplicateRolePermissionException extends CommonException
{
    public function getLevel(): string
    {
        return LogLevel::ERROR;
    }
}
