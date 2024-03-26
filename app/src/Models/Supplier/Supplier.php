<?php

namespace App\src\Models\Supplier;

use App\src\Models\UuidModel;

class Supplier extends UuidModel
{
    private const ID_PREFIX = 'sup_';

    public static function getPrefix(): string
    {
        return self::ID_PREFIX;
    }

    protected $guarded = [];

    public const COMPANY_NAME_COLUMN = 'company_name';
    public const ADDRESS_COLUMN = 'address';
    public const VAT_NUMBER_COLUMN = 'vat_number';
    public const ACCOUNT_NUMBER_COLUMN = 'account_number';
    public const LAST_NAME_COLUMN = 'last_name';
    public const FIRST_NAME_COLUMN = 'first_name';
    public const EMAIL_COLUMN = 'email';
    public const PHONE_NUMBER_COLUMN = 'phone_number';

    public function getCompanyName(): string
    {
        return $this->getAttribute(self::COMPANY_NAME_COLUMN);
    }

    public function getAddress(): ?string
    {
        return $this->getAttribute(self::ADDRESS_COLUMN);
    }

    public function getVatNumber(): ?string
    {
        return $this->getAttribute(self::VAT_NUMBER_COLUMN);
    }

    public function getAccountNumber(): ?string
    {
        return $this->getAttribute(self::ACCOUNT_NUMBER_COLUMN);
    }

    public function getLastName(): ?string
    {
        return $this->getAttribute(self::LAST_NAME_COLUMN);
    }

    public function getFirstName(): ?string
    {
        return $this->getAttribute(self::FIRST_NAME_COLUMN);
    }

    public function getEmail(): ?string
    {
        return $this->getAttribute(self::EMAIL_COLUMN);
    }

    public function getPhoneNumber(): ?string
    {
        return $this->getAttribute(self::PHONE_NUMBER_COLUMN);
    }
}
