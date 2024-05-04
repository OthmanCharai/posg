<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Http\Transformers\ArticleTransformer;
use App\src\Models\Article\Article;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;

class ShowArticleController extends Controller
{
    /**
     * @throws BindingResolutionException
     */
    public function __invoke(Article $article): JsonResponse
    {
        return $this->response->withArray(
            ['article' => ArticleTransformer::transform($article->load(array_values(Article::RELATIONS)))]
        );
    }
}
