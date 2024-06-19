<?php

namespace App\src\Entities\TypedCollections;

use App\src\Entities\TypedCollection;
use App\src\Models\User\User;

class UserCollection extends TypedCollection
{
    protected static array $allowedTypes = [User::class];
}
