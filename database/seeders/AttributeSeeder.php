<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attribute')->insert([
            'name' => 'Производитель',
            'sort' => '5'
        ]);
        DB::table('attribute')->insert([
            'name' => 'Гарантия производителя',
            'sort' => '10'
        ]);
        DB::table('attribute')->insert([
            'name' => 'Артикул товара',
            'sort' => '20'
        ]);
        DB::table('attribute')->insert([
            'name' => 'Длина',
            'sort' => '25'
        ]);
        DB::table('attribute')->insert([
            'name' => 'Глубина',
            'sort' => '35'
        ]);
        DB::table('attribute')->insert([
            'name' => 'Высота',
            'sort' => '40'
        ]);
        DB::table('attribute')->insert([
            'name' => 'Ширина',
            'sort' => '45'
        ]);
        DB::table('attribute')->insert([
            'name' => 'Диаметр',
            'sort' => '50'
        ]);
        DB::table('attribute')->insert([
            'name' => 'Толщина',
            'sort' => '55'
        ]);
        DB::table('attribute')->insert([
            'name' => 'Размер под посадку',
            'sort' => '60'
        ]);
        DB::table('attribute')->insert([
            'name' => 'Внешний размер',
            'sort' => '65'
        ]);
        DB::table('attribute')->insert([
            'name' => 'Мощность',
            'sort' => '70'
        ]);
        DB::table('attribute')->insert([
            'name' => 'Отапливаемя площадь',
            'sort' => '75'
        ]);
        DB::table('attribute')->insert([
            'name' => 'Чистое горение',
            'sort' => '80'
        ]);
        DB::table('attribute')->insert([
            'name' => 'Вторичный дожиг газов',
            'sort' => '85'
        ]);
        DB::table('attribute')->insert([
            'name' => 'Длительное горение',
            'sort' => '90'
        ]);
        DB::table('attribute')->insert([
            'name' => 'Подвод воздуха',
            'sort' => '95'
        ]);
        DB::table('attribute')->insert([
            'name' => 'Топится',
            'sort' => '95'
        ]);
        DB::table('attribute')->insert([
            'name' => 'Объем парного помещения',
            'sort' => '100'
        ]);
        DB::table('attribute')->insert([
            'name' => 'Масса камней',
            'sort' => '105'
        ]);
        DB::table('attribute')->insert([
            'name' => 'Диаметр дымохода',
            'sort' => '110'
        ]);
        DB::table('attribute')->insert([
            'name' => 'Подключение дымохода',
            'sort' => '115'
        ]);
        DB::table('attribute')->insert([
            'name' => 'Цвет',
            'sort' => '120'
        ]);
        DB::table('attribute')->insert([
            'name' => 'Масса',
            'sort' => '125'
        ]);
    }
}
