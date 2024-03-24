<?php

namespace App\Http\Controllers\CompanySetting;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanySettingResource;
use App\src\Models\CompanySetting\CompanySetting;
use App\src\Transformers\CompanySettingTransformer;

class ShowCompanySettingController extends Controller
{
    public function __invoke(CompanySetting $companySetting): \Illuminate\Http\JsonResponse
    {
        return $this->response->withItem($companySetting, new companySettingResource($companySetting));
    }
}
