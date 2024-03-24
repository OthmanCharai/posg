<?php

namespace App\src\Models\User;

use App\src\Models\UuidModel;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends UuidModel implements JWTSubject
{
    use HasRelations;

    public const FIRST_NAME_COLUMN = "first_name";
    public const LAST_NAME_COLUMN = "last_name";
    public const EMAIL_COLUMN = "email";
    public const PHONE_NUMBER_COLUMN = "phone_number";
    public const ADDRESS_COLUMN = "address_column";
    public const PASSWORD_COLUMN = 'password';

    public const TABLE_NAME = "users";
    private const ID_PREFIX = 'usr_';
    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public static function getPrefix(): string
    {
        return self::ID_PREFIX;
    }

    public function getFirstName(): string
    {
        return $this->getAttribute(self::FIRST_NAME_COLUMN);
    }

    public function getLastName(): string
    {
        return $this->getAttribute(self::LAST_NAME_COLUMN);
    }

    public function getEmail()
    {
        return $this->getAttribute(self::EMAIL_COLUMN);
    }

    public function getPhone(): ?string
    {
        return $this->getAttribute(self::PHONE_NUMBER_COLUMN);
    }

    public function getAddress(): ?string
    {
        return $this->getAttribute(self::ADDRESS_COLUMN);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
