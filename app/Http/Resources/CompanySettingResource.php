<?php

namespace App\Http\Resources;

use App\src\Domain\Media\MediaService;
use App\src\Models\CompanySetting\CompanySetting;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanySettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $mediaService = app(MediaService::class);

        /* @var CompanySetting $companySetting */
        $companySetting = $this;

        return [
            CompanySetting::ID_COLUMN              => $companySetting->getId(),
            CompanySetting::NAME_COLUMN            => $companySetting->getName(),
            CompanySetting::PHONE_COLUMN           => $companySetting->getPhone(),
            CompanySetting::EMAIL_COLUMN           => $companySetting->getEmail(),
            CompanySetting::WEBSITE_COLUMN         => $companySetting->getWebsite(),
            CompanySetting::ADDRESS_COLUMN         => $companySetting->getAddress(),
            CompanySetting::CAPITAL_COLUMN         => $companySetting->getCapital(),
            CompanySetting::NUM_RC_COLUMN          => $companySetting->getNumRc(),
            CompanySetting::NUM_NIF_COLUMN         => $companySetting->getNumNif(),
            CompanySetting::NUM_STATISTIQUE_COLUMN => $companySetting->getNumStatistique(),
            CompanySetting::NUM_BGFI_COLUMN        => $companySetting->getNumBgfi(),
            CompanySetting::NUM_UGB_COLUMN         => $companySetting->getNumUgb(),
            CompanySetting::RETURN_POLICY_COLUMN   => $companySetting->getReturnPolicy(),
            CompanySetting::PATH_COLUMN            => $mediaService->url($companySetting->getPath()),
        ];
    }
}
