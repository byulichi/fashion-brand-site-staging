<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cart')->insert([
            ['user_id' => 1, 'item_id' => 1],
            ['user_id' => 1, 'item_id' => 2],
            ['user_id' => 2, 'item_id' => 3],
            ['user_id' => 2, 'item_id' => 4],
        ]);
    }
}
