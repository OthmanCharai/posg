<?php

namespace App\src\Services\Compatibility;

use App\src\Services\BaseInterface;
use Illuminate\Database\Eloquent\Collection;

interface CompatibilityServiceInterface extends BaseInterface
{
    public function get(): Collection;
}