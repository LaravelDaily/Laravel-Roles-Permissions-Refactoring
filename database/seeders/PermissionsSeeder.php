<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        Permission::insert([
            ['id' => 1, 'name' => 'post_create'],
            ['id' => 2, 'name' => 'post_edit'],
            ['id' => 3, 'name' => 'post_delete'],
            ['id' => 4, 'name' => 'post_publish'],
            ['id' => 5, 'name' => 'post_view'],
        ]);

        Role::findOrFail(User::ROLE_ADMIN)->permissions()->sync([1, 2, 3, 4, 5]);

        Role::findOrFail(User::ROLE_PUBLISHER)->permissions()->sync([1, 2, 4, 5]);
    }
}
