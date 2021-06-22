<?php

use Illuminate\Database\Seeder;

class Oficio_CamposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oficios_campos')->insert([
            'nombre' => 'Numero de oficio',
            'nombre_corto' => 'num_oficio',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'1',
            'orden'=>'1'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Dirigido a:',
            'nombre_corto' => 'dirigido',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'1',
            'orden'=>'2'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Puesto',
            'nombre_corto' => 'puesto',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'1',
            'orden'=>'3'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Jefe del departamento',
            'nombre_corto' => 'genero',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'1',
            'orden'=>'4'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Departamento',
            'nombre_corto' => 'departamento',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'1',
            'orden'=>'5'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Presidente de la Academia',
            'nombre_corto' => 'n_presid_academia',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'1',
            'orden'=>'6'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Area',
            'nombre_corto' => 'n_area',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'1',
            'orden'=>'7'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'C.c.p/',
            'nombre_corto' => 'ccp',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'1',
            'orden'=>'8'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'C.c.p/',
            'nombre_corto' => 'ccp2',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'1',
            'orden'=>'9'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'AACR/',
            'nombre_corto' => 'aacr',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'1',
            'orden'=>'10'

        ]);

        DB::table('oficios_campos')->insert([
            'nombre' => 'Numero de oficio',
            'nombre_corto' => 'num_oficio',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'2',
            'orden'=>'1'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Dirigido a:',
            'nombre_corto' => 'dirigido',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'2',
            'orden'=>'2'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Puesto',
            'nombre_corto' => 'puesto',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'2',
            'orden'=>'3'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Jefe del departamento',
            'nombre_corto' => 'genero',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'2',
            'orden'=>'4'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Departamento',
            'nombre_corto' => 'departamento',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'2',
            'orden'=>'5'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Presidente de la Academia',
            'nombre_corto' => 'n_presid_academia',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'2',
            'orden'=>'6'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Area',
            'nombre_corto' => 'n_area',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'2',
            'orden'=>'7'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'C.c.p/',
            'nombre_corto' => 'ccp',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'2',
            'orden'=>'8'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'C.c.p/',
            'nombre_corto' => 'ccp2',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'2',
            'orden'=>'9'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'AACR/',
            'nombre_corto' => 'aacr',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'2',
            'orden'=>'10'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Jefe de proyecto investigación',
            'nombre_corto' => 'n_jefe_proy_inv',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'2',
            'orden'=>'11'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Departamento',
            'nombre_corto' => 'departamento_jefe_proy_inv',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'2',
            'orden'=>'12'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Observaciones',
            'nombre_corto' => 'observaciones',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'2',
            'orden'=>'13'

        ]);

  
        DB::table('oficios_campos')->insert([
            'nombre' => 'Numero de oficio',
            'nombre_corto' => 'num_oficio',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'3',
            'orden'=>'1'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Jefe (a) del departamento',
            'nombre_corto' => 'genero',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'3',
            'orden'=>'2'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Departamento',
            'nombre_corto' => 'departamento',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'3',
            'orden'=>'3'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Presidente de la Academia',
            'nombre_corto' => 'n_presid_academia',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'3',
            'orden'=>'4'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Area',
            'nombre_corto' => 'n_area',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'3',
            'orden'=>'5'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'C.c.p/',
            'nombre_corto' => 'ccp',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'3',
            'orden'=>'6'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'C.c.p/',
            'nombre_corto' => 'ccp2',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'3',
            'orden'=>'7'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'AACR/',
            'nombre_corto' => 'aacr',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'3',
            'orden'=>'8'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Primer revisor (Nombre Completo)',
            'nombre_corto' => 'p_revisor',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'3',
            'orden'=>'9'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Segundo revisor (Nombre Completo)',
            'nombre_corto' => 's_revisor',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'3',
            'orden'=>'10'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Tercer revisor (Nombre Completo)',
            'nombre_corto' => 't_revisor',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'3',
            'orden'=>'11'

        ]);

        DB::table('oficios_campos')->insert([
            'nombre' => 'Numero de oficio',
            'nombre_corto' => 'num_oficio',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'5',
            'orden'=>'1'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Jefe(a) proyecto Docencia',
            'nombre_corto' => 'jef_proy_doc',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'5',
            'orden'=>'2'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'C.c.p/',
            'nombre_corto' => 'ccp',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'5',
            'orden'=>'3'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'C.c.p/',
            'nombre_corto' => 'ccp2',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'5',
            'orden'=>'4'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'AACR/',
            'nombre_corto' => 'aacr',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'5',
            'orden'=>'5'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Primer revisor (Nombre Completo)',
            'nombre_corto' => 'p_revisor',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'5',
            'orden'=>'6'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Segundo revisor (Nombre Completo)',
            'nombre_corto' => 's_revisor',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'5',
            'orden'=>'7'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Tercer revisor (Nombre Completo)',
            'nombre_corto' => 't_revisor',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'5',
            'orden'=>'8'

        ]);
        

        DB::table('oficios_campos')->insert([
            'nombre' => 'Numero de oficio',
            'nombre_corto' => 'num_oficio',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'6',
            'orden'=>'1'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Dirigido a:',
            'nombre_corto' => 'dirigido',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'6',
            'orden'=>'2'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Puesto',
            'nombre_corto' => 'puesto',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'6',
            'orden'=>'3'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Primer revisor (Nombre Completo)',
            'nombre_corto' => 'p_revisor',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'6',
            'orden'=>'4'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Segundo revisor (Nombre Completo)',
            'nombre_corto' => 's_revisor',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'6',
            'orden'=>'5'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Tercer revisor (Nombre Completo)',
            'nombre_corto' => 't_revisor',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'6',
            'orden'=>'6'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'C.c.p/',
            'nombre_corto' => 'ccp',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'6',
            'orden'=>'7'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'C.c.p/',
            'nombre_corto' => 'ccp2',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'6',
            'orden'=>'8'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'AACR/',
            'nombre_corto' => 'aacr',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'6',
            'orden'=>'9'

        ]);

        
        DB::table('oficios_campos')->insert([
            'nombre' => 'Numero de oficio',
            'nombre_corto' => 'num_oficio',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'7',
            'orden'=>'1'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Dirigido a:',
            'nombre_corto' => 'dirigido',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'7',
            'orden'=>'2'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Puesto',
            'nombre_corto' => 'puesto',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'7',
            'orden'=>'3'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Jefe del departamento',
            'nombre_corto' => 'genero',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'7',
            'orden'=>'4'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Departamento',
            'nombre_corto' => 'departamento',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'7',
            'orden'=>'5'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Presidente de la Academia',
            'nombre_corto' => 'n_presid_academia',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'7',
            'orden'=>'6'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Area',
            'nombre_corto' => 'n_area',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'7',
            'orden'=>'7'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'C.c.p/',
            'nombre_corto' => 'ccp',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'7',
            'orden'=>'8'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'C.c.p/',
            'nombre_corto' => 'ccp2',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'7',
            'orden'=>'9'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'AACR/',
            'nombre_corto' => 'aacr',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'7',
            'orden'=>'10'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Dependencia',
            'nombre_corto' => 'dependencia',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'7',
            'orden'=>'11'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Seccion',
            'nombre_corto' => 'seccion',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'7',
            'orden'=>'12'

        ]);
        
        DB::table('oficios_campos')->insert([
            'nombre' => 'Numero de oficio',
            'nombre_corto' => 'num_oficio',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'8',
            'orden'=>'1'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Dirigido a:',
            'nombre_corto' => 'dirigido',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'8',
            'orden'=>'2'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Puesto',
            'nombre_corto' => 'puesto',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'8',
            'orden'=>'3'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Jefe del departamento',
            'nombre_corto' => 'genero',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'8',
            'orden'=>'4'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Departamento',
            'nombre_corto' => 'departamento',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'8',
            'orden'=>'5'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Presidente',
            'nombre_corto' => 'presidente',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'8',
            'orden'=>'6'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Secretario',
            'nombre_corto' => 'secretario',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'8',
            'orden'=>'7'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Vocal',
            'nombre_corto' => 'vocal',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'8',
            'orden'=>'8'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Vocal Suplente',
            'nombre_corto' => 'vocal_suplente',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'8',
            'orden'=>'9'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'C.c.p/',
            'nombre_corto' => 'ccp',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'8',
            'orden'=>'10'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'C.c.p/',
            'nombre_corto' => 'ccp2',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'8',
            'orden'=>'11'

        ]);
       
        DB::table('oficios_campos')->insert([
            'nombre' => 'AACR/',
            'nombre_corto' => 'aacr',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'8',
            'orden'=>'12'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Dependencia',
            'nombre_corto' => 'dependencia',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'8',
            'orden'=>'13'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Seccion',
            'nombre_corto' => 'seccion',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'8',
            'orden'=>'14'

        ]);

        
        DB::table('oficios_campos')->insert([
            'nombre' => 'Numero de oficio',
            'nombre_corto' => 'num_oficio',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'9',
            'orden'=>'1'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Dirigido a:',
            'nombre_corto' => 'dirigido',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'9',
            'orden'=>'2'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Puesto',
            'nombre_corto' => 'puesto',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'9',
            'orden'=>'3'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Coordinador (a) de apoyo a la titulaciono',
            'nombre_corto' => 'genero',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'9',
            'orden'=>'4'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'C.c.p/',
            'nombre_corto' => 'ccp',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'9',
            'orden'=>'5'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'LMCA/*',
            'nombre_corto' => 'aacr',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'9',
            'orden'=>'6'

        ]);

        
        DB::table('oficios_campos')->insert([
            'nombre' => 'Numero de oficio',
            'nombre_corto' => 'num_oficio',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'10',
            'orden'=>'1'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Dirigido a:',
            'nombre_corto' => 'dirigido',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'10',
            'orden'=>'2'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Puesto',
            'nombre_corto' => 'puesto',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'10',
            'orden'=>'3'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Presidente',
            'nombre_corto' => 'presidente',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'10',
            'orden'=>'4'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Secretario',
            'nombre_corto' => 'secretario',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'10',
            'orden'=>'5'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Vocal',
            'nombre_corto' => 'vocal',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'10',
            'orden'=>'6'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Vocal Suplente',
            'nombre_corto' => 'vocal_suplente',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'10',
            'orden'=>'7'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'C.c.p/',
            'nombre_corto' => 'ccp',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'10',
            'orden'=>'8'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'C.c.p/',
            'nombre_corto' => 'ccp2',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'10',
            'orden'=>'9'

        ]);
       
        DB::table('oficios_campos')->insert([
            'nombre' => 'AACR/',
            'nombre_corto' => 'aacr',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'10',
            'orden'=>'10'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Dependencia',
            'nombre_corto' => 'dependencia',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'10',
            'orden'=>'11'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Seccion',
            'nombre_corto' => 'seccion',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'10',
            'orden'=>'12'

        ]);

        
        DB::table('oficios_campos')->insert([
            'nombre' => 'Numero de oficio',
            'nombre_corto' => 'num_oficio',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'11',
            'orden'=>'1'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Jefe (a) del departamento de Servicios Escolares',
            'nombre_corto' => 'jef_serv_escolares',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'11',
            'orden'=>'2'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Jefe (a) de la Div. de Est. Profesionales',
            'nombre_corto' => 'jef_div_est_prof',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'11',
            'orden'=>'3'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Fecha',
            'nombre_corto' => 'fecha',
            'tipo' => 'date',
            'requerido'=>'1',
            'id_tipo_oficio' =>'11',
            'orden'=>'4'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Hora inicio',
            'nombre_corto' => 'hora_inicio',
            'tipo' => 'time',
            'requerido'=>'1',
            'id_tipo_oficio' =>'11',
            'orden'=>'5'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Hora de fin',
            'nombre_corto' => 'hora_fin',
            'tipo' => 'time',
            'requerido'=>'1',
            'id_tipo_oficio' =>'11',
            'orden'=>'6'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'C.c.p/',
            'nombre_corto' => 'ccp',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'11',
            'orden'=>'7'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'C.c.p/',
            'nombre_corto' => 'ccp2',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'11',
            'orden'=>'8'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'C.c.p/',
            'nombre_corto' => 'ccp3',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'11',
            'orden'=>'9'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'C.c.p/',
            'nombre_corto' => 'ccp4',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'11',
            'orden'=>'10'

        ]);
        
        DB::table('oficios_campos')->insert([
            'nombre' => 'PMV/',
            'nombre_corto' => 'aacr',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'11',
            'orden'=>'11'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Dependencia',
            'nombre_corto' => 'dependencia',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'11',
            'orden'=>'13'

        ]);
        DB::table('oficios_campos')->insert([
            'nombre' => 'Seccion',
            'nombre_corto' => 'seccion',
            'tipo' => 'text',
            'requerido'=>'1',
            'id_tipo_oficio' =>'11',
            'orden'=>'14'

        ]);





        
        
       


    }
}
