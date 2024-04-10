<?php

namespace App\Http\Controllers\Compatibility;

use App\Http\Controllers\Controller;
use App\Http\Transformers\CompatibilityTransformer;
use App\src\Models\Compatibility\Compatibility;

class ShowCompatibilityController extends Controller
{
    public function __invoke(Compatibility $compatibility): \Illuminate\Http\JsonResponse
    {
        return $this->response->withArray(CompatibilityTransformer::transform($compatibility));
    }
}
