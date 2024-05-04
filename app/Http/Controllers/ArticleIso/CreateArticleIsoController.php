<?php

namespace App\Http\Controllers\ArticleIso;

use App\Http\Controllers\Controller;
use App\Http\Transformers\ArticleIsoTransformer;
use App\src\Models\Article\Article;
use App\src\Models\ArticleIso\ArticleIso;
use App\src\Services\ArticleIso\ArticleIsoServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateArticleIsoController extends Controller
{
    public function __construct(private readonly ArticleIsoServiceInterface $articleIsoService)
    {
        parent::__construct();
    }

    public function __invoke(Article $article, Request $request): JsonResponse
    {
        $data = $request->validate(
            [
                ArticleIso::VALUE_COLUMN => 'required|string|max:255',
            ]
        );
        /* @var ArticleIso $articleIso */
        $articleIso = $this->articleIsoService->create(
            array_merge($data, [ArticleIso::ARTICLE_ID_COLUMN => $article->getId()])
        );

        return $this->response->withArray(
            [
                'article_iso' => ArticleIsoTransformer::transform($articleIso),
            ]
        );
    }
}
