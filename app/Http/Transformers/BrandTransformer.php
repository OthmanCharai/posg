<?php

namespace App\Http\Transformers;

use App\src\Domain\Media\MediaService;
use App\src\Models\Brands\Brand;
use Illuminate\Contracts\Container\BindingResolutionException;

class BrandTransformer
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     * @throws BindingResolutionException
     */
    public static function transform(Brand $brand): array
    {
        $mediaService = make(MediaService::class);

        return [
            Brand::NAME_COLUMN         => $brand->getName(),
            Brand::LOGO_COLUMN         => $mediaService->url($brand->getLogo()),
            Brand::ID_COLUMN           => $brand->getId(),
            Brand::ABBREVIATION_COLUMN => $brand->getAbbriviation(),
        ];
    }
}
