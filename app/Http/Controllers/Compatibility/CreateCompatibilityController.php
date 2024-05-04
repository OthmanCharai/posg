<?php

namespace App\Http\Controllers\Compatibility;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompatibilityRequest;
use App\Http\Transformers\CompatibilityTransformer;
use App\src\Models\Compatibility\Compatibility;
use App\src\Services\Compatibility\CompatibilityServiceInterface;

class CreateCompatibilityController extends Controller
{
    public function __construct(private readonly CompatibilityServiceInterface $compatibilityService)
    {
        parent::__construct();
    }

    public function __invoke(StoreCompatibilityRequest $request): \Illuminate\Http\JsonResponse
    {
        /* @var Compatibility $compatibility */
        $compatibility = $this->compatibilityService->create($request->validated());

        return $this->response->withArray(
            [
                'compatibility' => CompatibilityTransformer::transform($compatibility),
            ]
        );
    }
}
