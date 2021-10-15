<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory()->admin()->create([
            'name' => 'admin user',
            'email' => 'admin@admin.com'
        ]);

        User::factory()->publisher()->create([
            'name' => 'publisher',
            'email' => 'publish@test.com'
        ]);

        User::factory()->viewer()->create([
            'name' => 'viewer',
            'email' => 'viewer@test.com'
        ]);

        User::factory()->create([
            'name' => 'test user',
            'email' => 'test@test.com'
        ]);
    }
}
