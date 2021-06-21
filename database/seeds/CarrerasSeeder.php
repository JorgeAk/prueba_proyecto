<?php

use Illuminate\Database\Seeder;

class CarrerasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('carreras')->insert([
            'nombre' => 'Informática',
            'estatus' => '1',
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Sistemas',
            'estatus' => '1',
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'TICS',
            'estatus' => '1',
        ]);
    }
}
