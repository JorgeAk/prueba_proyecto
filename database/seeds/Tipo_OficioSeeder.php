<?php

use Illuminate\Database\Seeder;

class Tipo_OficioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oficios')->insert([
            'nombre' => 'Oficio Autorización de Opción de titulación',
            'caracteristicas' => '1',
            'estatus' => '1',
            'us_genero'=>'docencia',

        ]);

        DB::table('oficios')->insert([
            'nombre' => 'Oficio Registro de Proyecto(Tesis, Memoria de residencias, Proyecto de investigación)',
            'caracteristicas' => '1',
            'estatus' => '1',
            'us_genero'=>'docencia',

        ]);

        DB::table('oficios')->insert([
            'nombre' => 'Oficio de Asignación de Revisores (docencia)',
            'caracteristicas' => '1',
            'estatus' => '1',
            'us_genero'=>'docencia',

        ]);

        DB::table('oficios')->insert([
            'nombre' => 'Documento Acepta ser revisor (firma)',
            'caracteristicas' => '1',
            'estatus' => '1',
            'us_genero'=>'docencia',

        ]);

        DB::table('oficios')->insert([
            'nombre' => 'Oficio Autorización o Rechazo del proyecto',
            'caracteristicas' => '1',
            'estatus' => '1',
            'us_genero'=>'docencia',

        ]);

        DB::table('oficios')->insert([
            'nombre' => 'Oficio liberación de proyecto',
            'caracteristicas' => '1',
            'estatus' => '1',
            'us_genero'=>'docencia',

        ]);

        DB::table('oficios')->insert([
            'nombre' => 'Oficio de rechazo de Proyecto',
            'caracteristicas' => '1',
            'estatus' => '1',
            'us_genero'=>'docencia',

        ]);

        DB::table('oficios')->insert([
            'nombre' => 'Oficio Asignación de Sinodales',
            'caracteristicas' => '1',
            'estatus' => '1',
            'us_genero'=>'docencia',

        ]);

        DB::table('oficios')->insert([
            'nombre' => 'Oficio Asignación de Sinodales (coordinación)',
            'caracteristicas' => '1',
            'estatus' => '1',
            'us_genero'=>'coordinacion_t',

        ]);

        DB::table('oficios')->insert([
            'nombre' => 'Oficio Impresión definitiva',
            'caracteristicas' => '1',
            'estatus' => '1',
            'us_genero'=>'docencia',

        ]);

        DB::table('oficios')->insert([
            'nombre' => 'Oficio Solicitud de acto recepcional',
            'caracteristicas' => '1',
            'estatus' => '1',
            'us_genero'=>'coordinacion_t',

        ]);


        DB::table('oficios')->insert([
            'nombre' => 'Documento alumno titulado',
            'caracteristicas' => '1',
            'estatus' => '1',
            'us_genero'=>'servicios escolares',

        ]);

       



      

        

       
    }
}
