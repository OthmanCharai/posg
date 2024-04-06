<?php

namespace App\Http\Controllers\CompanySetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanySettingRequest;
use App\Http\Transformers\CompanySettingTransformer;
use App\src\Models\CompanySetting\CompanySetting;
use App\src\Services\CompanySetting\CompanySettingServiceInterface;

class StoreCompanySettingController extends Controller
{
    public function __construct(private readonly CompanySettingServiceInterface $companySettingService)
    {
        parent::__construct();
    }

    public function __invoke(StoreCompanySettingRequest $request): \Illuminate\Http\JsonResponse
    {
        /* @var CompanySetting $companySetting */
        $companySetting = $this->companySettingService->create($request->validated());

        return $this->response->withArray(CompanySettingTransformer::transform($companySetting));
    }
}
