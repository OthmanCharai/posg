<?php

namespace App\Http\Controllers\ArticleDepot;

use App\Http\Controllers\Controller;
use App\src\Models\ArticleDepot\ArticleDepot;
use App\src\Services\ArticleDepot\ArticleDepotServiceInterface;

class DeleteArticleDepotController extends Controller
{
    public function __construct(private readonly ArticleDepotServiceInterface $articleDepotService)
    {
        parent::__construct();
    }

    public function __invoke(ArticleDepot $articleDepot)
    {
        $this->articleDepotService->delete($articleDepot);

        return $this->response->withSuccess('article depot was deleted with success');
    }
}
