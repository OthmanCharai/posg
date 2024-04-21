<?php

namespace App\src\Domain\Permissions\Exceptions;

use App\src\Exceptions\CommonException;

class UnauthorizedException extends CommonException
{
    public function getLevel(): int
    {
        return 4;
    }
}
