<?php

use Illuminate\Database\Seeder;

class EstatusRevisorSinodalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estatus_revisor_sinodal')->insert([
            'nombre' => 'PROPUESTO POR EL ALUMNO'
        ]);
        DB::table('estatus_revisor_sinodal')->insert([
            'nombre' => 'PENDIENTE POR ACEPTAR/RECHAZAR'
        ]);
        DB::table('estatus_revisor_sinodal')->insert([
            'nombre' => 'SI ACEPTA SER SINODAL'
        ]);
        DB::table('estatus_revisor_sinodal')->insert([
            'nombre' => 'NO ACEPTA SER SINODAL'
        ]);
        DB::table('estatus_revisor_sinodal')->insert([
            'nombre' => 'SI ACEPTA SER REVISOR'
        ]);
        DB::table('estatus_revisor_sinodal')->insert([
            'nombre' => 'NO ACEPTA SER REVISOR'
        ]);
        DB::table('estatus_revisor_sinodal')->insert([
            'nombre' => 'SI APRUEBA EL PROYECTO'
        ]);
        DB::table('estatus_revisor_sinodal')->insert([
            'nombre' => 'NO APRUEBA EL PROYECTO'
        ]);
    }
}
