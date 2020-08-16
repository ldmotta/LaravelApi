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
        // factory(Pastel::class, 10)->create();
        
        Pastel::firstOrCreate(['nome' => 'Pastel de Frango'             , 'preco' => '2.5', 'foto' => 'pastel-de-frango.jpeg']);
        Pastel::firstOrCreate(['nome' => 'Pastel de Carne'              , 'preco' => '3.7', 'foto' => 'pastel-de-carne.jpeg']);
        Pastel::firstOrCreate(['nome' => 'Pastel de Legumes'            , 'preco' => '3.0', 'foto' => 'pastel-de-legumes.jpeg']);
        Pastel::firstOrCreate(['nome' => 'Pastel de Frango Com Queijo'  , 'preco' => '4.0', 'foto' => 'pastel-de-frango-com-queijo.jpeg']);
        Pastel::firstOrCreate(['nome' => 'Pastel de Carne Com Queijo'   , 'preco' => '4.5', 'foto' => 'pastel-de-carne-com-queijo.jpeg']);
        
    }
}
