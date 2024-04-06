<?php

namespace App\src\Models\User;

use App\src\Models\UuidModel;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as Authenticated;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends UuidModel implements JWTSubject, Authenticated
{
    use HasRelations, Authenticatable;

    public const FIRST_NAME_COLUMN = "first_name";
    public const LAST_NAME_COLUMN = "last_name";
    public const EMAIL_COLUMN = "email";
    public const PHONE_NUMBER_COLUMN = "phone_number";
    public const ADDRESS_COLUMN = "address";
    public const PASSWORD_COLUMN = 'password';
    public const ROLE_ID_COLUMN = 'role_id';
    public const LOGO_COLUMN = 'logo';
    public const DEPOT_ID_COLUMN = 'depot_id';

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

    public function getRoleId(): string
    {
        return $this->getAttribute(self::ROLE_ID_COLUMN);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getLogo(): ?string
    {
        return $this->getAttribute(self::LOGO_COLUMN);
    }

    public function getDepotId(): ?string
    {
        return $this->getAttribute(self::DEPOT_ID_COLUMN);
    }
}
