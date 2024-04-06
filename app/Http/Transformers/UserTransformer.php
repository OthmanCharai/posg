<?php

namespace App\Http\Transformers;

use App\src\Domain\Media\MediaService;
use App\src\Models\AdminRole\AdminRole;
use App\src\Models\Depot\Depot;
use App\src\Models\User\User;

class UserTransformer
{
    public static function transform(User $user): array
    {
        $mediaService = app(MediaService::class);

        $data = [
            User::ID_COLUMN           => $user->getId(),
            User::FIRST_NAME_COLUMN   => $user->getFirstName(),
            User::LAST_NAME_COLUMN    => $user->getLastName(),
            User::EMAIL_COLUMN        => $user->getEmail(),
            User::PHONE_NUMBER_COLUMN => $user->getPhone(),
            User::ADDRESS_COLUMN      => $user->getAddress(),
            User::LOGO_COLUMN         => ($user->getLogo()) ? $mediaService->url($user->getLogo()) : $user->getLogo(),
        ];

        if ($user->relationLoaded(User::RELATIONS[AdminRole::class])) {
            $data['role'] = RoleTransformer::transform($user->getRole());
        }

        if ($user->relationLoaded(User::RELATIONS[Depot::class])) {
            $data['depot'] = DepotTransformer::transform($user->getDepot());
        }

        return $data;
    }
}
