<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'id' => 1,
            '_lft' => 1,
            '_rgt' => 10,
            'parent_id' => NULL,
            'name' => 'Первая главная категория',
            'slug' => 'pervaya-glavnaya-kategoriya',
            'active' => 1,
            'sort' => 500
        ]);
        DB::table('categories')->insert([
            'id' => 2,
            '_lft' => 2,
            '_rgt' => 3,
            'parent_id' => 1,
            'name' => 'Вторая вложенная категория-2',
            'slug' => 'vtoraya-vlozhennaya-kategoriya-2',
            'active' => 1,
            'sort' => 500
        ]);
        DB::table('categories')->insert([
            'id' => 3,
            '_lft' => 4,
            '_rgt' => 9,
            'parent_id' => 1,
            'name' => 'Другая вложенная категория',
            'slug' => 'drugaya-vlozhennaya-kategoriya',
            'active' => 1,
            'sort' => 500
        ]);
        DB::table('categories')->insert([
            'id' => 4,
            '_lft' => 5,
            '_rgt' => 6,
            'parent_id' => 3,
            'name' => 'Вложенная категория 3-го уровня',
            'slug' => 'vlozhennaya-kategoriya-3-go-urovnya',
            'active' => 1,
            'sort' => 500
        ]);
        DB::table('categories')->insert([
            'id' => 5,
            '_lft' => 7,
            '_rgt' => 8,
            'parent_id' => 3,
            'name' => 'Другая вложенная 3-го уровня',
            'slug' => 'drugaya-vlozhennaya-3-go-urovnya',
            'active' => 1,
            'sort' => 500
        ]);
    }
}
