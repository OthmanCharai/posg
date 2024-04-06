<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Transformers\UserTransformer;
use App\src\Models\User\User;

class ShowAdminController extends Controller
{
    public function __invoke(User $user): \Illuminate\Http\JsonResponse
    {
        return $this->response->withArray(
            [
                'user' => UserTransformer::transform($user),
            ]
        );
    }
}
