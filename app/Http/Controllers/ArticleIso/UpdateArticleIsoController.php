<?php

namespace App\Http\Controllers\ArticleIso;

use App\Http\Controllers\Controller;
use App\Http\Transformers\ArticleIsoTransformer;
use App\src\Models\ArticleIso\ArticleIso;
use App\src\Services\ArticleIso\ArticleIsoServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateArticleIsoController extends Controller
{
    public function __construct(private readonly ArticleIsoServiceInterface $articleIsoService)
    {
        parent::__construct();
    }

    public function __invoke(ArticleIso $articleIso, Request $request): JsonResponse
    {
        $data = $request->validate(
            [
                ArticleIso::VALUE_COLUMN => 'required|string|max:255',
            ]
        );
        $this->articleIsoService->update($articleIso, $data);

        /* @var ArticleIso $updatedArticleIso */
        $updatedArticleIso = $this->articleIsoService->find($articleIso->getId());

        return $this->response->withArray(
            [
                'article_iso' => ArticleIsoTransformer::transform($updatedArticleIso),
            ]
        );
    }
}
