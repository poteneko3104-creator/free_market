<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $param = [
            'item_id' => '1',
            'category_id' => '1'
        ];
        DB::table('categories')->insert($param);
            $param = [
            'item_id' => '1',
            'category_id' => '2'
        ];
        DB::table('categories')->insert($param);
        $param = [
            'item_id' => '2',
            'category_id' => '1'
        ];
        DB::table('categories')->insert($param);
        //
    }
}
