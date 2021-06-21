<?php

use Illuminate\Database\Seeder;

class optitulacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('optitulacion')->insert([
            'nombre' => 'TESIS',
            
        ]);
        DB::table('optitulacion')->insert([
            'nombre' => 'PROYECTO DE INVESTIGACION',
            
        ]);
        DB::table('optitulacion')->insert([
            'nombre' => 'INFORME TÉCNICO DE  RESIDENCIA',
            
        ]);
        DB::table('optitulacion')->insert([
            'nombre' => 'CENEVAL',
            
        ]);
       

    }
}
