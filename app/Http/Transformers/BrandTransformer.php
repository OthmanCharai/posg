<?php

namespace App\Http\Transformers;

use App\src\Domain\Media\MediaService;
use App\src\Models\Brands\Brand;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandTransformer extends JsonResource
{
    public static function staticToArray(Brand $brand): array
    {
        $mediaService = app(MediaService::class);

        return [
            Brand::NAME_COLUMN         => $brand->getName(),
            Brand::ABBREVIATION_COLUMN => $brand->getAbbriviation(),
            Brand::LOGO_COLUMN         => $mediaService->url($brand->getLogo()),
        ];
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return self::staticToArray($this->resource);
    }
}
