<?php

namespace App\src\Domain\Media\Exceptions;

use App\src\Exceptions\CommonException;

class FileDeleteFromS3FailedException extends CommonException
{
    public function getLevel(): int
    {
        return 2;
    }
}
