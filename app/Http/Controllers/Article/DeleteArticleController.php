<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\src\Models\Article\Article;
use App\src\Services\Article\ArticleServiceInterface;

class DeleteArticleController extends Controller
{
    public function __construct(private readonly ArticleServiceInterface $articleService)
    {
        parent::__construct();
    }

    public function __invoke(Article $article)
    {
        $this->articleService->delete($article);

        return $this->response->withSuccess('article was deleted with success');
    }
}
