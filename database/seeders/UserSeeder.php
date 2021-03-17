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
            'password' => '$2y$10$V7Yxnnqh02LD8Ot2rpWxL.IF8VoaGddseX0cNhh8bMjRkt4DtTzuG', // abnt12
            'admin' => true,
            'email_verified_at' => now(),
        ]);

        DB::table('users')->insert([
            'id' => Uuid::uuid(),
            'name' => 'Lucas Leal',
            'email' => 'lucasleal@leal.com',
            'login' => 'lucasleal',
            'password' => '$2y$10$V7Yxnnqh02LD8Ot2rpWxL.IF8VoaGddseX0cNhh8bMjRkt4DtTzuG', // abnt12
            'admin' => false,
            'email_verified_at' => now(),
        ]);
    }
}
