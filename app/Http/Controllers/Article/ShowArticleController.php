<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Http\Transformers\ArticleTransformer;
use App\src\Models\Article\Article;
use Illuminate\Contracts\Container\BindingResolutionException;

class ShowArticleController extends Controller
{
    /**
     * @throws BindingResolutionException
     */
    public function __invoke(Article $article)
    {
        return $this->response->withArray(ArticleTransformer::transform(load_relations($article, Article::RELATIONS)));
    }
}
