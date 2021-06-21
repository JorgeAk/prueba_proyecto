<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Profesor;
use App\Estatus;
use App\Optitulacion;
use App\Plan;
use App\Solicitud;
use App\Carrera;
use App\Ceremonia;
use App\Revisor;
use App\Sinodal;
class ImprimirController extends Controller
{
    public function imprimir(){

        //* SE ACTUALIZO VERIFICAR

        $usr             = auth()->user()->email;
        $date            = Carbon::now();
        $date            = $date->format('d-m-Y');
        $alumno          = Solicitud::where('p_correo',"$usr")->get();
        $planes          = Plan::all();
        $op_titulaciones = Optitulacion::all();
        $profesores      = Profesor::all();
        $sinodales = array();
        $revisores = array();
        $carreras = Carrera::all();

        foreach ($alumno  as $sol) {
            if ($sol->presidente != 0 and $sol->secretario != 0 and $sol->v_propietario != 0 and $sol->v_suplente != 0) {
                $sinodales = Profesor::all();
            }else{
                if ($sol->primer_revisor != 0 and $sol->segundo_revisor != 0 and $sol->tercer_revisor != 0 and $sol->cuarto_revisor != 0) {
                    $revisores = Profesor::all();
                }
            }
        }
        $pdf = \PDF::loadView('alumnos.imprimir',compact('alumno','date','planes','op_titulaciones','profesores','sinodales','revisores','carreras'));
        return $pdf->download('solicitud.pdf');
    }

    public function ver(){
        //* SE ACTUALIZO VERIFICAR
    	$usr    = auth()->user()->email;
        $date   = Carbon::now();
        $date   = $date->format('d-m-Y');
        $alumno = Solicitud::where('p_correo',"$usr")->get();
        $planes = Plan::all();
        $op_titulaciones = Optitulacion::all();
        $profesores      = Profesor::all();
        $sinodales = array();
        $revisores = array();
        $carreras = Carrera::all();

        foreach ($alumno  as $sol) {
            if ($sol->presidente != 0 and $sol->secretario != 0 and $sol->v_propietario != 0 and $sol->v_suplente != 0) {
                $sinodales = Profesor::all();
            } else {
                if ($sol->primer_revisor != 0 and $sol->segundo_revisor != 0 and $sol->tercer_revisor != 0 and $sol->cuarto_revisor != 0) {
                    $revisores = Profesor::all();
                }
            }
        }
        $pdf = \PDF::loadView('alumnos.imprimir',compact('alumno','date','planes','op_titulaciones','profesores','sinodales','revisores','carreras'));
        return $pdf->stream('result.pdf');
    }
}
