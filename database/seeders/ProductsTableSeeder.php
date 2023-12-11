<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Products::create([
            'name' => 'Andriod Phone',
            'price'=> 22000,
            'description' => 'this is andriod phone'
        ]);

        \App\Models\Products::create([
            'name' => 'Iphone',
            'price' => 100000,
            'description' => 'this is Iphone phone'

        ]);
        \App\Models\Products::create([
            'name' => 'OnePlus',
            'price' => 50000,
            'description' => 'this is Iphone phone'

        ]);
    }
}
