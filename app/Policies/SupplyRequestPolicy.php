<?php

namespace App\Policies;

use App\Models\SupplyRequest;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SupplyRequestPolicy
{
    use HandlesAuthorization;

    public function approve(User $user, SupplyRequest $supplyRequest)
    {
        return $user->isAdmin();
    }
}
