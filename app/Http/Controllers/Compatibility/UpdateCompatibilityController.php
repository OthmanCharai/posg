<?php

namespace App\Http\Controllers\Compatibility;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCompatibilityRequest;
use App\Http\Transformers\CompatibilityTransformer;
use App\src\Models\Compatibility\Compatibility;
use App\src\Services\Compatibility\CompatibilityServiceInterface;

class UpdateCompatibilityController extends Controller
{
    public function __construct(private readonly CompatibilityServiceInterface $compatibilityService)
    {
        parent::__construct();
    }

    public function __invoke(
        Compatibility $compatibility,
        UpdateCompatibilityRequest $request
    ): \Illuminate\Http\JsonResponse {
        $this->compatibilityService->update($compatibility, $request->validated());

        return $this->response->withArray(
            CompatibilityTransformer::transform($this->compatibilityService->find($compatibility->getId()))
        );
    }
}
