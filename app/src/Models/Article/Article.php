<?php

namespace App\src\Models\Article;

use App\src\Models\UuidModel;

class Article extends UuidModel
{
    use HasRelations;

    public const BARCODE_COLUMN = 'code_bare';
    public const NAME_COLUMN = 'name';
    public const LOCATION_COLUMN = 'emplacement';
    public const PURCHASE_PRICE_COLUMN = 'purchase_price';
    public const WHOLESALE_PRICE_COLUMN = 'wholesale_price';
    public const RETAIL_PRICE_COLUMN = 'retail_price';
    public const LAST_SALE_PRICE_COLUMN = 'last_sale_price';
    public const STOCK_TYPE_COLUMN = 'stock_type';
    public const DESCRIPTION_COLUMN = 'description';
    public const IMAGE_COLUMN = 'image';
    public const BRAND_ID_COLUMN = 'brand_id';
    public const CATEGORY_ID_COLUMN = 'article_category_id';
    public const SUPPLIER_ID_COLUMN = 'supplier_id';
    private const ID_PREFIX = 'art_';
    public const TABLE_NAME = 'articles';

    public function getBarcode(): string
    {
        return $this->getAttribute(self::BARCODE_COLUMN);
    }

    public function getName(): string
    {
        return $this->getAttribute(self::NAME_COLUMN);
    }

    public function getLocation(): string
    {
        return $this->getAttribute(self::LOCATION_COLUMN);
    }

    public function getPurchasePrice(): int
    {
        return $this->getAttribute(self::PURCHASE_PRICE_COLUMN);
    }

    public function getWholesalePrice(): int
    {
        return $this->getAttribute(self::WHOLESALE_PRICE_COLUMN);
    }

    public function getRetailPrice(): int
    {
        return $this->getAttribute(self::RETAIL_PRICE_COLUMN);
    }

    public function getLastSalePrice(): int
    {
        return $this->getAttribute(self::LAST_SALE_PRICE_COLUMN);
    }

    public function getStockType(): int
    {
        return $this->getAttribute(self::STOCK_TYPE_COLUMN);
    }

    public function getDescription(): ?string
    {
        return $this->getAttribute(self::DESCRIPTION_COLUMN);
    }

    public function getImage(): ?string
    {
        return $this->getAttribute(self::IMAGE_COLUMN);
    }

    public function getBrandId(): string
    {
        return $this->getAttribute(self::BRAND_ID_COLUMN);
    }

    public function getCategory(): string
    {
        return $this->getAttribute(self::CATEGORY_ID_COLUMN);
    }

    public function getSupplierId(): string
    {
        return $this->getAttribute(self::SUPPLIER_ID_COLUMN);
    }

    public static function getPrefix(): string
    {
        return self::ID_PREFIX;
    }
}