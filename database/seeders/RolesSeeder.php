<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    public function run()
    {
        Role::insert([
            ['id' => 1, 'name' => 'user'],
            ['id' => 2, 'name' => 'publisher'],
            ['id' => 3, 'name' => 'admin'],
        ]);
    }
}
