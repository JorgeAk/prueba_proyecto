<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table = 'solicitudes';
    protected $fillable = ['n_control','p_nombre','s_nombre','a_paterno','a_materno','municipio','cp','entidad_f','telefono','celular','p_correo','s_correo','id_carrera','id_plan','f_ingreso','f_egreso','id_optitulacion','n_proyecto','id_asesor','s_estatus','proy_archivo','repositorio_documentos'];
}

