<?php

namespace App\src\Models\User;

use App\src\Models\AdminRole\AdminRole;
use App\src\Models\Depot\Depot;

trait HasRelations
{
    public final const RELATIONS = [
        AdminRole::class => 'role',
        Depot::class     => 'depot',
    ];

    public function role(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(AdminRole::class);
    }

    public function getRole(): ?AdminRole
    {
        /* @var AdminRole|null */
        return $this->getAttribute(self::RELATIONS[AdminRole::class]);
    }

    public function depot(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Depot::class);
    }

    public function getDepot(): ?Depot
    {
        return $this->getAttribute(self::RELATIONS[Depot::class]);
    }
}
