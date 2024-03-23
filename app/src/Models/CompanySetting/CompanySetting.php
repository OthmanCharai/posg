<?php

namespace App\src\Models\CompanySetting;

use App\src\Models\UuidModel;

class CompanySetting extends UuidModel
{
    private const ID_PREFIX = "cms_";
    public const NAME_COLUMN = 'name';
    public const PHONE_COLUMN = 'phone';
    public const EMAIL_COLUMN = 'email';
    public const WEBSITE_COLUMN = 'website';
    public const ADDRESS_COLUMN = 'address';
    public const CAPITAL_COLUMN = 'capital';
    public const NUM_RC_COLUMN = 'num_rc';
    public const NUM_NIF_COLUMN = 'num_nif';
    public const NUM_STATISTIQUE_COLUMN = 'num_statistique';
    public const NUM_BGFI_COLUMN = 'num_bgfi';
    public const NUM_UGB_COLUMN = 'num_ugb';
    public const RETURN_POLICY_COLUMN = 'return_policy';
    public const PATH_COLUMN = "path";

    protected $guarded = [];

    // Getter methods
    public function getName(): string
    {
        return $this->getAttribute(self::NAME_COLUMN);
    }

    public function getPhone(): string
    {
        return $this->getAttribute(self::PHONE_COLUMN);
    }

    public function getEmail(): string
    {
        return $this->getAttribute(self::EMAIL_COLUMN);
    }

    public function getWebsite(): ?string
    {
        return $this->getAttribute(self::WEBSITE_COLUMN);
    }

    public function getAddress(): string
    {
        return $this->getAttribute(self::ADDRESS_COLUMN);
    }

    public function getCapital(): int
    {
        return $this->getAttribute(self::CAPITAL_COLUMN);
    }

    public function getNumRc(): string
    {
        return $this->getAttribute(self::NUM_RC_COLUMN);
    }

    public function getNumNif(): string
    {
        return $this->getAttribute(self::NUM_NIF_COLUMN);
    }

    public function getNumStatistique(): string
    {
        return $this->getAttribute(self::NUM_STATISTIQUE_COLUMN);
    }

    public function getNumBgfi(): string
    {
        return $this->getAttribute(self::NUM_BGFI_COLUMN);
    }

    public function getNumUgb(): string
    {
        return $this->getAttribute(self::NUM_UGB_COLUMN);
    }

    public function getReturnPolicy(): string
    {
        return $this->getAttribute(self::RETURN_POLICY_COLUMN);
    }

    public static function getPrefix(): string
    {
        return self::ID_PREFIX;
    }

    public function getPath(): string
    {
        return $this->getAttribute(self::PATH_COLUMN);
    }
}
