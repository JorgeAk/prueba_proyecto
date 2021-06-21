<?php

use Illuminate\Database\Seeder;

class TipoSinodalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_revisor')->insert([
            'nombre' => 'PRESIDENTE'
        ]);
        DB::table('tipo_revisor')->insert([
            'nombre' => 'SECRETARIO'
        ]);
        DB::table('tipo_revisor')->insert([
            'nombre' => 'VOCAL REVISOR'
        ]);
        DB::table('tipo_revisor')->insert([
            'nombre' => 'VOCAL SUPLENTE'
        ]);
    }
}
