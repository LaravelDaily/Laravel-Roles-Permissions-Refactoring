<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function publish(User $user): bool
    {
        return $user->role_id == User::ROLE_ADMIN || $user->role_id == User::ROLE_PUBLISHER;
    }

    public function delete(User $user, Post $post): bool
    {
        return $user->role_id == User::ROLE_ADMIN;
    }
}