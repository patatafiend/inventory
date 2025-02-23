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
        $productname = "product";
        $productdes = "this is product number";
        for($i = 0; $i <= 10; $i++){
            DB::table('products')->insert([
                'name' => $productname. " ". $i,
                'description' => $productdes . " " . $i,
                'quantity' => 1+$i,
                'price' => 1000+$i,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        
    }
}
