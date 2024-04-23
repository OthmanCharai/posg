<?php

namespace App\Http\Controllers\CompanySetting;

use App\Http\Controllers\Controller;
use App\Http\Transformers\CompanySettingTransformer;
use App\src\Models\CompanySetting\CompanySetting;
use App\src\Services\CompanySetting\CompanySettingService;

class ShowCompanySettingController extends Controller
{
    public function __construct(private readonly CompanySettingService $companySettingService)
    {
        parent::__construct();
    }

    public function __invoke(): \Illuminate\Http\JsonResponse
    {
        $companySetting = $this->companySettingService->getFirst();
        if ($companySetting instanceof CompanySetting) {
            return $this->response->withArray(
                [
                    'company_setting' => CompanySettingTransformer::transform($companySetting),
                ]
            );
        }

        return $this->response->withArray(
            [
                'company_setting' => null,
            ]
        );
    }
}
