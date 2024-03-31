<?php

namespace App\Http\Controllers\ArticleCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateArticleCategoryRequest;
use App\src\Models\ArticleCategory\ArticleCategory;
use App\src\Services\ArticleCategory\ArticleCategoryServiceInterface;

class UpdateArticleCategoryController extends Controller
{
    public function __construct(private readonly ArticleCategoryServiceInterface $articleCategoryService)
    {
        parent::__construct();
    }

    public function __invoke(
        ArticleCategory $articleCategory,
        UpdateArticleCategoryRequest $request
    ): \Illuminate\Http\JsonResponse {
        $this->articleCategoryService->update($articleCategory, $request->validated());

        /* @var ArticleCategory $updatedArticle */
        $updatedArticle = $this->articleCategoryService->find($articleCategory->getId());

        return $this->response->withArray($updatedArticle->toArray());
    }
}
