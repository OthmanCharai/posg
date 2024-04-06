<?php

namespace App\Http\Controllers\CompanySetting;

use App\Http\Controllers\Controller;
use App\Http\Transformers\CompanySettingTransformer;
use App\src\Models\CompanySetting\CompanySetting;

class ShowCompanySettingController extends Controller
{
    public function __invoke(CompanySetting $companySetting): \Illuminate\Http\JsonResponse
    {
        return $this->response->withArray(
            ['company_setting' => CompanySettingTransformer::transform($companySetting)]
        );
    }
}
