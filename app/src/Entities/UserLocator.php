<?php

namespace App\src\Entities;

use App\src\Models\User\User;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;

class UserLocator
{
    private ?User $user = null;

    /**
     * @throws UserNotDefinedException
     */
    public function getUser(): User
    {
        if ($this->user instanceof User) {
            return $this->user;
        }
        throw new UserNotDefinedException();
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
