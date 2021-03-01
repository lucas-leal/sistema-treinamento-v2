<?php

namespace Database\Seeders;

use Faker\Provider\Uuid;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = DB::table('categories')->first('id');

        DB::table('courses')->insert([
            'id' => Uuid::uuid(),
            'title' => 'Design Patterns',
            'description' => 'Em Engenharia de Software, um padrão de desenho ou padrão de projeto é uma solução geral para um problema que ocorre com frequência dentro de um determinado contexto no projeto de software.',
            'instructor' => 'Uncle Bob',
            'keywords' => 'Software, Design, Patterns, Programming',
            'category_id' => $category->id
        ]);
    }
}
