<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Transformers\ArticleTransformer;
use App\src\Models\Article\Article;
use App\src\Services\Article\ArticleServiceInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Arr;

class CreateArticleController extends Controller
{
    public function __construct(
        private readonly ArticleServiceInterface $articleService
    ) {
        parent::__construct();
    }

    /**
     * @throws BindingResolutionException
     */
    public function __invoke(StoreArticleRequest $request): \Illuminate\Http\JsonResponse
    {
        /* @var Article $article */
        $article = $this->articleService->create($attributes = $request->validated());

        $article->compatibilities()->sync(Arr::get($attributes, 'compatibilities'));

        return $this->response->withArray(
            ['article' => ArticleTransformer::transform($article->load(array_values(Article::RELATIONS)))]
        );
    }
}
