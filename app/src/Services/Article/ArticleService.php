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
        $this->mediaService->delete($model->getImage());
        $uploadedImage = $this->mediaService->save('art_', Arr::get($attributes, Article::IMAGE_COLUMN));

        return $this->articleRepository->update(
            $model->getId(),
            array_merge(
                $attributes,
                [
                    Article::IMAGE_COLUMN => $uploadedImage,
                ]
            )
        );
    }

    public function create(array $attributes): Model
    {
        $uploadedImage = $this->mediaService->save('art_', Arr::get($attributes, Article::IMAGE_COLUMN));

        return $this->articleRepository->create(
            array_merge(
                $attributes,
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
