<?php

namespace App\Http\Controllers\Compatibility;

use App\Http\Controllers\Controller;
use App\Http\Transformers\CompatibilityTransformer;
use App\src\Services\Compatibility\CompatibilityServiceInterface;

class GetCompatibilitiesController extends Controller
{
    public function __construct(private readonly CompatibilityServiceInterface $compatibilityService)
    {
        parent::__construct();
    }

    public function __invoke(): \Illuminate\Http\JsonResponse
    {
        $compatibilities = $this->compatibilityService->get();

        return $this->response->withArray(
            transform_collection($compatibilities, CompatibilityTransformer::class)->toArray()
        );
    }
}
