<?php

namespace App\src\Services\ArticleCategory;

use App\src\Models\ArticleCategory\ArticleCategory;
use App\src\Repositories\ArticleCategory\ArticleCategoryRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use YouCanShop\QueryOption\QueryOption;

class ArticleCategoryService implements ArticleCategoryServiceInterface
{
    public function __construct(private readonly ArticleCategoryRepository $articleCategoryRepository)
    {
    }

    public function getPaginated(QueryOption $queryOption): LengthAwarePaginator
    {
        return $this->articleCategoryRepository->getPaginated($queryOption);
    }

    public function find(string $value, string $columnName = 'id'): ?ArticleCategory
    {
        /* @var ArticleCategory|null */
        return $this->articleCategoryRepository->find($value, $columnName);
    }

    public function update(Model|ArticleCategory $model, array $attributes): bool
    {
        return $this->articleCategoryRepository->update($model->getId(), $attributes);
    }

    public function create(array $attributes): ArticleCategory
    {
        /* @var ArticleCategory */
        return $this->articleCategoryRepository->create($attributes);
    }

    public function delete(Model|ArticleCategory $model, string $columnName = 'id'): bool
    {
        return $this->articleCategoryRepository->delete($model->getId());
    }
}
