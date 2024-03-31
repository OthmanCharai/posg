<?php

namespace App\Http\Controllers\ArticleCategory;

use App\Http\Controllers\Controller;
use App\src\Models\ArticleCategory\ArticleCategory;

class ShowArticleCategoryController extends Controller
{
    public function __invoke(ArticleCategory $articleCategory): \Illuminate\Http\JsonResponse
    {
        return $this->response->withArray($articleCategory->toArray());
    }
}
