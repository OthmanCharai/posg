<?php

namespace App\Http\Transformers;

use App\src\Domain\Media\MediaService;
use App\src\Models\Article\Article;
use App\src\Models\Article\Enums\ArticleStockTypeEnum;
use App\src\Models\ArticleCategory\ArticleCategory;
use App\src\Models\Brands\Brand;
use App\src\Models\Compatibility\Compatibility;
use App\src\Models\Depot\Depot;
use App\src\Models\Supplier\Supplier;
use Illuminate\Contracts\Container\BindingResolutionException;

class ArticleTransformer
{
    /**
     * @throws BindingResolutionException
     */
    public static function transform(Article $article): array
    {
        $mediaService = make(MediaService::class);
        $data = [
            Article::NAME_COLUMN            => $article->getName(),
            Article::ID_COLUMN              => $article->getId(),
            Article::DESCRIPTION_COLUMN     => $article->getDescription(),
            Article::LOCATION_COLUMN        => $article->getLocation(),
            Article::IMAGE_COLUMN           => $mediaService->url($article->getImage()),
            Article::STOCK_TYPE_COLUMN      => ArticleStockTypeEnum::from($article->getStockType()),
            Article::WHOLESALE_PRICE_COLUMN => $article->getWholesalePrice()->getAmount(),
            Article::PURCHASE_PRICE_COLUMN  => $article->getPurchasePrice()->getAmount(),
            Article::RETAIL_PRICE_COLUMN    => $article->getRetailPrice()->getAmount(),
            Article::LAST_SALE_PRICE_COLUMN => $article->getLastSalePrice()->getAmount(),
            'currency'                      => Article::CURRENCY_VALUE,
        ];

        if ($article->relationLoaded(Article::RELATIONS[ArticleCategory::class])) {
            $data['category'] = ArticleCategoryTransformer::transform($article->getArticleCategory());
        }

        if ($article->relationLoaded(Article::RELATIONS[Supplier::class])) {
            $data['supplier'] = SupplierTransformer::transform($article->getSupplier());
        }

        if ($article->relationLoaded(Article::RELATIONS[Brand::class])) {
            $data['brand'] = BrandTransformer::transform($article->getBrand());
        }

        if ($article->relationLoaded(Article::RELATIONS[Depot::class])) {
            $data['depots'] = transform_collection($article->getDepots(), DepotTransformer::class)->toArray();
        }

        if ($article->relationLoaded(Article::RELATIONS[Compatibility::class])) {
            $data['compatibilities'] = transform_collection(
                $article->getCompatibilities(),
                CompatibilityTransformer::class
            )->toArray();
        }

        return $data;
    }
}
