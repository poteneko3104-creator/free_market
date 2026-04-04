<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LikesTableSeeder extends Seeder
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
            'user_id' => '1',
            'item_id' => '1',
            'status' => '1',
        ];
        DB::table('likes')->insert($param);
        $param = [
            'user_id' => '1',
            'item_id' => '2',
            'status' => '1',
        ];
        DB::table('likes')->insert($param);
            $param = [
            'user_id' => '1',
            'item_id' => '3',
            'status' => '0',
        ];
        DB::table('likes')->insert($param);
        $param = [
            'user_id' => '2',
            'item_id' => '1',
            'status' => '1',
        ];
        DB::table('likes')->insert($param);
    }
}
