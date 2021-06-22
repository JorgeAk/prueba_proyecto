<?php

use Illuminate\Database\Seeder;

class estatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estatus')->insert([
            'nombre' => 'CAPTURA DE SOLICITUD'
        ]);
        DB::table('estatus')->insert([
            'nombre' => 'SOLICITUD ENVIADA'
        ]);
        DB::table('estatus')->insert([
            'nombre' => 'EN REVISIÓN DOCENCIA'
        ]);
        DB::table('estatus')->insert([
            'nombre' => 'EN REVISIÓN COORDINACION DE TITULACIONES'
        ]);
        DB::table('estatus')->insert([
            'nombre' => 'ASIGNACION DE SINODALES'
        ]);

        DB::table('estatus')->insert([
            'nombre' => 'ASIGNACION DE REVISORES'
        ]);

        DB::table('estatus')->insert([
            'nombre' => 'REVISION DEL PROYECTO'
        ]);
        DB::table('estatus')->insert([
            'nombre' => 'ASIGACION DE CEREMONIA'
        ]);

        DB::table('estatus')->insert([
            'nombre' => 'TRAMITE DE TITULACION'
        ]);

        DB::table('estatus')->insert([
            'nombre' => 'ALUMNO TITULADO'
        ]);

        DB::table('estatus')->insert([
            'nombre' => 'PROYECTO APROBADO'
        ]);
        DB::table('estatus')->insert([
            'nombre' => 'PROYECTO RECHAZADO'
        ]);
        DB::table('estatus')->insert([
            'nombre' => 'TRAMITE CONCLUIDO'
        ]);
        DB::table('estatus')->insert([
            'nombre' => 'PROCESO DE LIBERACION DOCENCIA'
        ]);
        DB::table('estatus')->insert([
            'nombre' => 'OFICIO IMPRESION DEFINITIVA'
        ]);
        DB::table('estatus')->insert([
            'nombre' => 'GENERACION DE OFICIO'
        ]);

        DB::table('estatus')->insert([
            'nombre' => 'CEREMONIA ASIGNADA'
        ]);
        DB::table('estatus')->insert([
            'nombre' => 'PROYECTO LIBERADO'
        ]);
        
        
    }
}
