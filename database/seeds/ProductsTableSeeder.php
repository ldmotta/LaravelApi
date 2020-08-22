<?php

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::firstOrCreate([
            'name' => 'Product de Frango', 
            'price' => '2.5', 
            'image' => 'pastel-de-frango.jpeg'
        ]);
        Product::firstOrCreate(['name' => 'Product de Carne', 
            'price' => '3.7', 
            'image' => 'pastel-de-carne.jpeg'
        ]);
        Product::firstOrCreate([
            'name' => 'Product de Legumes', 
            'price' => '3.0', 
            'image' => 'pastel-de-legumes.jpeg'
        ]);
        Product::firstOrCreate([
            'name' => 'Product de Frango Com Queijo', 
            'price' => '4.0', 
            'image' => 'pastel-de-frango-com-queijo.jpeg'
        ]);
        Product::firstOrCreate([
            'name' => 'Product de Carne Com Queijo', 
            'price' => '4.5', 
            'image' => 'pastel-de-carne-com-queijo.jpeg'
        ]);
    }
}
