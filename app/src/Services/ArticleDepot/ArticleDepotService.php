<?php

namespace App\src\Services\ArticleDepot;

use App\src\Models\Article\Article;
use App\src\Models\ArticleDepot\ArticleDepot;
use App\src\Repositories\ArticleDepot\ArticleDepotRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ArticleDepotService implements ArticleDepotServiceInterface
{
    public function __construct(private readonly ArticleDepotRepository $articleDepotRepository)
    {
    }

    public function createMany(Article $article, array $attributes): Collection
    {
        return collect($attributes)->map(
            fn(array $item) => $this->create(array_merge($item, [ArticleDepot::ARTICLE_ID_COLUMN => $article->getId()]))
        );
    }

    public function find(string $value, string $columnName = 'id'): ?ArticleDepot
    {
        /* @var ArticleDepot| null */
        return $this->articleDepotRepository->find($value, $columnName);
    }

    public function update(Model|ArticleDepot $model, array $attributes): bool
    {
        return $this->articleDepotRepository->update($model->getId(), $attributes);
    }

    public function create(array $attributes): ArticleDepot
    {
        /* @var ArticleDepot */
        return $this->articleDepotRepository->create($attributes);
    }

    public function delete(Model|ArticleDepot $model, string $columnName = 'id'): bool
    {
        return $this->articleDepotRepository->delete($model->getId(), $columnName);
    }
}
