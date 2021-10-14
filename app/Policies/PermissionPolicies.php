<?php

namespace App\Policies;

use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Builder;

class PermissionPolicies
{
    public static function define()
    {
        if (\Schema::hasTable('permissions')) {
            foreach (Permission::all() as $permission) {
                Gate::define($permission->name, function ($user) use ($permission) {
                    return (bool)$permission->where('name', $permission->name)->whereHas('roles', function (Builder $query) use ($user) {
                        return $query->where('id', $user->role_id);
                    })->exists();
                });
            }
        }
    }
}