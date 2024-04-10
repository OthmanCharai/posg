<?php

namespace App\Http\Controllers\Compatibility;

use App\Http\Controllers\Controller;
use App\src\Models\Compatibility\Compatibility;
use App\src\Services\Compatibility\CompatibilityServiceInterface;

class DeleteCompatibilityController extends Controller
{
    public function __construct(private readonly CompatibilityServiceInterface $compatibilityService)
    {
        parent::__construct();
    }

    public function __invoke(Compatibility $compatibility): \Illuminate\Http\JsonResponse
    {
        $this->compatibilityService->delete($compatibility);

        return $this->response->withSuccess('compatibility was deleted with success');
    }
}