<?php

namespace Database\Seeders;

use Faker\Provider\Uuid;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => Uuid::uuid(),
            'name' => 'Administrator',
            'email' => 'administrator@administrator.com',
            'login' => 'admin',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'admin' => true,
            'email_verified_at' => now(),
        ]);

        DB::table('users')->insert([
            'id' => Uuid::uuid(),
            'name' => 'User',
            'email' => 'user@user.com',
            'login' => 'user',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'admin' => false,
            'email_verified_at' => now(),
        ]);
    }
}
