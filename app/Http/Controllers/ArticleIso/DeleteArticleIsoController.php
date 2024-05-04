<?php

namespace App\Http\Controllers\ArticleIso;

use App\Http\Controllers\Controller;
use App\src\Models\ArticleIso\ArticleIso;
use App\src\Services\ArticleIso\ArticleIsoServiceInterface;
use Illuminate\Http\JsonResponse;

class DeleteArticleIsoController extends Controller
{
    public function __construct(private readonly ArticleIsoServiceInterface $articleIsoService)
    {
        parent::__construct();
    }

    public function __invoke(ArticleIso $articleIso): JsonResponse
    {
        $this->articleIsoService->delete($articleIso);

        return $this->response->withSuccess('article iso was deleted with success');
    }
}
