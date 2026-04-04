<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComentsTableSeeder extends Seeder
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
            'content' => 'コメント１',
        ];
        DB::table('coments')->insert($param);
        $param = [
            'user_id' => '2',
            'item_id' => '1',
            'content' => 'コメント２',
        ];
        DB::table('coments')->insert($param);
            $param = [
            'user_id' => '3',
            'item_id' => '1',
            'content' => 'コメント３',
        ];
        DB::table('coments')->insert($param);
        $param = [
            'user_id' => '1',
            'item_id' => '2',
            'content' => 'コメント１',
        ];
        DB::table('coments')->insert($param);
    }
}
