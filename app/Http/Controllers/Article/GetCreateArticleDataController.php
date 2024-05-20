<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Http\Transformers\ArticleCategoryTransformer;
use App\Http\Transformers\BrandTransformer;
use App\Http\Transformers\CompatibilityTransformer;
use App\Http\Transformers\DepotTransformer;
use App\Http\Transformers\SupplierTransformer;
use App\src\Services\ArticleCategory\ArticleCategoryServiceInterface;
use App\src\Services\Brand\BrandServiceInterface;
use App\src\Services\Compatibility\CompatibilityServiceInterface;
use App\src\Services\Depot\DepotServiceInterface;
use App\src\Services\Supplier\SupplierServiceInterface;

class GetCreateArticleDataController extends Controller
{
    public function __construct(
        private readonly SupplierServiceInterface $supplierService,
        private readonly ArticleCategoryServiceInterface $articleCategoryService,
        private readonly CompatibilityServiceInterface $compatibilityService,
        private readonly BrandServiceInterface $brandService,
        private readonly DepotServiceInterface $depotService
    ) {
        parent::__construct();
    }

    public function __invoke(): \Illuminate\Http\JsonResponse
    {
        $suppliers = $this->supplierService->get();
        $articleCategories = $this->articleCategoryService->get();
        $compatibilities = $this->compatibilityService->get();
        $brands = $this->brandService->get();
        $depots = $this->depotService->get();

        return $this->response->withArray(
            [
                'suppliers'          => transform_collection($suppliers, SupplierTransformer::class),
                'article_categories' => transform_collection($articleCategories, ArticleCategoryTransformer::class),
                'compatibilities'    => transform_collection($compatibilities, CompatibilityTransformer::class),
                'brands'             => transform_collection($brands, BrandTransformer::class),
                'depots'             => transform_collection($depots, DepotTransformer::class),
            ]
        );
    }
}
