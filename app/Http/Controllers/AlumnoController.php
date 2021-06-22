<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
//use Illuminate\Support\Facades\DB;
use DB;
use Carbon\Carbon;
use Session;
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

class AlumnoController extends Controller
{
    public function index()
    {
        //$usr=auth()->user()->email;
        //$alumno = \DB::table('alumnos')->where('p_correo','=',"$usr")->get();
        //$request->user()->authorizeRoles('user');
        $mensajes_rec = $this->verificar_mensajes();
        //dd($mensajes_rec);
        return view('alumnos.index', compact('mensajes_rec'));
    }

    public function actualiza_archivo(Request $request)
    {
        $usr          = auth()->user()->username;
        $id_solicitud =  Solicitud::where('n_control', "$usr")->first('id');
        $mi_id        = Solicitud::where('n_control', "$usr")->first('proy_archivo');
        $fecha = Carbon::now();
        $estatus = 1;

        //ACTUALIZANDO IMAGEN SI VIENE CON CONTENIDO
        if ($request->hasFile('proy_archivo')) {
            $file = $request->file('proy_archivo');
            //si el archivo existe que sea eliminado antes de registrar otro
            if (Storage::exists('public/' . $mi_id->proy_archivo)) {
                Storage::delete('public/' . $mi_id->proy_archivo);
            }
            //indicamos que queremos guardar un nuevo archivo en el disco local
            $file = $request->file('proy_archivo')->store('public');
            $pro_archivo = str_replace("public/", "", $file);
            $this->registra_archivo($id_solicitud->id, "Archivo_adjunto", $pro_archivo, $usr, "A");
            Solicitud::where('n_control', "$usr")->update(['proy_archivo' => "$pro_archivo"]);

            //si no se cambia el archivo, se deja la que tenia
            Session::flash('message', 'Se actualizo el archivo');
        }


        $mensajes_rec = $this->verificar_mensajes();
        //dd($mensajes_rec);
        return view('alumnos.index', compact('mensajes_rec'));
    }

    public function perfil()
    {
        $mensajes_rec = $this->verificar_mensajes();
        return view('alumnos.perfil', compact('mensajes_rec'));
    }

    public function obtener_mensajes()
    {
        $usr       = auth()->user()->username;
        $solicitud = Solicitud::where('n_control', "$usr")->where('id_optitulacion', '!=', 4)->where('s_estatus', 7)->get();
        $profesores = Profesor::all();


        if (count($solicitud) > 0) {
            foreach ($solicitud as $sol) {
                $estado = $sol->s_estatus;
                //$tipo_s = $sol->id_optitulacion;
            }
            $tipo_s = $sol->id;
            $mensajes   = DB::table('chat_proyecto')->where('id_solicitud', "$tipo_s")->orderBy('fecha', 'ASC')->get();
            $revisores  = Revisor::where('id_solicitud', "$tipo_s")->where('id_estatus', 5)->get();
            $mensajes_rec = $this->verificar_mensajes();
            return view('alumnos.mensajes', compact('mensajes', 'profesores', 'solicitud', 'revisores', 'mensajes_rec'));
        } else {

            Session::flash('message', 'Sin acceso a mensajes');
            $mensajes_rec = $this->verificar_mensajes();
            return view('alumnos.index', compact('mensajes_rec'));
        }
    }

    public function enviar_mensaje(Request $request)
    {
        $usr          = auth()->user()->username;
        $id_solicitud =  $request->input('solicitud');
        $id_revisor   =  $request->input('revisor');
        $mensaje      =  $request->input('mensaje');
        $revisor      =  Revisor::where('id', "$id_revisor")->first('id_profesor');
        $receptor     =  Profesor::where('id', "$revisor->id_profesor")->first('rfc');
        $fecha = Carbon::now();
        $estatus = 1;
        //dd($receptor->rfc);
        if (!empty($id_solicitud) and !empty($id_revisor) and !empty($mensaje)) {
            DB::table('chat_proyecto')->insert(['usuario_envio' => $usr, 'mensaje' => $mensaje, 'id_solicitud' => $id_solicitud, 'id_revisor' => $id_revisor, 'receptor' => $receptor->rfc, 'fecha' => $fecha, 'estatus' => $estatus, 'created_at' => $fecha, 'updated_at' => $fecha]);
            Session::flash('message', 'Mensaje enviado');
        }

        //dd($request->file('proy_archivo'));

        //ADJUNTANDO ARCHIVO SI ENVIO USUARIO
        if ($request->hasFile('proy_archivo')) {
            $file = $request->file('proy_archivo');
            //si el archivo existe que sea eliminado antes de registrar otro
            /*
            if(Storage::exists('public/'.$mi_id->proy_archivo)) {
                Storage::delete('public/'.$mi_id->proy_archivo);
            }
            */
            //indicamos que queremos guardar un nuevo archivo en el disco local
            $file = $request->file('proy_archivo')->store('public');
            //dd($file);
            $pro_archivo = str_replace("public/", "", $file);
            DB::table('chat_proyecto')->insert(['usuario_envio' => $usr, 'mensaje' => $pro_archivo, 'id_solicitud' => $id_solicitud, 'id_revisor' => $id_revisor, 'receptor' => $receptor->rfc, 'fecha' => $fecha, 'estatus' => $estatus, 'referencia' => "adj", 'created_at' => $fecha, 'updated_at' => $fecha]);
            $this->registra_archivo($id_solicitud, "Archivo_adjunto", $pro_archivo, $usr, "A");
        }


        // datos para la vista
        $solicitud = Solicitud::where('n_control', "$usr")->get();
        $profesores = Profesor::all();
        foreach ($solicitud as $sol) {
            $estado = $sol->s_estatus;
            //$tipo_s = $sol->id_optitulacion;
        }
        $tipo_s = $sol->id;
        $mensajes   = DB::table('chat_proyecto')->where('id_solicitud', "$tipo_s")->get();
        $revisores  = Revisor::where('id_solicitud', "$tipo_s")->get();
        $mensajes_rec = $this->verificar_mensajes();

        return view('alumnos.mensajes', compact('mensajes', 'profesores', 'solicitud', 'revisores', 'mensajes_rec'));
    }

    public function generar()
    {
        $usr             = auth()->user()->username;
        $planes          = Plan::all();
        $op_titulaciones = Optitulacion::all();
        $profesores      = Profesor::where('estatus', "1")->get();
        $generar         = Solicitud::where('n_control', "$usr")->get();
        $carreras        = Carrera::all();
        $documentos = DB::table('documentos_requeridos')->get();
        $mensajes_rec = $this->verificar_mensajes();

        if ($generar->isEmpty()) {

            return view('alumnos.generar', compact('planes', 'op_titulaciones', 'profesores', 'carreras', 'mensajes_rec', 'documentos'));
        } else {
            $solicitud = Solicitud::where('n_control', "$usr")->get();

            return view('alumnos.solicitud', compact('solicitud', 'mensajes_rec'));
        }
    }

    public function redirec()
    {
        $mensajes_rec = $this->verificar_mensajes();
        //if (Auth::check()) {
            //return view('alumnos.index');
            //return redirect()->guest('/alumnos');
        //}else{
            return view('alumnos.login');

        //}
        
    }

    public function registrar(Request $request)
    {

        
        $numero_control  =  auth()->user()->username; //$request->input('n_control');
        $verifica = Solicitud::where('n_control', "$numero_control")->exists();
        

        if ($verifica) {
            Session::flash('message', 'Solicitud ya fue generada');
        } else {
           

            $primer_nombre   =  strtoupper($request->input('p_nombre'));
            $segundo_nombre  =  strtoupper($request->input('s_nombre'));
            $a_paterno       =  strtoupper($request->input('a_paterno'));
            $a_materno       =  strtoupper($request->input('a_materno'));
            $municipio       =  strtoupper($request->input('municipio'));
            $cp              =  $request->input('cp');
            $entidad_f       =  $request->input('entidad_f');
            $telefono        =  $request->input('telefono');
            $celular         =  $request->input('celular');
            $p_correo        =  auth()->user()->email;
            $s_correo        =  $request->input('s_correo');
            $carrera         =  $request->input('carrera');
            $plan            =  $request->input('plan');
            $f_ingreso       =  $request->input('f_ingreso');
            $f_egreso        =  $request->input('f_egreso');
            $op_titulacion   =  $request->input('op_titulacion');
            $n_proyecto      =  strtoupper($request->input('n_proyecto'));
            $asesor          =  $request->input('id_asesor');
            $link_repo       =  $request->input('link_repo');
            $presidente      =  $request->input('presidente');
            $secretario      =  $request->input('secretario');
            $v_propietario   =  $request->input('v_propietario');
            $v_suplente      =  $request->input('v_suplente');

            $slug            = uniqid();

            $sin_revisor   = 0;
            $sin_sinodal   = 0;
            $sin_asesor    = 0;
            $sin_nproyecto = "";
            $sin_p_archivo = "";
            $fecha_actual  = Carbon::now();
            $s_estatus     = 1;
            $sin_comentario = "sin comentario";
            $tipo1 = 1;
            $tipo2 = 2;
            $tipo3 = 3;
            $tipo4 = 4;
            //CARGA DE ARCHIVO

            if ($request->hasFile('proy_archivo')) {
                $pro_archivo = $request->file('proy_archivo')->store('public');
                $pro_archivo = str_replace("public/", "", $pro_archivo);
            } else {
                $pro_archivo  = "";
            }
            if ($op_titulacion == 4) {

                $duplicados = $this->verifica_dup_sinodal($presidente, $secretario, $v_propietario, $v_suplente);

                if ($duplicados == true) {
                    Session::flash('message', 'Propuesta de sinodales duplicados, Verificar');
                } else {
                    //Registro de la solicitud
                    $datos = new Solicitud(array(
                        'n_control'       => $numero_control,
                        'p_nombre'        => $primer_nombre,
                        's_nombre'        => $segundo_nombre,
                        'a_paterno'       => $a_paterno,
                        'a_materno'       => $a_materno,
                        'municipio'       => $municipio,
                        'cp'              => $cp,
                        'entidad_f'       => $entidad_f,
                        'telefono'        => $telefono,
                        'celular'         => $celular,
                        'p_correo'        => $p_correo,
                        's_correo'        => $s_correo,
                        'id_carrera'      => $carrera,
                        'id_plan'         => $plan,
                        'f_ingreso'       => $f_ingreso,
                        'f_egreso'        => $f_egreso,
                        'id_optitulacion' => $op_titulacion,
                        'n_proyecto'      => $sin_nproyecto,
                        'id_asesor'       => $sin_asesor,
                        's_estatus'       => $s_estatus,
                        'proy_archivo'    => $pro_archivo,
                        'repositorio_documentos' => $link_repo
                    ));
                    $datos->save();


                    $id_solicitud = Solicitud::where('n_control', "$numero_control")->first('id');
                    $sinodales1 = new Sinodal(array(
                        'id_profesor'  => $presidente,
                        'id_solicitud' => $id_solicitud->id,
                        'id_estatus'   => $s_estatus,
                        'comentario'   => $sin_comentario,
                        'id_tipo'      => $tipo1
                    ));
                    $sinodales2 = new Sinodal(array(
                        'id_profesor'  => $secretario,
                        'id_solicitud' => $id_solicitud->id,
                        'id_estatus'   => $s_estatus,
                        'comentario'   => $sin_comentario,
                        'id_tipo'      => $tipo2,
                    ));
                    $sinodales3 = new Sinodal(array(
                        'id_profesor'  => $v_propietario,
                        'id_solicitud' => $id_solicitud->id,
                        'id_estatus'   => $s_estatus,
                        'comentario'   => $sin_comentario,
                        'id_tipo'      => $tipo3,
                    ));
                    $sinodales4 = new Sinodal(array(
                        'id_profesor'  => $v_suplente,
                        'id_solicitud' => $id_solicitud->id,
                        'id_estatus'   => $s_estatus,
                        'comentario'   => $sin_comentario,
                        'id_tipo'      => $tipo4,
                    ));
                    $sinodales1->save();
                    $sinodales2->save();
                    $sinodales3->save();
                    $sinodales4->save();

                    // almacenando en bistacora
                    //obtenemos el id generado de la solicitud
                    $id_gen = $id_solicitud->id;
                    $descripcion = "Se genero la solicitud";
                    $this->registrar_bitacora($numero_control, $id_gen, $s_estatus, $descripcion, $fecha_actual);

                    // Almacenamos documentacion del alumno
                    if (count($_FILES) > 0) {
                        foreach ($_FILES as $name => $value) {
                            $arch = $request->file($name)->store('public');
                            $arch_n = str_replace("public/", "", $arch);
                            $this->registra_archivo($datos->id, $name, $arch_n, $numero_control, "A");
                        }
                    }
                    Session::flash('message', 'Solicitud Generada con exito');
                }
            } else {
                
                    $datos = new Solicitud(array(
                        'n_control'       => $numero_control,
                        'p_nombre'        => $primer_nombre,
                        's_nombre'        => $segundo_nombre,
                        'a_paterno'       => $a_paterno,
                        'a_materno'       => $a_materno,
                        'municipio'       => $municipio,
                        'cp'              => $cp,
                        'entidad_f'       => $entidad_f,
                        'telefono'        => $telefono,
                        'celular'         => $celular,
                        'p_correo'        => $p_correo,
                        's_correo'        => $s_correo,
                        'id_carrera'      => $carrera,
                        'id_plan'         => $plan,
                        'f_ingreso'       => $f_ingreso,
                        'f_egreso'        => $f_egreso,
                        'id_optitulacion' => $op_titulacion,
                        'n_proyecto'      => $n_proyecto,
                        'id_asesor'       => $asesor,
                        's_estatus'       => $s_estatus,
                        'proy_archivo'    => $pro_archivo,
                        'repositorio_documentos' => $link_repo
                    ));

                    $datos->save();
                    //Almacenar referencia Archivo
                    //$this->registra_archivo($datos->id,$n_proyecto,$pro_archivo,$numero_control,"A");
                    // almacenando en bistacora
                    //obtenemos el id generado de la solicitud
                    $id_gen = $datos->id;
                    $descripcion = "Se genero la solicitud";
                    $this->registrar_bitacora($numero_control, $id_gen, $s_estatus, $descripcion, $fecha_actual);

                    // Almacenamos documentacion del alumno
                    if (count($_FILES) > 0) {
                        foreach ($_FILES as $name => $value) {
                            $arch = $request->file($name)->store('public');
                            $arch_n = str_replace("public/", "", $arch);
                            $this->registra_archivo($datos->id, $name, $arch_n, $numero_control, "A");
                        }
                    }
                
                Session::flash('message', 'Solicitud Generada con exito');
            }
        }


        $mensajes_rec = $this->verificar_mensajes();
        return view('alumnos.index', compact('mensajes_rec'));
    }

    public function obtener()
    {
        //* SE ACTUALIZO

        $usr       = auth()->user()->username;
        $solicitud = Solicitud::where('n_control', "$usr")->get();
        $mi_id = Solicitud::where('n_control', "$usr")->first('id');

        $planes    = Plan::all();
        $op_titulaciones = Optitulacion::all();
        $profesores = Profesor::all();
        $carreras   = Carrera::all();

        if (!empty($mi_id->id)) {
            $sinodales = Sinodal::where('id_solicitud', "$mi_id->id")->get();
            $revisores = Revisor::where('id_solicitud', "$mi_id->id")->get();
        } else {
            $sinodales = array();
            $revisores = array();
        }


        $mensajes_rec = $this->verificar_mensajes();
        return view('alumnos.solicitud', compact('solicitud', 'planes', 'op_titulaciones', 'sinodales', 'revisores', 'profesores', 'carreras', 'mensajes_rec'));
    }

    public function obtenerAL()
    {
        //* SE ACTUALIZO
        $usr             = auth()->user()->username;
        $solicitud       = Solicitud::where('n_control', "$usr")->get();
        $planes          = Plan::all();
        $op_titulaciones = Optitulacion::all();
        $profesores      = Profesor::all();
        $carreras        = Carrera::all();
        $mensajes_rec = $this->verificar_mensajes();
        $documentos = DB::table('documentos_requeridos')->get();
        return view('alumnos.editar', compact('solicitud', 'planes', 'op_titulaciones', 'profesores', 'carreras', 'mensajes_rec', 'documentos'));
    }

    public function actualizar(Request $request)
    {
        //* SE ACTUALIZO

        //Para Actualizar datos de la solicitud
        $usr        = auth()->user()->username;
        $mi_id      = Solicitud::where('n_control', "$usr")->first('proy_archivo');
        $op_titulacion   =  $request->input('id_optitulacion');
        $limpiar = 0;
        $sin_archivo = "";
        $id_miSol = Solicitud::where('n_control', "$usr")->first('id');
        $mis_archivos = DB::table('documentos_adjuntos')->where('usuario_subio', "$usr")->get();


        // Eliminar Archivos
        if (count($_FILES) > 0) {
            //dd($mis_archivos);
            foreach ($_FILES as $name => $value) {

                foreach ($mis_archivos as $m_ar) {
                    //dd($m_ar);
                    if ($name == $m_ar->documento and $m_ar->documento != "proy_archivo") {
                        //si el archivo existe que sea eliminado antes de registrar otro
                        if (Storage::exists('public/' . $m_ar->ruta)) {
                            Storage::delete('public/' . $m_ar->ruta);
                        }
                    }
                }
            }
        }

        // Almacenamos archivo
        if (count($_FILES) > 0) {
            //dd($mis_archivos);
            foreach ($_FILES as $name => $value) {
                foreach ($mis_archivos as $m_ar) {
                    //dd($m_ar);
                    if ($name == $m_ar->documento and $m_ar->documento != "proy_archivo") {
                        //Almacena Archivos
                        if ($request->file($name) != null) {
                            $arch = $request->file($name)->store('public');

                            $arch_n = str_replace("public/", "", $arch);
                            $this->actualizar_archivo($m_ar->id, $name, $arch_n);
                            //$this->registra_archivo($datos->id,$name,$arch_n,$numero_control,"A");

                        }
                    }
                }
            }
        }

        //ACTUALIZANDO Archivo de proyecto
        if ($request->hasFile('proy_archivo')) {
            $file = $request->file('proy_archivo');
            //si el archivo existe que sea eliminado antes de registrar otro
            if (Storage::exists('public/' . $mi_id->proy_archivo)) {
                Storage::delete('public/' . $mi_id->proy_archivo);
            }
            //indicamos que queremos guardar un nuevo archivo en el disco local
            $file = $request->file('proy_archivo')->store('public');
            $pro_archivo = str_replace("public/", "", $file);
            $this->actualizar_archivo($m_ar->id, 'proy_archivo', $pro_archivo);

            //si no se cambia el archivo, se deja la que tenia
        } else {
            $pro_archivo = $mi_id->proy_archivo;
        }

        if (!empty($_POST)) {
            $i = 1;

            //dd($op_titulacion);

            if ($op_titulacion == 4) {
                foreach ($_POST as $key => $value) {
                    if (trim($value) != '') {
                        $sqlArr[$key] = "$value";
                    }
                }
                unset($sqlArr['_token']);
                unset($sqlArr['check']);
                unset($sqlArr['presidente']);
                unset($sqlArr['secretario']);
                unset($sqlArr['v_propietario']);
                unset($sqlArr['v_suplente']);
                $usuario = Solicitud::where('n_control', '=', "$usr")->update($sqlArr);
                Solicitud::where('n_control', "$usr")->update(['proy_archivo' => "$sin_archivo"]);
                Solicitud::where('n_control', "$usr")->update(['id_asesor' => 0]);
                Solicitud::where('n_control', "$usr")->update(['n_proyecto' => "$sin_archivo"]);
                if (!empty($_POST['presidente']) and !empty($_POST['secretario']) and !empty($_POST['v_propietario']) and !empty($_POST['v_suplente'])) {
                    $verificar_ex = Sinodal::where('id_solicitud', "$id_miSol->id")->exists();
                    if ($verificar_ex) {
                        Sinodal::where('id_solicitud', "$id_miSol->id")->where('id_tipo', "1")->update(['id_profesor' => $_POST['presidente']]);
                        Sinodal::where('id_solicitud', "$id_miSol->id")->where('id_tipo', "2")->update(['id_profesor' => $_POST['secretario']]);
                        Sinodal::where('id_solicitud', "$id_miSol->id")->where('id_tipo', "3")->update(['id_profesor' => $_POST['v_propietario']]);
                        Sinodal::where('id_solicitud', "$id_miSol->id")->where('id_tipo', "4")->update(['id_profesor' => $_POST['v_suplente']]);
                    } else {
                        $sinodales1 = new Sinodal(array(
                            'id_profesor'  => $_POST['presidente'],
                            'id_solicitud' => $id_miSol->id,
                            'id_estatus'   => 1,
                            'comentario'   => $sin_archivo,
                            'id_tipo'      => 1
                        ));
                        $sinodales2 = new Sinodal(array(
                            'id_profesor'  => $_POST['secretario'],
                            'id_solicitud' => $id_miSol->id,
                            'id_estatus'   => 1,
                            'comentario'   => $sin_archivo,
                            'id_tipo'      => 2,
                        ));
                        $sinodales3 = new Sinodal(array(
                            'id_profesor'  => $_POST['v_propietario'],
                            'id_solicitud' => $id_miSol->id,
                            'id_estatus'   => 1,
                            'comentario'   => $sin_archivo,
                            'id_tipo'      => 3,
                        ));
                        $sinodales4 = new Sinodal(array(
                            'id_profesor'   => $_POST['v_suplente'],
                            'id_solicitud' => $id_miSol->id,
                            'id_estatus'   =>  1,
                            'comentario'   => $sin_archivo,
                            'id_tipo'      => 4,
                        ));
                        $sinodales1->save();
                        $sinodales2->save();
                        $sinodales3->save();
                        $sinodales4->save();
                    }
                }
            } else {

                $id_presidente = Sinodal::where('id_solicitud', "$id_miSol->id")->where('id_tipo', "1")->first('id');
                $id_secretario = Sinodal::where('id_solicitud', "$id_miSol->id")->where('id_tipo', "2")->first('id');
                $id_vocal1 = Sinodal::where('id_solicitud', "$id_miSol->id")->where('id_tipo', "3")->first('id');
                $id_vocal2 = Sinodal::where('id_solicitud', "$id_miSol->id")->where('id_tipo', "4")->first('id');

                if (!empty($id_presidente) and !empty($id_secretario) and !empty($id_vocal1) and empty($id_vocal2)) {
                    Sinodal::where('id', "$id_presidente->id")->delete();
                    Sinodal::where('id', "$id_secretario->id")->delete();
                    Sinodal::where('id', "$id_vocal1->id")->delete();
                    Sinodal::where('id', "$id_vocal2->id")->delete();
                }


                foreach ($_POST as $key => $value) {
                    if (trim($value) != '') {
                        $sqlArr[$key] = "$value";
                    }
                }
                unset($sqlArr['_token']);
                unset($sqlArr['check']);
                unset($sqlArr['presidente']);
                unset($sqlArr['secretario']);
                unset($sqlArr['v_propietario']);
                unset($sqlArr['v_suplente']);
                $usuario = Solicitud::where('n_control', '=', "$usr")->update($sqlArr);
                Solicitud::where('n_control', "$usr")->update(['proy_archivo' => "$pro_archivo"]);
            }
            // almacenando en bistacora
            //obtenemos el id generado de la solicitud
            $id_gen = $id_miSol->id;
            $descripcion = "Se actualizo la solicitud";
            $s_estatus = 1;
            $fecha_actual = Carbon::now();
            $this->registrar_bitacora($usr, $id_gen, $s_estatus, $descripcion, $fecha_actual);
            Session::flash('message', 'Solicitud Actualizada');
        }

        $mensajes_rec = $this->verificar_mensajes();
        return view('alumnos.index', compact('mensajes_rec'));
    }


    public function estatus()
    {
        //* SE ACTUALIZO
        $usr     = auth()->user()->username;
        $id_s    = Solicitud::where('n_control', "$usr")->first('id');
        $estatus = array();
        $ceremonia = array();
        $sinodales = array();
        $verificar_s = Solicitud::where('n_control', "$usr")->get();

        //dd($verificar_s);
        if (count($verificar_s) > 0) {
            $estatus = DB::table('bitacora')->select('bitacora.id_solicitud', 'bitacora.id_estatus', 'bitacora.descripcion', 'bitacora.created_at', 'estatus.nombre')
                ->join('estatus', 'bitacora.id_estatus', '=', 'estatus.id')
                ->where('bitacora.id_solicitud', "$id_s->id")->latest()->get();

            //$ceremonia = DB::table("ceremonias")->where('id_solicitud',"$id_s->id")->get();
            $ceremonia = DB::table('ceremonias')->select('ceremonias.nombre', 'ceremonias.descripcion', 'ceremonias.fecha', 'ceremonias.hora', 'sala_eventos.nombre')
                ->join('sala_eventos', 'sala_eventos.id', '=', 'ceremonias.id_sala')
                ->where('ceremonias.id_solicitud', "$id_s->id")->get();
            $sinodales = DB::table('sinodales')->select('sinodales.id_tipo', 'profesores.p_nombre', 'profesores.s_nombre', 'profesores.a_paterno', 'profesores.a_materno')
                ->join('profesores', 'profesores.id', '=', 'sinodales.id_profesor')
                ->where('sinodales.id_solicitud', "$id_s->id")->get();
        }
        $mensajes_rec = $this->verificar_mensajes();

       //dd($estatus);
        return view('alumnos.estatus', compact('estatus', 'ceremonia', 'sinodales', 'mensajes_rec'));
    }

    public function confirmarS(Request $request)
    {
        //* SE ACTUALIZO
        $usr      = auth()->user()->username;
        $confirma = $request->input('confirm_sol');
        if ($confirma == 'SI') {
            $actualiza = Solicitud::where('n_control', "$usr")->update(['s_estatus' => 2]);

            // almacenando en bistacora
            //obtenemos el id generado de la solicitud
            $solic = Solicitud::where('n_control', "$usr")->get();
            foreach ($solic as $sol) { }
            $id_gen = $sol->id;
            $descripcion = "Se envio la solicitud";
            $s_estatus = 2;
            $fecha_actual = Carbon::now();
            $this->registrar_bitacora($usr, $id_gen, $s_estatus, $descripcion, $fecha_actual);

            Session::flash('message', 'Solicitud Enviada con exito');
        }
        $mensajes_rec = $this->verificar_mensajes();
        return view('alumnos.index', compact('mensajes_rec'));
    }

    public function eliminar()
    {
        //* SE ACTUALIZO
        $usr     = auth()->user()->username;
        $estatus = Solicitud::where('n_control', "$usr")->get();
        $mensajes_rec = $this->verificar_mensajes();
        return view('alumnos.eliminar', compact('estatus', 'mensajes_rec'));
    }

    public function eliminarS()
    {
        //* SE ACTUALIZO
        $usr     = auth()->user()->username;
        $estatus = Solicitud::where('n_control', "$usr")->get();
        $mensajes_rec = $this->verificar_mensajes();

        if (Solicitud::where('n_control', "$usr")->where('s_estatus', "1")->exists()) {
            Solicitud::where('n_control', "$usr")->delete();
            // almacenando en bistacora
            //obtenemos el id generado de la solicitud
            $id_gen = auth()->user()->username;
            $descripcion = "Se elimino la solicitud";
            $s_estatus = 1;
            $fecha_actual = Carbon::now();
            $this->registrar_bitacora($usr, $id_gen, $s_estatus, $descripcion, $fecha_actual);

            Session::flash('message', 'Solicitud Eliminada');
            return view('alumnos.index', compact('mensajes_rec'));
        } else {
            Session::flash('message', 'No se puede eliminar solicitud ya que no Existe o fue enviada');
            return view('alumnos.eliminar', compact('estatus', 'mensajes_rec'));
        }
    }

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

    private function verificar_mensajes()
    {
        $usr     = auth()->user()->username;
        //$mi_id = Solicitud::where('n_control',"$usr")->first('id');
        $mensajes = DB::table('chat_proyecto')->select('chat_proyecto.usuario_envio', 'chat_proyecto.mensaje', 'chat_proyecto.receptor', 'chat_proyecto.fecha', 'chat_proyecto.estatus', 'chat_proyecto.estatus', 'profesores.p_nombre')
            ->join('revisores', 'chat_proyecto.id_revisor', '=', 'revisores.id')
            ->join('profesores', 'revisores.id_profesor', '=', 'profesores.id')
            ->where('chat_proyecto.receptor', "$usr")
            ->where('chat_proyecto.estatus', "1")
            ->orderBy('chat_proyecto.fecha', 'DESC')
            ->get();
        //$mensajes = DB::table('chat_proyecto')->where('receptor',"$usr")->where('estatus',"1")->get();
        return $mensajes;
    }

    public function actualizar_mensajes(Request $request)
    {
        $usr     = auth()->user()->username;
        $usuario_envio = $request->input('usuario_envio');
        $estatus = 2;
        $mensajes = DB::table('chat_proyecto')->where('receptor', "$usr")->where('id_revisor', "$usuario_envio")->update(['estatus' => $estatus]);

        return "exito";
    }

    private function registra_archivo($solicitud, $nombre, $ruta, $usuario, $referencia)
    {
        $fecha = Carbon::now();
        DB::table('documentos_adjuntos')->insert(['id_solicitud' => $solicitud, 'documento' => $nombre, 'ruta' => $ruta, 'usuario_subio' => $usuario, 'referencia' => $referencia, 'created_at' => $fecha, 'updated_at' => $fecha]);
        return "exito";
    }

    private function actualizar_archivo($id, $nombre, $ruta)
    {
        $fecha = Carbon::now();
        DB::table('documentos_adjuntos')->where('id', "$id")->update(['documento' => $nombre, 'ruta' => $ruta, 'updated_at' => $fecha]);
        return "exito";
    }

    private function verifica_dup_sinodal($pr1, $pr2, $pr3, $pr4)
    {

        $bandera = false;
        if ($pr1 == $pr2 or $pr1 == $pr3 or $pr1 == $pr4) {
            $bandera = true;
        }
        if ($pr2 == $pr1 or $pr2 == $pr3 or $pr2 == $pr4) {
            $bandera = true;
        }
        if ($pr3 == $pr2 or $pr3 == $pr1 or $pr3 == $pr4) {
            $bandera = true;
        }

        if ($pr4 == $pr2 or $pr4 == $pr3 or $pr4 == $pr1) {
            $bandera = true;
        }

        return $bandera;
    }
}
