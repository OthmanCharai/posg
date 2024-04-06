<?php

namespace App\Http\Controllers\ArticleCategory;

use App\Http\Controllers\Controller;
use App\src\Models\ArticleCategory\ArticleCategory;
use App\src\Services\ArticleCategory\ArticleCategoryServiceInterface;
use Illuminate\Http\Request;
use YouCanShop\QueryOption\QueryOptionFactory;

class ListArticleCategoryController extends Controller
{
    public function __construct(private readonly ArticleCategoryServiceInterface $articleCategoryService)
    {
        parent::__construct();
    }

    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->response->withArray(
            [
                ArticleCategory::class => $this->articleCategoryService->getPaginated(
                    QueryOptionFactory::createFromIlluminateRequest($request)
                ),
            ]
        );
    }
}
