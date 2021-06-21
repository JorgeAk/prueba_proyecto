<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Session;
use DB;
use Carbon\Carbon;
use App\Role;
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


class CoordinacionTitulacionesController extends Controller
{
    public function index()
    {
        //$alumno = \DB::table('solicitudes')->get();
        $usr_c = auth()->user()->email;
        $recibidos_ind = $this->retorna_mensajes();
        $m_nuevos  = DB::table('chat_sistema')->where('receptor', "$usr_c")->where('estatus', "1")->count();

        $alumno = Solicitud::where('s_estatus', '!=', '1')->get();
        $resumen = $this->obtener_resumen();
        return view('coordinacion_t.index', compact('alumno', 'recibidos_ind', 'resumen'));
    }

    public function perfil()
    {
        $usr_c = auth()->user()->email;
        $recibidos_ind = $this->retorna_mensajes();
        $m_nuevos  = DB::table('chat_sistema')->where('receptor', "$usr_c")->where('estatus', "1")->count();
        $alumno = Solicitud::where('s_estatus', '!=', '1')->get();

        return view('coordinacion_t.perfil', compact('alumno', 'recibidos_ind'));
    }


    public function solicitudes()
    {
        $planes     = Plan::all();
        $titulacion = Optitulacion::all();
        $alumno     = Solicitud::where('s_estatus', '2')->orwhere('s_estatus', '4')->orwhere('s_estatus', '8')->orwhere('s_estatus', '9')->orwhere('s_estatus', '18')->orderBy('created_at', 'DESC')->get();
        $estatus    = Estatus::all();
        $revisores  = Revisor::all();
        $sinodales  = Sinodal::all();
        $profesores = Profesor::all();
        $carreras   = Carrera::all();
        $estatus2   = \DB::table('estatus_revisor_sinodal')->get();
        $recibidos_ind = $this->retorna_mensajes();
        $oficios    = DB::table('oficios_solicitud')->get();
        $documentos = DB::table('documentos_adjuntos')->get();
        $tipo_oficio = DB::table('oficios')->get();
        return view('coordinacion_t.solicitudes', compact('alumno', 'planes', 'estatus2', 'titulacion', 'estatus', 'profesores', 'revisores', 'sinodales', 'carreras', 'recibidos_ind', 'oficios', 'tipo_oficio', 'documentos'));
    }

    public function solicitudes_detalles($id)
    {
        $usr             = auth()->user()->id;
        $solicitud       = Solicitud::where('id', "$id")->get();
        $sol = array($solicitud);
        $v_documentos = array();
        if (count($solicitud) > 0) {

            foreach ($solicitud as $sol) {
                $estado = $sol->s_estatus;
            }
            if ($estado == 2) {
                Solicitud::where('id', '=', "$id")->update(['s_estatus' => 4]);
                //Registro en bitacora
            $usr = auth()->user()->username;
            $descripcion = "En revision por la Coordinacion de Titulaciones";
            $fecha_actual = Carbon::now();
            $this->registrar_bitacora($usr, $id, 4, $descripcion, $fecha_actual);
            }
            $planes          = Plan::all();
            $op_titulaciones = Optitulacion::all();
            $profesores      = Profesor::all();
            $revisores       = Revisor::all();
            $sinodales       = Sinodal::all();
            $carreras        = Carrera::all();
            $salas           = DB::table('sala_eventos')->where('disponibilidad', 1)->get();
            $documentos      = \DB::table('documentos_requeridos')->get();
            $v_docs    = \DB::table('validacion_documental')->where('id_solicitud', "$id")->exists();
            $date = Carbon::now();


            if ($v_docs == true) {
                $v_documentos = \DB::table('validacion_documental')->where('id_solicitud', "$id")->get();

                foreach ($documentos as $docs) {
                    //dd("hola2");
                    $v_docs2 = \DB::table('validacion_documental')->where('id_solicitud', "$id")->where('id_documento_requerido', "$docs->id")->exists();
                    //dd($v_docs2);
                    if ($v_docs2 == false) {
                        DB::table('validacion_documental')->insertGetId(['id_solicitud' => "$id", 'id_documento_requerido' => "$docs->id", 'entregado_correcto' => "0", 'comentario' => "S/N", 'created_at' => "{$date}", 'updated_at' => "{$date}"]);
                    }
                }
            } else {
                foreach ($documentos as $docs) {
                    //dd("hola2");
                    $v_docs2 = \DB::table('validacion_documental')->where('id_solicitud', "$id")->where('id_documento_requerido', "$docs->id")->exists();
                    //dd($v_docs2);
                    if ($v_docs2 == false) {
                        DB::table('validacion_documental')->insertGetId(['id_solicitud' => "$id", 'id_documento_requerido' => "$docs->id", 'entregado_correcto' => "0", 'comentario' => "S/N", 'created_at' => "{$date}", 'updated_at' => "{$date}"]);
                    }
                }
                //$v_documentos=array();
            }

            //dd($v_documentos);
            $oficios    = DB::table('oficios_solicitud')->where('id_solicitud', "$id")->get();
            $documentos_al = DB::table('documentos_adjuntos')->where('id_solicitud', "$id")->get();
            $tipo_oficio = DB::table('oficios')->get();
            $solicitud = Solicitud::where('id', "$id")->get();
            $recibidos_ind = $this->retorna_mensajes();

            return view('coordinacion_t.detalles', compact('solicitud', 'carreras', 'planes', 'op_titulaciones', 'profesores', 'revisores', 'sinodales', 'documentos', 'v_documentos', 'salas', 'recibidos_ind', 'oficios', 'documentos_al', 'tipo_oficio'));
        }

        return $this->index();
    }

    public function actualizar_documentacion(Request $request)
    {
        $id_sol = $request->input('solicitud');
        $oficio_asignacion_sinodales = $request->file('oficio_sol_sinodales'); //$request->file('oficio_sol_sinodales');
        //$tipo_oficio = 1;
        $fecha = Carbon::now();
        $documentos_r = DB::table('documentos_requeridos')->get();

        if (!empty($_POST)) {
            foreach ($_POST as $key => $value) {
                if (trim($value) != '') {
                    $sqlArr[$key] = "$value";
                }
            }
            unset($sqlArr['_token']);
            unset($sqlArr['solicitud']);
            unset($sqlArr['oficio_sol_sinodales']);
            unset($sqlArr['check']);

            foreach ($documentos_r as $doc_r) {
                DB::table('validacion_documental')->where('id_solicitud', '=', "$id_sol")->where('id_documento_requerido', "$doc_r->id")->update(['entregado_correcto' => 0]);
            }

            foreach ($sqlArr as $key => $value) {
                DB::table('validacion_documental')->where('id_solicitud', '=', "$id_sol")->where('id_documento_requerido', "$key")->update(['entregado_correcto' => 1]);
                //dd($value);
            }
            Session::flash('message', 'Documentos validados correctamente');
        }
        // Cambio de estado de la solicitud y verificacion de archivos subidos
        $verificar_s = DB::table('validacion_documental')->where('id_solicitud', "=", "$id_sol")->where('entregado_correcto', "=", 1)->get();

        if (count($verificar_s) == count($documentos_r) and !empty($oficio_asignacion_sinodales)) {

            $tip_of = 9;
            $tipo_solicitud = Solicitud::where('id', "$id_sol")->where('id_optitulacion', "4")->exists();
            if ($tipo_solicitud) {
                $tip_of = 13;
            }
            //$this->adjuntar_oficio($oficio_asignacion_sinodales,$tip_of,$id_sol);
            if ($request->hasFile('oficio_sol_sinodales')) {
                //indicamos que queremos guardar un nuevo archivo en el disco local
                $file = $request->file('oficio_sol_sinodales')->store('public');
                //dd($_FILES);
                $of_archivo_name = str_replace("public/", "", $file);
                $this->adjuntar_oficio($of_archivo_name, $tip_of, $id_sol);
            }
            $this->cambio_estado_solicitud($id_sol, 5);
            Session::flash('message', 'Se envio la solicitud a Docencia para dar seguimiento');

            //Registro en bitacora
            $usr = auth()->user()->username;
            $descripcion = "En proceso de Asignacion de sinodales ";
            $fecha_actual = Carbon::now();
            $this->registrar_bitacora($usr, $id_sol, 5, $descripcion, $fecha_actual);
        }

        $alumno = Solicitud::where('s_estatus', '!=', '1')->get();
        $recibidos_ind = $this->retorna_mensajes();
        $resumen = $this->obtener_resumen();

        return view('coordinacion_t.index', compact('alumno', 'recibidos_ind', 'resumen'));
    }


    public function documentos_obtener()
    {
        $documentos   = \DB::table('documentos_requeridos')->get();
        $recibidos_ind = $this->retorna_mensajes();
        return view('coordinacion_t.documentos', compact('documentos', 'recibidos_ind'));
    }

    public function doc_agregar()
    {
        $documentos   = \DB::table('documentos_requeridos')->get();
        $recibidos_ind = $this->retorna_mensajes();
        return view('coordinacion_t.documentos_agregar', compact('documentos', 'recibidos_ind'));
    }

    public function sal_agregar()
    {
        $documentos   = \DB::table('documentos_requeridos')->get();
        $recibidos_ind = $this->retorna_mensajes();
        return view('coordinacion_t.documentos_agregar', compact('documentos', 'recibidos_ind'));
    }

    public function documentos_nuevo(Request $request)
    {
        $nombre          = $request->input('nombre');
        $caracteristicas = $request->input('caracteristicas');
        $fecha = Carbon::now();
        DB::table('documentos_requeridos')->insert(['nombre' => $nombre, 'caracteristicas' => $caracteristicas, 'created_at' => $fecha, 'updated_at' => $fecha]);
        Session::flash('message', 'Documento Agregado');
        $documentos   = \DB::table('documentos_requeridos')->get();
        $recibidos_ind = $this->retorna_mensajes();
        return view('coordinacion_t.documentos', compact('documentos', 'recibidos_ind'));
    }

    public function documentos_actualizar(Request $request)
    {

        $id = $request->input('id_documento');

        foreach ($_POST as $key => $value) {
            if (trim($value) != '') {
                $sqlArr[$key] = "$value";
            }
        }
        unset($sqlArr['_token']);
        unset($sqlArr['id_documento']);

        if (!empty($id and !empty($sqlArr))) {
            Session::flash('message', 'Documento Actualizado');
            $documento = DB::table('documentos_requeridos')->where('id', '=', "$id")->update($sqlArr);
        } else {
            Session::flash('message', 'Documento NO  Actualizado');
        }

        $documentos   = \DB::table('documentos_requeridos')->get();
        $recibidos_ind = $this->retorna_mensajes();

        return view('coordinacion_t.documentos', compact('documentos', 'recibidos_ind'));
    }

    public function ceremonias(Request $request)
    {


        $ceremonias   = DB::table('ceremonias')->get();
        $alumnos      = Solicitud::all();
        $salas        = DB::table('sala_eventos')->get();
        $recibidos_ind = $this->retorna_mensajes();
        //dd($salas); 

        return view('coordinacion_t.ceremonias', compact('ceremonias', 'alumnos', 'salas', 'recibidos_ind'));
    }

    public function ceremonia_nuevo(Request $request)
    {

        $nombre          = $request->input('nombre');
        $descripcion     = $request->input('descripcion');
        $id_solicitud    = $request->input('id_solicitud');
        $fecha           = $request->input('fecha');
        $hora            = $request->input('hora');
        $id_sala         = $request->input('id_sala');
        $oficio_ceremonia = $request->file('oficio_ceremonia');
        $tipo_oficio = 3;

        $date = Carbon::now();
        //dd($_POST);
        $verificar_s = DB::table('ceremonias')->where('id_sala', "$id_sala")->where('fecha', "$fecha")->where('id_solicitud',"!=","$id_solicitud")->where('hora', "$hora")->exists();

        if ($verificar_s) {
            Session::flash('message', 'Empalme en fecha y hora para esta sala selecciona otra u otra fecha y hora');
        } else {
            $verificar_existe =  DB::table('ceremonias')->where('id_solicitud', "$id_solicitud")->exists();
            if ($verificar_existe) {
                DB::table('ceremonias')->update(['descripcion' => "$descripcion", 'fecha' => "$fecha", 'hora' => "$hora", 'id_sala' => "$id_sala", 'updated_at' => $date]);
            } else {
                DB::table('ceremonias')->insert(['nombre' => $nombre, 'descripcion' => $descripcion, 'id_solicitud' => $id_solicitud, 'fecha' => $fecha, 'hora' => $hora, 'id_sala' => $id_sala, 'created_at' => $date, 'updated_at' => $date]);
                Session::flash('message', 'Ceremonia Generada con exito se dara seguimiento');
            }
        }

        $documentos   = \DB::table('documentos_requeridos')->get();
        $salas        = \DB::table('sala_eventos')->get();
        // cambio de estado de la solicitud
        $solicitud_2  = Solicitud::where('id', "$id_solicitud")->get();

        foreach ($solicitud_2 as $sol) {
            $estado = $sol->s_estatus;
            //$tipo_s = $sol->id_optitulacion;
        }
        $tipo_s = $sol->id_optitulacion;


        // cambiar el estado de la solicitud cuando es ceneval
        if ($estado == 8 and $tipo_s == 4 and !empty($oficio_ceremonia)) {
            $tipo_oficio = 11;
            //dd( $estado);
            //DB::table('oficios_solicitud')->insert(['url'=>$oficio_ceremonia ,'id_tipo_oficio'=>$tipo_oficio,'id_solicitud'=>$id_solicitud ,'created_at'=>$fecha,'updated_at'=>$fecha]);
            if ($request->hasFile('oficio_ceremonia')) {
                $ofi_rexiste = DB::table('oficios_solicitud')->where('id_solicitud',"$id_solicitud")->where('id_tipo_oficio',"$tipo_oficio")->exists();
                if($ofi_rexiste){
                    if ($request->hasFile('oficio_ceremonia')) {
                        //indicamos que queremos guardar un nuevo archivo en el disco local
                        $alum_ofi = DB::table('oficios_solicitud')->where('id_solicitud', "$id_solicitud")->where('id_tipo_oficio',"$tipo_oficio")->first('url');
                        $alum_ofi_id = DB::table('oficios_solicitud')->where('id_solicitud', "$id_solicitud")->where('id_tipo_oficio',"$tipo_oficio")->first('id');
                        //dd($alum_ofi);
                        if (Storage::exists('public/' . $alum_ofi->url)) {
                            Storage::delete('public/' . $alum_ofi->url);
                        }
                        $file = $request->file('oficio_ceremonia')->store('public');
                        //dd($_FILES);
                        $of_archivo_name = str_replace("public/", "", $file);
                        $this->actualizar_archivo_oficio($alum_ofi_id->id,$of_archivo_name);
                        //$this->adjuntar_oficio($of_archivo_name, $tipo_oficio, $id_solicitud);
                        Session::flash('message', 'Ceremonia Actualizada con exito, Enviado a Docencia para dar seguimiento ');
                    }

                }else{
                     //indicamos que queremos guardar un nuevo archivo en el disco local
                $file = $request->file('oficio_ceremonia')->store('public');
                //dd($_FILES);
                $of_archivo_name = str_replace("public/", "", $file);
                $this->adjuntar_oficio($of_archivo_name, $tipo_oficio, $id_solicitud);

                }
               
            }
            Solicitud::where('id', '=', "$id_solicitud ")->update(['s_estatus' => 17]);
           

            $emisor  = auth()->user()->username;
            $correo  = auth()->user()->email;
            $asunto   = "Asignado para ser Sinodal";
            $mensaje  = "Muy buenos dias profesor (a) se le informa que a sido seleccionado para ser sinodal y asistir a la " . $nombre . " el dia " . $fecha . " apartir de las " . $hora . "horas, favor 
    de aceptar o rechachar participar como sinodal en la opcion de sinodales. att:Docencia";
            $sinodales = Sinodal::select('sinodales.id_profesor', 'profesores.correo')
                ->join('profesores', 'profesores.id', '=', 'sinodales.id_profesor')
                ->where('profesores.estatus', "1")
                ->where('sinodales.id_solicitud', "$id_solicitud")
                ->get();
            //dd($revisores);
            foreach ($sinodales as $rev) {
                $receptor = $rev->correo;
                $this->notificar($emisor, $correo, $receptor, $asunto, $mensaje);
            }

            //Registro en bitacora
            $usr = auth()->user()->username;
            $descripcion = "Ceremonia de titulacion asignada ";
            $fecha_actual = Carbon::now();
            $this->registrar_bitacora($usr, $id_solicitud, 17, $descripcion, $fecha_actual);

        }

        

        // cambiar el estado de la solicitud cuando es tesis
        if ($estado == 8 and $tipo_s != 4 and !empty($oficio_ceremonia)) {
            $tipo_oficio = 11;
            //$this->adjuntar_oficio($oficio_ceremonia,$tip_of,$id_solicitud );
            if ($request->hasFile('oficio_ceremonia')) {
                $ofi_rexiste = DB::table('oficios_solicitud')->where('id_solicitud',"$id_solicitud")->where('id_tipo_oficio',"$tipo_oficio")->exists();

                if($ofi_rexiste){
                    if ($request->hasFile('oficio_ceremonia')) {
                        //indicamos que queremos guardar un nuevo archivo en el disco local
                        $alum_ofi = DB::table('oficios_solicitud')->where('id_solicitud', "$id_solicitud")->where('id_tipo_oficio',"$tipo_oficio")->first('url');
                        $alum_ofi_id = DB::table('oficios_solicitud')->where('id_solicitud', "$id_solicitud")->where('id_tipo_oficio',"$tipo_oficio")->first('id');
                        //dd($alum_ofi);
                        if (Storage::exists('public/' . $alum_ofi->url)) {
                            Storage::delete('public/' . $alum_ofi->url);
                        }
                        $file = $request->file('oficio_ceremonia')->store('public');
                        //dd($_FILES);
                        $of_archivo_name = str_replace("public/", "", $file);
                        $this->actualizar_archivo_oficio($alum_ofi_id->id,$of_archivo_name);
                        //$this->adjuntar_oficio($of_archivo_name, $tipo_oficio, $id_solicitud);
                        Session::flash('message', 'Ceremonia Actualizada con exito, Enviado a Docencia para dar seguimiento ');
                    }

                }else{
                    //indicamos que queremos guardar un nuevo archivo en el disco local
                $file = $request->file('oficio_ceremonia')->store('public');
                //dd($_FILES);
                $of_archivo_name = str_replace("public/", "", $file);
                $this->adjuntar_oficio($of_archivo_name, $tipo_oficio, $id_solicitud);

                }


            }
            $this->cambio_estado_solicitud($id_solicitud, 17);
            Session::flash('message', 'Ceremonia Generada con exito, Enviado a Docencia para dar seguimiento ');

            $emisor  = auth()->user()->username;
            $correo  = auth()->user()->email;
            $asunto   = "Asignado para ser Sinodal";
            $mensaje  = "Muy buenos dias profesor (a) se le informa que a sido seleccionado para ser sinodal del alumno, favor 
    de aceptar o rechachar en la opcion de sinodales. att:Docencia";
            $sinodales = Sinodal::select('sinodales.id_profesor', 'profesores.correo')
                ->join('profesores', 'profesores.id', '=', 'sinodales.id_profesor')
                ->where('profesores.estatus', "1")
                ->where('sinodales.id_solicitud', "$id_solicitud")
                ->get();
            //dd($revisores);
            foreach ($sinodales as $rev) {
                $receptor = $rev->correo;
                $this->notificar($emisor, $correo, $receptor, $asunto, $mensaje);
            }

            //Registro en bitacora
            $usr = auth()->user()->username;
            $descripcion = "Ceremonia de titulacion asignada ";
            $fecha_actual = Carbon::now();
            $this->registrar_bitacora($usr, $id_solicitud, 17, $descripcion, $fecha_actual);
        }

        $alumnos      = Solicitud::all();
        $ceremonias      = DB::table('ceremonias')->get();
        $recibidos_ind = $this->retorna_mensajes();
        return view('coordinacion_t.ceremonias', compact('documentos', 'ceremonias', 'alumnos', 'salas', 'recibidos_ind'));
    }

    public function obtener_oficio($id){

        $datos= DB::table('oficios_campos')->where('id_tipo_oficio',"$id")->orderBy('orden', 'ASC')->get();

        echo   json_encode($datos);
    }

    private function actualizar_archivo_oficio($id, $nombre)
    {
        $fecha = Carbon::now();
        DB::table('oficios_solicitud')->where('id', "$id")->update(['url' => $nombre,  'updated_at' => $fecha]);
        return "exito";
    }


    public function ceremonia_actualizar(Request $request)
    {

        $id    = $request->input('id_ceremonia');
        $fecha = $request->input('fecha');
        $hora  = $request->input('hora');

        foreach ($_POST as $key => $value) {
            if (trim($value) != '') {
                $sqlArr[$key] = "$value";
            }
        }
        unset($sqlArr['_token']);
        unset($sqlArr['id_ceremonia']);
        //dd($sqlArr);
        if (!empty($id and !empty($sqlArr))) {
            $verificar_s = DB::table('ceremonias')->where('id', "$id")->where('fecha', "$fecha")->where('hora', "$hora")->exists();
            if ($verificar_s) {
                Session::flash('message', 'Empalme en fecha y hora para esta sala selecciona otra u otra fecha y hora');
            } else {

                Session::flash('message', 'Documento Actualizado');
                $documento = DB::table('ceremonias')->where('id', '=', "$id")->update($sqlArr);
            }
        } else {
            Session::flash('message', 'Ceremonia NO  Actualizada');
        }

        $ceremonias   = DB::table('ceremonias')->get();
        $alumnos      = Solicitud::all();
        $salas        = DB::table('sala_eventos')->get();
        $recibidos_ind = $this->retorna_mensajes();

        return view('coordinacion_t.ceremonias', compact('ceremonias', 'alumnos', 'salas', 'recibidos_ind'));
    }

    private function notificar($emisor, $correo, $receptor, $asunto, $mensaje)
    {
        $fecha = Carbon::now();
        $estatus = 1;
        $envio   = DB::table('chat_sistema')->insert(['usuario_envio' => $emisor, 'correo' => $correo, 'asunto' => $asunto, 'mensaje' => $mensaje, 'receptor' => $receptor, 'fecha' => $fecha, 'estatus' => $estatus, 'created_at' => $fecha, 'updated_at' => $fecha]);
        if ($envio) {
            return true;
        } else {
            return false;
        }
    }


    public function sala_nuevo(Request $request)
    {
        $nombre         = $request->input('nombre');
        $disponibilidad = $request->input('disponible');
        $fecha = Carbon::now();
        DB::table('sala_eventos')->insert(['nombre' => $nombre, 'disponibilidad' => $disponibilidad, 'created_at' => $fecha, 'updated_at' => $fecha]);
        Session::flash('message', 'Sala agregada');
        $alumno = Solicitud::where('s_estatus', '!=', '1')->get();
        $recibidos_ind = $this->retorna_mensajes();
        $resumen = $this->obtener_resumen();
        return view('coordinacion_t.index', compact('alumno', 'recibidos_ind', 'resumen'));
    }

    public function sala_obtener()
    {
        $salas   = \DB::table('sala_eventos')->get();
        $recibidos_ind = $this->retorna_mensajes();
        return view('coordinacion_t.salas', compact('salas', 'recibidos_ind'));
    }

    public function sala_actualizar(Request $request)
    {

        $id = $request->input('id_sala');

        foreach ($_POST as $key => $value) {
            if (trim($value) != '') {
                $sqlArr[$key] = "$value";
            }
        }
        unset($sqlArr['_token']);
        unset($sqlArr['id_sala']);

        if (!empty($id and !empty($sqlArr))) {
            Session::flash('message', 'Sala Actualizada');
            $sala = DB::table('sala_eventos')->where('id', '=', "$id")->update($sqlArr);
        } else {
            Session::flash('message', 'Documento NO  Actualizado');
        }

        $salas   = \DB::table('sala_eventos')->get();
        $recibidos_ind = $this->retorna_mensajes();

        return view('coordinacion_t.salas', compact('salas', 'recibidos_ind'));
    }

    public function obtener_oficios()
    {
        $us = "coordinacion_t";
        $oficios = DB::table('oficios')->where('us_genero', "$us")->get();
        $recibidos_ind = $this->retorna_mensajes();
        return view('coordinacion_t.oficios', compact('oficios', 'recibidos_ind'));
    }

    public function agregar_oficio(Request $request)
    {
        $nombre = $request->input('nombre');
        $estatus = $request->input('estatus');
        $caracteriticas = $request->input('caracteriticas');
        $fecha = Carbon::now();
        $us_genero = "coordinacion_t";
        DB::table('oficios')->insert(['nombre' => "$nombre", 'caracteristicas' => "$caracteriticas", 'estatus' => "$estatus", 'us_genero' => "$us_genero", 'created_at' => $fecha, 'updated_at' => $fecha]);
        Session::flash('message', 'Se agrego correctamente');
        $us = "coordinacion_t";
        $oficios = DB::table('oficios')->where('us_genero', "$us")->get();
        $recibidos_ind = $this->retorna_mensajes();
        return view('coordinacion_t.oficios', compact('oficios', 'recibidos_ind'));
    }

    public function actualizar_oficio(Request $request)
    {
        $id = $request->input('id_oficio');
        $nombre = $request->input('nombre');
        $estatus = $request->input('estatus');
        $caracteriticas = $request->input('caracteriticas');
        $fecha = Carbon::now();

        //dd($_POST);

        if (!empty($_POST) and !empty($id)) {
            $i = 1;
            foreach ($_POST as $key => $value) {
                if (trim($value) != '') {
                    $sqlArr[$key] = "$value";
                }
            }
            unset($sqlArr['_token']);
            unset($sqlArr['id_oficio']);


            DB::table('oficios')->where('id',"$id")->update($sqlArr);
            DB::table('oficios')->where('id',"$id")->update(['updated_at' => $fecha]);
            Session::flash('message', 'Se actualizo correctamente');
        }
        $us = "coordinacion_t";
        $oficios = DB::table('oficios')->where('us_genero', "$us")->get();
        $recibidos_ind = $this->retorna_mensajes();
        return view('coordinacion_t.oficios', compact('oficios', 'recibidos_ind'));
    }

    private function adjuntar_oficio($url, $tipo, $solicitud)
    {
        $fecha  = Carbon::now();
        $estado = DB::table('oficios_solicitud')->insert(['url' => $url, 'id_tipo_oficio' => $tipo, 'id_solicitud' => $solicitud, 'created_at' => $fecha, 'updated_at' => $fecha]);
        return $estado;
    }

    // Registro en la bitacora del movimiento de la solicitud 
    private function registrar_bitacora($usuario, $solicitud, $estatus, $descripcion, $fecha)
    {
        // verificar si ya se habia regitrado
        $verificar = DB::table('bitacora')->where('id_solicitud', "$solicitud")->where('id_estatus', "$estatus")->exists();
        if ($verificar) {
            $estado = DB::table('bitacora')->update(['updated_at' => $fecha]);
        } else {
            $estado = DB::table('bitacora')->insert(['id_usuario' => $usuario, 'id_solicitud' => $solicitud, 'id_estatus' => $estatus, 'descripcion' => $descripcion, 'created_at' => $fecha, 'updated_at' => $fecha]);
        }
        return $estado;
    }

    private function cambio_estado_solicitud($id_solicitud, $nuevo_estado)
    {
        $correcto = false;
        $cambio   = Solicitud::where('id', '=', "$id_solicitud")->update(['s_estatus' => $nuevo_estado]);
        if ($cambio) {
            $correcto = true;
        }
        return $correcto;
    }
    // --------------------------Mensajes
    public function obtener_mensajes($name)
    {
        if ($name == "inbox") {
            $usr = auth()->user()->email;
            $recibidos = DB::table('chat_sistema')->where('receptor', "$usr")->orderBy('fecha', 'DESC')->Paginate(15);
            $paginados = DB::table('chat_sistema')->where('receptor', "$usr")->orderBy('fecha', 'DESC')->simplePaginate(15);
            $enviados  = array();
            $m_nuevos  = DB::table('chat_sistema')->where('receptor', "$usr")->where('estatus', "1")->get();
            //dd($recibidos);
            $fecha = Carbon::now();
            //Session::flash('message', 'Sin acceso a mensajes');
            $recibidos_ind = $this->retorna_mensajes();
            return view('coordinacion_t.mensajes_inbox', compact('recibidos', 'enviados', 'm_nuevos', 'paginados', 'fecha', 'recibidos_ind'));
        } else {
            if ($name == "borrados") {
                $usr = auth()->user()->email;
                $estatus = 3;
                $recibidos = DB::table('chat_sistema')->where('receptor', "$usr")->where('estatus', "$estatus")->orderBy('fecha', 'DESC')->simplePaginate(15);
                $paginados = DB::table('chat_sistema')->where('receptor', "$usr")->orderBy('fecha', 'DESC')->simplePaginate(15);
                $enviados  = array();
                $m_nuevos  = DB::table('chat_sistema')->where('receptor', "$usr")->where('estatus', "1")->get();
                $recibidos_ind = $this->retorna_mensajes();

                return view('coordinacion_t.mensajes_inbox', compact('recibidos', 'enviados', 'm_nuevos', 'paginados', 'recibidos_ind'));
            } else {
                if ($name == "importantes") {
                    $usr = auth()->user()->email;
                    $estatus = 4;
                    $recibidos = DB::table('chat_sistema')->where('receptor', "$usr")->where('estatus', "$estatus")->orderBy('fecha', 'DESC')->simplePaginate(15);
                    $paginados = DB::table('chat_sistema')->where('receptor', "$usr")->orderBy('fecha', 'DESC')->simplePaginate(15);
                    $enviados  = array();
                    $m_nuevos  = DB::table('chat_sistema')->where('receptor', "$usr")->where('estatus', "1")->get();
                    $recibidos_ind = $this->retorna_mensajes();

                    return view('coordinacion_t.mensajes_inbox', compact('recibidos', 'enviados', 'm_nuevos', 'paginados', 'recibidos_ind'));
                } else {
                    if ($name == "enviados") {
                        $usr = auth()->user()->email;
                        $estatus = 4;
                        $recibidos = array();
                        $paginados = DB::table('chat_sistema')->where('receptor', "$usr")->orderBy('fecha', 'DESC')->simplePaginate(15);
                        $enviados  = DB::table('chat_sistema')->where('correo', "$usr")->orderBy('fecha', 'DESC')->simplePaginate(15);
                        $m_nuevos  = DB::table('chat_sistema')->where('receptor', "$usr")->where('estatus', "1")->get();
                        $recibidos_ind = $this->retorna_mensajes();


                        return view('coordinacion_t.mensajes_inbox_env', compact('recibidos', 'enviados', 'm_nuevos', 'paginados', 'recibidos_ind'));
                    }
                }
            }
        }
    }

    public function nuevo_mensaje()
    {
        $usr = auth()->user()->email;
        $usuarios = User::select('users.name', 'users.email', 'role_user.role_id', 'role_user.user_id', 'roles.description')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->where('role_user.role_id', '!=', "2")
            ->where('role_user.role_id', '!=', "3")
            ->where('role_user.role_id', '!=', "9")
            ->get();
        //dd($usuarios);
        //
        $m_nuevos  = DB::table('chat_sistema')->where('receptor', "$usr")->where('estatus', "1")->get();
        $recibidos_ind = $this->retorna_mensajes();

        return view('coordinacion_t.mensajes_nuevo', compact('usuarios', 'm_nuevos', 'recibidos_ind'));
    }

    public function mensajes_detalle($id)
    {
        $usr = auth()->user()->email;
        $mensaje   = DB::table('chat_sistema')->where('id', "$id")->where('receptor', "$usr")->orderBy('fecha', 'DESC')->get();
        $enviados  = DB::table('chat_sistema')->where('usuario_envio', "$usr")->get();
        $m_nuevos  = DB::table('chat_sistema')->where('receptor', "$usr")->where('estatus', "1")->get();
        $estatus = 2;
        $fecha = Carbon::now();
        DB::table('chat_sistema')->where('receptor', "$usr")->where('id', "$id")->update(['estatus' => $estatus, 'updated_at' => $fecha]);
        $ob_re  = DB::table('chat_sistema')->where('id', "$id")->first('correo');
        $id_receptor = User::where('email', "$ob_re->correo")->first('id');
        $id_receptor = $id_receptor->id;
        //DB::table('chat_sistema')->where('receptor',"$usr")->where('id',"$id")->update(['estatus'=>$estatus,'updated_at'=>$fecha]);
        //dd($ob_re->receptor);
        $recibidos_ind = $this->retorna_mensajes();
        return view('coordinacion_t.mensajes', compact('mensaje', 'enviados', 'm_nuevos', 'id_receptor', 'recibidos_ind'));
    }

    public function mensajes_detalle_r($id)
    {
        $usr = auth()->user()->email;
        $mensaje   = DB::table('chat_sistema')->where('id', "$id")->where('receptor', "$usr")->orderBy('fecha', 'DESC')->get();
        $enviados  = DB::table('chat_sistema')->where('usuario_envio', "$usr")->orderBy('fecha', 'DESC')->get();
        $m_nuevos  = DB::table('chat_sistema')->where('receptor', "$usr")->where('estatus', "1")->get();
        $estatus = 2;
        $fecha = Carbon::now();
        $ob_re  = DB::table('chat_sistema')->where('id', "$id")->first('receptor');
        $id_receptor = User::where('email', "$ob_re->receptor")->first('id');
        $id_receptor = $id_receptor->id;
        //DB::table('chat_sistema')->where('receptor',"$usr")->where('id',"$id")->update(['estatus'=>$estatus,'updated_at'=>$fecha]);
        //dd($ob_re->receptor);
        $recibidos_ind = $this->retorna_mensajes();
        return view('coordinacion_t.mensajes', compact('mensaje', 'enviados', 'm_nuevos', 'id_receptor', 'recibidos_ind'));
    }

    public function mensajes_detalle_r2($id)
    {
        $usr = auth()->user()->email;
        $mensaje   = DB::table('chat_sistema')->where('id', "$id")->where('correo', "$usr")->orderBy('fecha', 'DESC')->get();
        $enviados  = DB::table('chat_sistema')->where('usuario_envio', "$usr")->orderBy('fecha', 'DESC')->get();
        $m_nuevos  = DB::table('chat_sistema')->where('receptor', "$usr")->where('estatus', "1")->get();
        $estatus = 2;
        $fecha = Carbon::now();
        $ob_re  = DB::table('chat_sistema')->where('id', "$id")->first('receptor');
        $id_receptor = User::where('email', "$ob_re->receptor")->first('id');
        $id_receptor = $id_receptor->id;
        //DB::table('chat_sistema')->where('receptor',"$usr")->where('id',"$id")->update(['estatus'=>$estatus,'updated_at'=>$fecha]);
        //dd($ob_re->receptor);
        $recibidos_ind = $this->retorna_mensajes();
        return view('coordinacion_t.mensajes', compact('mensaje', 'enviados', 'm_nuevos', 'id_receptor', 'recibidos_ind'));
    }

    public function enviar_mensaje(Request $request)
    {
        $usr = auth()->user()->username;
        $mi_correo = auth()->user()->email;
        $destin = $request->input('usuario');
        $mensaje = $request->input('descr');
        $asunto = $request->input('asunto');
        $fecha = Carbon::now();

        $estatus = 1;
        $receptor = User::where('id', "$destin")->first('email');
        DB::table('chat_sistema')->insert(['usuario_envio' => $usr, 'correo' => $mi_correo, 'asunto' => $asunto, 'mensaje' => $mensaje, 'receptor' => $receptor->email, 'fecha' => $fecha, 'estatus' => $estatus, 'created_at' => $fecha, 'updated_at' => $fecha]);

        Session::flash('message', 'Mensaje enviado');

        return $this->obtener_mensajes('inbox');
    }

    public function retorna_mensajes()
    {
        $usr_c = auth()->user()->email;
        $recibidos_ind = DB::table('chat_sistema')->where('receptor', "$usr_c")->where('estatus', "1")->latest()->get();
        return $recibidos_ind;
    }

    private function obtener_resumen()
    {
        $solicitudes    = Solicitud::where('s_estatus', '=', '2')->count();
        $nuevas         = Solicitud::where('s_estatus', '2')->count();
        $aceptado       = Solicitud::where('s_estatus', '11')->orwhere('s_estatus', '11')->orwhere('s_estatus', '14')->count();
        $revision       = Solicitud::where('s_estatus', '7')->count();
        $rechazado      = Solicitud::where('s_estatus', '12')->count();

        $resumen = array('solicitudes' => "$solicitudes", 'nuevas' => "$nuevas", 'aceptados' => "$aceptado", 'revision' => "$revision", 'rechazado' => "$rechazado");

        return $resumen;
    }

    public function construir_oficio(Request $request)
    {
        //dd($_POST);
        $id_alumno   = $request->input('id_alumno');
        $tipo_oficio = $request->input('tipo_oficio');
        $carreras    = Carrera::all();
        $planes      = Plan::all();
        $titulaciones = DB::table('optitulacion')->get();
        $profesores   = Profesor::all();
        $revisores    = Revisor::where('id_solicitud', $id_alumno)->get();
        $sinodales    = Sinodal::where('id_solicitud', $id_alumno)->get();
        $fecha_acto_completa   = '';
        $salas = DB::table('sala_eventos')->get();

        $solicitud = Solicitud::where('id', "$id_alumno")->get();
        $fecha = Carbon::now();
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $fecha = Carbon::parse($fecha);
        $mes = $meses[($fecha->format('n')) - 1];
        $fecha_completa = $fecha->format('d') . ' de ' . $mes . ' de ' . $fecha->format('Y');
        if (!empty($request->input('fecha'))) {
            $fecha_acto = Carbon::parse($request->input('fecha'));
            $mes_acto = $meses[($fecha_acto->format('n')) - 1];
            $fecha_acto_completa = $fecha_acto->format('d') . ' de ' . $mes . ' de ' . $fecha->format('Y');
        }


        if (!empty($_POST)) {
            foreach ($_POST as $key => $value) {
                if (trim($value) != '') {
                    $sqlArr[$key] = "$value";
                }
            }
            unset($sqlArr['_token']);
            //dd($sqlArr);
            $datos = array($sqlArr);
            /*
        $datos = array(
            [
                'n_oficio'      => $request->input('num_oficio'),
                'dirigido'      => $request->input('dirigido'),
                'puesto'        => $request->input('puesto'),
                'genero'        => $request->input('genero'),
                'departamento'  => $request->input('departamento'),
                'p_academia'    => $request->input('n_presid_academia'),
                'area'          => $request->input('n_area'),
                'ccp'           => $request->input('ccp'),
                'ccp2'          => $request->input('ccp2'),
                'aacr'          => $request->input('aacr')
            ]
        );
        */
        }

        //dd($solicitud);

        $pdf = \PDF::loadView('coordinacion_t.oficios_imprimir', compact('datos', 'tipo_oficio', 'fecha', 'fecha_completa', 'solicitud', 'carreras', 'planes', 'titulaciones', 'profesores', 'revisores', 'sinodales', 'fecha_acto_completa', 'salas'));
        $pdf->setPaper('A4');
        return $pdf->stream('result.pdf');
        //return view('docencia.oficio_imprimir',compact('datos','tipo_oficio','fecha','solicitud'));
    }
}
