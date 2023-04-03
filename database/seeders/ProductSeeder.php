<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('Products')->insert([
            'name' => "Iphone 13",
            'description' => "Telefono 13",
            'price' => 1200
        ]);
        DB::table('Products')->insert([
            'name' => "Iphone 12",
            'description' => "Telefono 12",
            'price' => 1100
        ]);
        DB::table('Products')->insert([
            'name' => "Iphone 11",
            'description' => "Telefono 11",
            'price' => 1000
        ]);
    }
}
