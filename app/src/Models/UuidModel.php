<?php

namespace App\src\Models;

use App\src\Models\BaseModel;
use Tuupola\KsuidFactory;

abstract class UuidModel extends BaseModel
{
    public const ID_COLUMN = 'id';
    public $incrementing = false;
    protected $keyType = "string";

    public function getId(): string
    {
        return $this->getAttribute(self::ID_COLUMN);
    }

    public function getIdColumn(): string
    {
        return self::ID_COLUMN;
    }

    protected static function boot(): void
    {
        parent::boot();

        $prefix = static::getPrefix();

        self::creating(static function ($model) use ($prefix) {
            $model->{$model->getKeyName()} = $prefix . KsuidFactory::create()->string();
        });
    }

    abstract public static function getPrefix(): string;
}