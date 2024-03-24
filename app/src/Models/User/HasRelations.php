<?php

namespace App\src\Models\User;

use App\src\Models\AdminRole\AdminRole;

trait HasRelations
{
    public function role(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(AdminRole::class);
    }

    public function getRole(): ?AdminRole
    {
        /* @var AdminRole */
        return $this->role()->first();
    }
}