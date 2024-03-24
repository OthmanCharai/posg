<?php

namespace App\Http\Controllers\CompanySetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanySettingRequest;
use App\Http\Resources\CompanySettingResource;
use App\src\Services\CompanySetting\CompanySettingServiceInterface;
use App\src\Transformers\CompanySettingTransformer;

class StoreCompanySettingController extends Controller
{
    public function __construct(private readonly CompanySettingServiceInterface $companySettingService)
    {
        parent::__construct();
    }

    public function __invoke(StoreCompanySettingRequest $request): \Illuminate\Http\JsonResponse
    {
        $companySetting = $this->companySettingService->create($request->validated());

        return $this->response->withItem($companySetting, new companySettingResource($companySetting));
    }
}
