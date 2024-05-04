<?php

namespace App\Http\Controllers\ArticleDepot;

use App\Http\Controllers\Controller;
use App\Http\Requests\SyncArticleDepotRequest;
use App\Http\Transformers\ArticleDepotTransformer;
use App\src\Models\Article\Article;
use App\src\Models\ArticleDepot\ArticleDepot;
use App\src\Services\ArticleDepot\ArticleDepotServiceInterface;

class CreateArticleDepotController extends Controller
{
    public function __construct(private readonly ArticleDepotServiceInterface $articleDepotService)
    {
        parent::__construct();
    }

    public function __invoke(Article $article, SyncArticleDepotRequest $request): \Illuminate\Http\JsonResponse
    {
        /* @var ArticleDepot $articleDepot */
        $articleDepot = $this->articleDepotService->create(
            array_merge($request->validated(), [
                ArticleDepot::ARTICLE_ID_COLUMN => $article->getId(),
            ]),
        );

        return $this->response->withArray(
            [
                'depot' => ArticleDepotTransformer::transform($articleDepot),
            ]
        );
    }
}
