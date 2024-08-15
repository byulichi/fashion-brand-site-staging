<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('items')->insert([
            ['type_id' => 1, 'name' => 'The Dreamscape Shawl', 'price' => 159.00],
            ['type_id' => 1, 'name' => 'The Midnight Shawl', 'price' => 179.00],
            ['type_id' => 2, 'name' => 'The Elegant Scarf', 'price' => 99.00],
            ['type_id' => 3, 'name' => 'Stylish Bracelet', 'price' => 49.00],
        ]);
    }
}
