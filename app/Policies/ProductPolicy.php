<?php

namespace App\Policies;

use App\Models\User;

class ProductPolicy
{
    public function all(User $user): bool
    {
        // only user with sales team role
        return $user->role_id === 3;
    }
}
