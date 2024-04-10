<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Http\Transformers\ArticleTransformer;
use App\src\Services\Article\ArticleServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use YouCanShop\QueryOption\QueryOptionFactory;

class ListArticleController extends Controller
{
    public function __construct(private readonly ArticleServiceInterface $articleService)
    {
        parent::__construct();
    }

    public function __invoke(Request $request): JsonResponse
    {
        $articles = $this->articleService->getPaginated(QueryOptionFactory::createFromIlluminateRequest($request));

        return $this->response->withArray(
            [
                'articles' => transform_paginator($articles, ArticleTransformer::class),
            ]
        );
    }
}
