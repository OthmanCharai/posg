<?php

namespace App\src\Services\AdminRole\Exceptions;

use App\src\Exceptions\CommonException;

class DuplicateRolePermissionException extends CommonException
{
    public function getLevel(): int
    {
        return 1;
    }
}
