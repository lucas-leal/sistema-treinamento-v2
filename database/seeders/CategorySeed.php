<?php

namespace Database\Seeders;

use Faker\Provider\Uuid;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'id' => Uuid::uuid(),
            'name' => 'Technology'
        ]);

        DB::table('categories')->insert([
            'id' => Uuid::uuid(),
            'name' => 'Financial'
        ]);

        DB::table('categories')->insert([
            'id' => Uuid::uuid(),
            'name' => 'Engineer'
        ]);
    }
}
