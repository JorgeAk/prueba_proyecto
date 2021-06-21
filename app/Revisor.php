<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revisor extends Model
{
    protected $table = 'revisores';
    protected $fillable =['id_profesor','id_solicitud','id_estatus','comentario','id_tipo'];
}
