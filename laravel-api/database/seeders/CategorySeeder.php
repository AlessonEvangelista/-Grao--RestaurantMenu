<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $indices = ['id', 'name', 'restaurants_id', 'dad_category'];
        $data = [
            [1, 'Executivo', rand(1, 10), null],
            [2, 'Combo', rand(1, 10), null],
            [3, 'Caldos e Sopas', rand(1, 10), null],
            [4, 'Promoções', rand(1, 10), null],
            [5, 'Saladas', rand(1, 10), null],
            [6, 'Massas', rand(1, 10), null],
            [7, 'Carnes', rand(1, 10), null],
            [8, 'Porções', rand(1, 10), null],
            [9, 'Sobremesas', rand(1, 10), null],
            [10, 'Bebidas', rand(1, 10), null],
            [11, 'Sucos', rand(1, 10), 10],
        ];

        $categories = [];
        $st = [];
        foreach ($data as $values) {
            foreach ($values as $key => $cat) {
                $st += [$indices[$key] => $cat];
            }
            array_push($categories, $st);
            $st = [];
        }
        DB::table('categories')->insert($categories);
    }
}
