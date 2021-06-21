<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    protected $table = 'profesores';
    protected $fillable = [
        'p_nombre', 's_nombre', 'a_paterno','a_materno','rfc','correo','celular','departamento','estatus', 'password',
    ];
}
