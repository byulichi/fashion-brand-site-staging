<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('types')->insert([
        ['name' => 'Scarves'],
        ['name' => 'Ready to Wear'],
        ['name' => 'Bags'],
        ['name' => 'Shoes'],
        ['name' => 'Accessories'],
        ]);
    }
}
