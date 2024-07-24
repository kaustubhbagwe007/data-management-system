<?php

namespace App\Policies;

use App\Models\User;

class RolePolicy
{
    public function all(User $user): bool
    {
        // only user with super admin role
        return $user->role_id === 1;
    }
}
