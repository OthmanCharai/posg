<?php

namespace App\src\Domain\Permissions\Exceptions;

use App\src\Exceptions\CommonException;
use Psr\Log\LogLevel;

class UnauthorizedException extends CommonException
{
    public function getLevel(): string
    {
        return LogLevel::ALERT;
    }
}
