<?php

namespace App\Http\Controllers\ArticleDepot;

use App\Http\Controllers\Controller;
use App\Http\Transformers\ArticleDepotTransformer;
use App\src\Models\ArticleDepot\ArticleDepot;
use App\src\Models\Depot\Depot;
use App\src\Services\ArticleDepot\ArticleDepotServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateArticleDepotController extends Controller
{
    public function __construct(private readonly ArticleDepotServiceInterface $articleDepotService)
    {
        parent::__construct();
    }

    public function __invoke(ArticleDepot $articleDepot, Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate(
            [
                ArticleDepot::DEPOT_ID_COLUMN => ['required', Rule::exists(Depot::TABLE_NAME, Depot::ID_COLUMN)],
                ArticleDepot::QUANTITY_COLUMN => ['required', 'numeric', 'min:0'],
            ]
        );

        $this->articleDepotService->update($articleDepot, $data);

        /* @var ArticleDepot $updatedArticleDepot */
        $updatedArticleDepot = $this->articleDepotService->find($articleDepot->getId());

        return $this->response->withArray(
            [
                'depot' => ArticleDepotTransformer::transform($updatedArticleDepot),
            ]
        );
    }
}
