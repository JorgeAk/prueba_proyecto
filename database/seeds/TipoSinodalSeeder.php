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
        DB::table('tipo_sinodal')->insert([
            'nombre' => 'PRESIDENTE'
        ]);
        DB::table('tipo_sinodal')->insert([
            'nombre' => 'SECRETARIO'
        ]);
        DB::table('tipo_sinodal')->insert([
            'nombre' => 'VOCAL REVISOR'
        ]);
        DB::table('tipo_sinodal')->insert([
            'nombre' => 'VOCAL SUPLENTE'
        ]);
    }
}
