<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $role = new Role();
      $role->name = 'admin';
      $role->description = 'Administrator';
      $role->save();        
      $role = new Role();
      $role->name = 'alumno';
      $role->description = 'Alumno';
      $role->save();
      $role = new Role();
      $role->name = 'profesor';
      $role->description = 'Profesor';
      $role->save();
      $role = new Role();
      $role->name = 'docencia';
      $role->description = 'Docencia';
      $role->save();
      $role = new Role();
      $role->name = 'd_academico';
      $role->description = 'Departamento Academico';
      $role->save();
      $role = new Role();
      $role->name = 'coordinacion_t';
      $role->description = 'Coordinacion de titulaciones';
      $role->save();
      $role = new Role();
      $role->name = 'd_estudios_p';
      $role->description = 'Division de Estudios Profesionales';
      $role->save();
      $role = new Role();
      $role->name = 'coordinacion_s_e';
      $role->description = 'Coordinacion de Servicios Escolares';
      $role->save();
      $role = new Role();
      $role->name = 'servicio';
      $role->description = 'Personal del Servicio Solcial';
      $role->save();

    }
}
