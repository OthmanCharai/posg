<?php

namespace App\src\Models\User;

use App\src\Models\AdminRole\AdminRole;

trait HasRelations
{
    public function role(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(AdminRole::class);
    }

    public function getRole(): ?AdminRole
    {
        /* @var AdminRole */
        return $this->role()->first();
    }
}