<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoryContentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $param = [
            'content' => '日用品',
        ];
        DB::table('category_items')->insert($param);
        $param = [
            'content' => '化粧品',
        ];
        DB::table('category_items')->insert($param);
            $param = [
            'content' => '洋服',
        ];
        DB::table('category_items')->insert($param);
        $param = [
            'content' => 'メンズ',
        ];
        DB::table('category_items')->insert($param);
    }
}
