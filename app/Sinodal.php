<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sinodal extends Model
{
    protected $table = 'sinodales';
    protected $fillable =['id_profesor','id_solicitud','id_estatus','comentario','id_tipo'];
}
