<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Role;
use App\Models\Permission;
use App\Policies\PostPolicy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
//        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('publish', [PostPolicy::class, 'publish']);

        if (\Schema::hasTable('permissions')) {
            foreach (Permission::all() as $permission) {
                Gate::define($permission->name, function ($user) use ($permission) {
                    return (bool) $permission->where('name', $permission->name)->whereHas('roles', function (Builder $query) use ($user) {
                        return $query->where('id', $user->role_id);
                    })->exists();
                });
            }
        }
    }
}
