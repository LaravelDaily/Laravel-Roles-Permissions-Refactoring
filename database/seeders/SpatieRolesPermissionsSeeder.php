<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SpatieRolesPermissionsSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['id' => 1, 'name' => 'Admin', 'guard_name' => 'web'],
            ['id' => 2, 'name' => 'Publisher', 'guard_name' => 'web'],
            ['id' => 3, 'name' => 'User', 'guard_name' => 'web'],
            ['id' => 4, 'name' => 'Viewer', 'guard_name' => 'web']
        ];

        Role::insert($roles);

        $permissions = [
            ['id' => 1, 'name' => 'post_create', 'guard_name' => 'web'],
            ['id' => 2, 'name' => 'post_edit', 'guard_name' => 'web'],
            ['id' => 3, 'name' => 'post_delete', 'guard_name' => 'web'],
            ['id' => 4, 'name' => 'post_publish', 'guard_name' => 'web'],
            ['id' => 5, 'name' => 'post_view', 'guard_name' => 'web'],
        ];

        Permission::insert($permissions);

        Role::findOrFail(1)->syncPermissions([1, 2, 3, 4, 5]);

        Role::findOrFail(2)->syncPermissions([1, 2, 4, 5]);

        Role::findOrFail(4)->syncPermissions([5]);
    }
}
