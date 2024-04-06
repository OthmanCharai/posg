<?php

namespace App\Http\Controllers\CompanySetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCompanySettingRequest;
use App\Http\Transformers\CompanySettingTransformer;
use App\src\Models\CompanySetting\CompanySetting;
use App\src\Services\CompanySetting\CompanySettingServiceInterface;

class UpdateCompanySettingController extends Controller
{
    public function __construct(private readonly CompanySettingServiceInterface $companySettingService)
    {
        parent::__construct();
    }

    public function __invoke(
        CompanySetting $companySetting,
        UpdateCompanySettingRequest $request
    ): \Illuminate\Http\JsonResponse {
        $this->companySettingService->update($companySetting, $request->validated());

        return $this->response->withArray(CompanySettingTransformer::transform($companySetting));
    }
}
