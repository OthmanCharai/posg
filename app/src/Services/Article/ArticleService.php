<?php

namespace App\src\Services\Article;

use App\src\Domain\Media\Exceptions\FileDeleteFromS3FailedException;
use App\src\Domain\Media\Exceptions\FileUploadToS3FailedException;
use App\src\Domain\Media\MediaService;
use App\src\Models\Article\Article;
use App\src\Repositories\Article\ArticleRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use YouCanShop\QueryOption\QueryOption;

readonly class ArticleService implements ArticleServiceInterface
{
    public function __construct(
        private ArticleRepository $articleRepository,
        private MediaService $mediaService
    ) {
    }

    public function getPaginated(QueryOption $queryOption): LengthAwarePaginator
    {
        return $this->articleRepository->getPaginated($queryOption);
    }

    public function find(string $value, string $columnName = 'id'): ?Article
    {
        /* @var Article|null */
        return $this->articleRepository->find($value);
    }

    /**
     * @throws FileUploadToS3FailedException
     * @throws FileDeleteFromS3FailedException
     */
    public function update(Model|Article $model, array $attributes): bool
    {
        $uploadedImage = $model->getImage();
        if (!is_null($image = Arr::get($attributes, Article::IMAGE_COLUMN))) {
            $this->mediaService->delete($model->getImage());
            $uploadedImage = $this->mediaService->save('art_', $image);
        }

        return $this->articleRepository->update(
            $model->getId(),
            array_merge(
                Arr::only($attributes, [
                    Article::BARCODE_COLUMN,
                    Article::NAME_COLUMN,
                    Article::STOCK_TYPE_COLUMN,
                    Article::SUPPLIER_ID_COLUMN,
                    Article::CATEGORY_ID_COLUMN,
                    Article::PURCHASE_PRICE_COLUMN,
                    Article::LAST_SALE_PRICE_COLUMN,
                    Article::RETAIL_PRICE_COLUMN,
                    Article::WHOLESALE_PRICE_COLUMN,
                    Article::DESCRIPTION_COLUMN,
                    Article::LOCATION_COLUMN,
                    Article::BRAND_ID_COLUMN,
                ]),
                [
                    Article::IMAGE_COLUMN => $uploadedImage,
                ]
            )
        );
    }

    /**
     * @throws FileUploadToS3FailedException
     */
    public function create(array $attributes): Model
    {
        $uploadedImage = $this->mediaService->save('art_', Arr::get($attributes, Article::IMAGE_COLUMN));

        return $this->articleRepository->create(
            array_merge(
                Arr::only($attributes, [
                    Article::BARCODE_COLUMN,
                    Article::NAME_COLUMN,
                    Article::STOCK_TYPE_COLUMN,
                    Article::SUPPLIER_ID_COLUMN,
                    Article::CATEGORY_ID_COLUMN,
                    Article::PURCHASE_PRICE_COLUMN,
                    Article::LAST_SALE_PRICE_COLUMN,
                    Article::RETAIL_PRICE_COLUMN,
                    Article::WHOLESALE_PRICE_COLUMN,
                    Article::DESCRIPTION_COLUMN,
                    Article::LOCATION_COLUMN,
                    Article::BRAND_ID_COLUMN,
                ]),
                [
                    Article::IMAGE_COLUMN => $uploadedImage,
                ]
            )
        );
    }

    public function delete(Model|Article $model, string $columnName = 'id'): bool
    {
        return $this->articleRepository->delete($model->getId());
    }
}
