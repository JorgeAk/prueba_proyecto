<?php

use Illuminate\Database\Seeder;

class TipoRevisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_revisor')->insert([
            'nombre' => 'PRIMER REVISOR'
        ]);
        DB::table('tipo_revisor')->insert([
            'nombre' => 'SEGUNDO REVISOR'
        ]);
        DB::table('tipo_revisor')->insert([
            'nombre' => 'TERCER REVISOR'
        ]);
    }
}
