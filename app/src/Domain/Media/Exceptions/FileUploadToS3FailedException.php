<?php

namespace App\src\Domain\Media\Exceptions;

use App\src\Exceptions\CommonException;
use Psr\Log\LogLevel;

class FileUploadToS3FailedException extends CommonException
{

    public function getLevel(): string
    {
        return LogLevel::ERROR;
    }
}
