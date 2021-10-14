<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class ViewerRoleSeeder extends Seeder
{
    public function run()
    {
        Role::insert([
            ['id' => 4, 'name' => 'viewer'],
        ]);

        Role::findOrFail(User::ROLE_VIEWER)->permissions()->sync([5]);
    }
}
