<?php

namespace App\src\Domain\Media\Exceptions;

use App\src\Exceptions\CommonException;

class FileUploadToS3FailedException extends CommonException
{

    public function getLevel(): int
    {
        return 3;
    }
}
