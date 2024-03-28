<?php

namespace App\src\Models\BankAccount;

use App\src\Models\UuidModel;

class BankAccount extends UuidModel
{
    public const BANK_NAME_COLUMN = 'bank_name';
    public const ACCOUNT_NUMBER_COLUMN = 'account_number';
    public const BALANCE_COLUMN = 'balance';
    public const ACCOUNT_HOLDER_NAME_COLUMN = 'account_holder_name';
    public const ACCOUNT_HOLDER_PHONE_COLUMN = 'account_holder_phone';
    public const ACCOUNT_HOLDER_EMAIL_COLUMN = 'account_holder_email';
    private const ID_PREFIX = "bnc_";
    public final const  TABLE_NAME = "bank_accounts";

    protected $guarded = [];

    public function getBankName(): string
    {
        return $this->getAttribute(self::BANK_NAME_COLUMN);
    }

    public function getAccountNumber(): string
    {
        return $this->getAttribute(self::ACCOUNT_NUMBER_COLUMN);
    }

    public function getBalance(): float
    {
        return (float)number_format($this->getAttribute(self::BALANCE_COLUMN), 2, '.', '');
    }

    public function getAccountHolderName(): string
    {
        return $this->getAttribute(self::ACCOUNT_HOLDER_NAME_COLUMN);
    }

    public function getAccountHolderPhone(): string
    {
        return $this->getAttribute(self::ACCOUNT_HOLDER_PHONE_COLUMN);
    }

    public function getAccountHolderEmail(): string
    {
        return $this->getAttribute(self::ACCOUNT_HOLDER_EMAIL_COLUMN);
    }

    public static function getPrefix(): string
    {
        return self::ID_PREFIX;
    }
}
