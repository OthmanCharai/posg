<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Transformers\ArticleTransformer;
use App\src\Models\Article\Article;
use App\src\Services\Article\ArticleServiceInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Arr;

class UpdateArticleController extends Controller
{
    public function __construct(private readonly ArticleServiceInterface $articleService)
    {
        parent::__construct();
    }

    /**
     * @throws BindingResolutionException
     */
    public function __invoke(Article $article, UpdateArticleRequest $request)
    {
        $this->articleService->update($article, $attributes = $request->validated());

        $article->depots()->syncWithoutDetaching(Arr::get($attributes, 'depots'));

        $article->compatibilities()->syncWithoutDetaching(Arr::get($attributes, 'compatibilities'));

        /* @var Article $updatedArticle */
        $updatedArticle = $this->articleService->find($article->getId()); //todo: load rlt if needed

        return $this->response->withArray(ArticleTransformer::transform($updatedArticle));
    }
}
