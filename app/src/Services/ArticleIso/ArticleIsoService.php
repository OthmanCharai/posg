<?php

namespace App\src\Services\ArticleIso;

use App\src\Models\ArticleIso\ArticleIso;
use App\src\Repositories\ArticleIso\ArticleIsoRepository;
use Illuminate\Database\Eloquent\Model;

readonly class ArticleIsoService implements ArticleIsoServiceInterface
{
    public function __construct(private ArticleIsoRepository $articleIsoRepository)
    {
    }

    public function find(string $value, string $columnName = 'id'): ?ArticleIso
    {
        /* @var ArticleIso|null */
        return $this->articleIsoRepository->find($value, $columnName);
    }

    public function update(Model|ArticleIso $model, array $attributes): bool
    {
        return $this->articleIsoRepository->update($model->getId(), $attributes);
    }

    public function create(array $attributes): ArticleIso
    {
        /* @var ArticleIso */
        return $this->articleIsoRepository->create($attributes);
    }

    public function delete(Model|ArticleIso $model, string $columnName = 'id'): bool
    {
        return $this->articleIsoRepository->delete($model->getId(), $columnName);
    }
}
