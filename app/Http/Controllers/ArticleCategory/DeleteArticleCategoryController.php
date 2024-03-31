<?php

namespace App\Http\Controllers\ArticleCategory;

use App\Http\Controllers\Controller;
use App\src\Models\ArticleCategory\ArticleCategory;
use App\src\Services\ArticleCategory\ArticleCategoryServiceInterface;

class DeleteArticleCategoryController extends Controller
{
    public function __construct(private readonly ArticleCategoryServiceInterface $articleCategoryService)
    {
        parent::__construct();
    }

    public function __invoke(ArticleCategory $articleCategory): \Illuminate\Http\JsonResponse
    {
        $this->articleCategoryService->delete($articleCategory);

        return $this->response->withSuccess('article category deleted with success');
    }
}
