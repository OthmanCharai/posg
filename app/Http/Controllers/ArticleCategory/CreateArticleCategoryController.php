<?php

namespace App\Http\Controllers\ArticleCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleCategoryRequest;
use App\src\Services\ArticleCategory\ArticleCategoryServiceInterface;

class CreateArticleCategoryController extends Controller
{
    public function __construct(private readonly ArticleCategoryServiceInterface $articleCategoryService)
    {
        parent::__construct();
    }

    public function __invoke(StoreArticleCategoryRequest $request): \Illuminate\Http\JsonResponse
    {
        $articleCategory = $this->articleCategoryService->create($request->validated());

        return $this->response->withArray(['article_category' => $articleCategory->toArray()]);
    }
}
