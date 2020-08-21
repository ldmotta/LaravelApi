<?php

use App\Models\Pastel;
use Illuminate\Database\Seeder;

class PasteisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pastel::firstOrCreate(['name' => 'Pastel de Frango'             , 'price' => '2.5', 'image' => 'pastel-de-frango.jpeg']);
        Pastel::firstOrCreate(['name' => 'Pastel de Carne'              , 'price' => '3.7', 'image' => 'pastel-de-carne.jpeg']);
        Pastel::firstOrCreate(['name' => 'Pastel de Legumes'            , 'price' => '3.0', 'image' => 'pastel-de-legumes.jpeg']);
        Pastel::firstOrCreate(['name' => 'Pastel de Frango Com Queijo'  , 'price' => '4.0', 'image' => 'pastel-de-frango-com-queijo.jpeg']);
        Pastel::firstOrCreate(['name' => 'Pastel de Carne Com Queijo'   , 'price' => '4.5', 'image' => 'pastel-de-carne-com-queijo.jpeg']);
    }
}
