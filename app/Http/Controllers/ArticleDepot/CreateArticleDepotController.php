<?php

namespace App\Http\Controllers\ArticleDepot;

use App\Http\Controllers\Controller;
use App\Http\Requests\SyncArticleDepotRequest;
use App\Http\Transformers\ArticleDepotTransformer;
use App\src\Models\Article\Article;
use App\src\Services\ArticleDepot\ArticleDepotServiceInterface;
use Illuminate\Support\Arr;

class CreateArticleDepotController extends Controller
{
    public function __construct(private readonly ArticleDepotServiceInterface $articleDepotService)
    {
        parent::__construct();
    }

    public function __invoke(Article $article, SyncArticleDepotRequest $request): \Illuminate\Http\JsonResponse
    {
        $articleDepotCollection = $this->articleDepotService->createMany(
            $article,
            Arr::get($request->validated(), 'depots')
        );

        return $this->response->withArray(
            [
                'depots' => transform_collection($articleDepotCollection, ArticleDepotTransformer::class),
            ]
        );
    }
}
