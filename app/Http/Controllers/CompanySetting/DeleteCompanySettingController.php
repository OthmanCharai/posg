<?php

namespace App\Http\Controllers\CompanySetting;

use App\Http\Controllers\Controller;
use App\src\Models\CompanySetting\CompanySetting;
use App\src\Services\CompanySetting\CompanySettingServiceInterface;

class DeleteCompanySettingController extends Controller
{
    public function __construct(private readonly CompanySettingServiceInterface $companySettingService)
    {
        parent::__construct();
    }

    public function __invoke(CompanySetting $companySetting): \Illuminate\Http\JsonResponse
    {
        $this->companySettingService->delete($companySetting);

        return $this->response->withSuccess('company setting deleted with success');
    }
}