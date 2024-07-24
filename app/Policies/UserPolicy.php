<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        // allow super admin or sales team
        return $user->role_id === 1 || $user->role_id === 3;
    }

    // rest operations allow only super admin 
    
    public function create(User $user): bool
    {
        return $user->role_id == 1;
    }

    public function update(User $user): bool
    {
        return $user->role_id == 1;
    }

    public function delete(User $user): bool
    {
        return $user->role_id == 1;
    }
}
