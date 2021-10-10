<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'test user',
            'email' => 'test@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'admin user',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        User::factory(10)->create();
    }
}
