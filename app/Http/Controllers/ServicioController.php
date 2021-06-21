<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Session;
use DB;
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
use Illuminate\Support\Collection;


class ServicioController extends Controller
{
    public function obtener()
    {
        //$alumno = \DB::table('solicitudes')->get();
        $alumno    = Solicitud::where('s_estatus', '!=', '2')->get();
        $nuevas    = Solicitud::where('s_estatus', '2')->count();
        $aceptado  = Solicitud::where('s_estatus', '12')->count();
        $revision  = Solicitud::where('s_estatus', '3')->count();
        $rechazado = Solicitud::where('s_estatus', '9')->count();
        $recibidos_ind = $this->retorna_mensajes();
        $resumen = $this->obtener_resumen();
        //dd($recibidos_ind);
        return view('servicio.index', compact('alumno', 'nuevas', 'aceptado', 'revision', 'rechazado', 'recibidos_ind', 'resumen'));
    }

    public function ceremonias(Request $request)
    {

        $ceremonias   = DB::table('ceremonias')->get();
        $alumnos      = Solicitud::all();
        $salas        = DB::table('sala_eventos')->get();
        $recibidos_ind = $this->retorna_mensajes();
        //dd($salas); 

        return view('servicio.ceremonias', compact('ceremonias', 'alumnos', 'salas', 'recibidos_ind'));
    }

    private function obtener_resumen()
    {


        $solicitudes    = Solicitud::where('s_estatus', '=', '2')->where('id_optitulacion', '!=', '4')->count();
        $nuevas         = Solicitud::where('s_estatus', '2')->count();
        $aceptado       = Solicitud::where('s_estatus', '11')->orwhere('s_estatus', '11')->orwhere('s_estatus', '14')->count();
        $revision       = Solicitud::where('s_estatus', '7')->count();
        $rechazado      = Solicitud::where('s_estatus', '12')->count();

        $resumen = array('solicitudes' => "$solicitudes", 'nuevas' => "$nuevas", 'aceptados' => "$aceptado", 'revision' => "$revision", 'rechazado' => "$rechazado");

        return $resumen;
    }

    public function obtener_oficio($id){

        $datos= DB::table('oficios_campos')->where('id_tipo_oficio',"$id")->orderBy('orden', 'ASC')->get();

        echo   json_encode($datos);
    }

    public function obtener_solicitudes()
    {
        $planes     = Plan::all();
        $titulacion = Optitulacion::all();
        $alumno     = Solicitud::where('s_estatus', '!=', '1')->where('s_estatus', '!=', '4')->where('s_estatus', '!=', '8')->orderBy('created_at', 'DESC')->get();
        $estatus    = Estatus::all();
        $revisores  = Revisor::all();
        $sinodales  = Sinodal::all();
        $profesores = Profesor::all();
        $carreras   = Carrera::all();
        $oficios    = DB::table('oficios_solicitud')->get();
        $documentos = DB::table('documentos_adjuntos')->get();
        $tipo_oficio = DB::table('oficios')->get();
        $estatus2   = DB::table('estatus_revisor_sinodal')->get();
        $recibidos_ind = $this->retorna_mensajes();

        return view('servicio.solicitudes', compact('alumno', 'planes', 'estatus2', 'titulacion', 'estatus', 'profesores', 'revisores', 'sinodales', 'carreras', 'recibidos_ind', 'oficios', 'tipo_oficio', 'documentos'));
    }

    public function detalle_solicitud($id)
    {
        $usr             = auth()->user()->id;
        $solicitud       = Solicitud::where('id', "$id")->get();
        $planes          = Plan::all();
        $op_titulaciones = Optitulacion::all();
        $profesores      = Profesor::all();
        $revisores       = Revisor::where('id_solicitud', $id)->get();
        $sinodales       = Sinodal::where('id_solicitud', $id)->get();
        $carreras        = Carrera::all();
        $estatus2   = DB::table('estatus_revisor_sinodal')->get();
        $oficios    = DB::table('oficios_solicitud')->where('id_solicitud', "$id")->get();
        $documentos = DB::table('documentos_adjuntos')->where('id_solicitud', "$id")->get();
        $tipo_oficio = DB::table('oficios')->get();


        foreach ($solicitud as $sol) {
            $estado = $sol->s_estatus;
            //$tipo_s = $sol->id_optitulacion;
        }
        $tipo_s = $sol->id_optitulacion;
        /*if($estado==2 and $tipo_s !=4){
            Solicitud::where('id', '=', "$id")->update(['s_estatus'=>3]);
            $usuario = auth()->user()->username;
            $descripcion= "En revision Docencia";
            $fecha_actual= Carbon::now();
            $this->registrar_bitacora($usuario,$id,'3',$descripcion,$fecha_actual);
        }*/
        //dd("hola1",$tipo_s);

        /*if($estado==3 and $tipo_s !=4){
            Solicitud::where('id', '=', "$id")->update(['s_estatus'=>6]);
            $usuario = auth()->user()->username;
            $descripcion= "Asignacion de revisores";
            $fecha_actual= Carbon::now();
            $this->registrar_bitacora($usuario,$id,'6',$descripcion,$fecha_actual);
        }*/
        //dd("hola2",$tipo_s);

        /*
        if($estado==11 and $tipo_s !=4){
            Solicitud::where('id', '=', "$id")->update(['s_estatus'=>14]);
            $usuario = auth()->user()->username;
            $descripcion= "Liberacion de proyecto";
            $fecha_actual= Carbon::now();
            $this->registrar_bitacora($usuario,$id,'14',$descripcion,$fecha_actual);
        }
        */

        //dd("hola3",$tipo_s);
        $profesores = Profesor::all();
        $revisores  = Revisor::all();

        $solicitud = Solicitud::where('id', "$id")->get();
        $recibidos_ind = $this->retorna_mensajes();
        return view('servicio.detalles', compact('solicitud', 'carreras', 'planes', 'op_titulaciones', 'profesores', 'revisores', 'sinodales', 'recibidos_ind', 'oficios', 'documentos', 'tipo_oficio', 'estatus2'));
    }

    public function obtener_revisores()
    {

        $alumno     = Solicitud::all();
        $revisores  = Revisor::all();
        $profesores = Profesor::all();
        $estatus    = DB::table('estatus_revisor_sinodal')->get();
        $recibidos_ind = $this->retorna_mensajes();
        return view('servicio.solicitudes_revisores', compact('alumno', 'revisores', 'profesores', 'estatus', 'recibidos_ind'));
    }

    public function obtener_sinodales()
    {
        $alumno     = Solicitud::all();
        $sinodales  = Sinodal::all();
        $profesores = Profesor::all();
        $estatus    = DB::table('estatus_revisor_sinodal')->get();
        $recibidos_ind = $this->retorna_mensajes();
        return view('servicio.solicitudes_sinodales', compact('alumno', 'sinodales', 'profesores', 'estatus', 'recibidos_ind'));
    }



    public function obtener_profesores()
    {
        $plan       = Plan::all();
        $titulacion = Optitulacion::all();
        $profesores = Profesor::all();
        $recibidos_ind = $this->retorna_mensajes();
        return view('servicio.profesores', compact('profesores', 'plan', 'titulacion', 'recibidos_ind'));
    }

    public function actualizar_profesores(Request $request)
    {
        $usuario  = $request->input('username');
        $p_nombre = $request->input('p_nombre');
        $rfc      = $request->input('rfc');
        $correo   = $request->input('correo');
        $password = $request->input('password');
        $date = Carbon::now();
        if (!empty($_POST) and !empty($usuario)) {
            $i = 1;
            foreach ($_POST as $key => $value) {
                if (trim($value) != '') {
                    $sqlArr[$key] = "$value";
                }
            }
            unset($sqlArr['_token']);
            unset($sqlArr['username']);
            unset($sqlArr['password']);

            $profesor = DB::table('profesores')->where('rfc', '=', "$usuario")->update($sqlArr);
            $fech_act = DB::table('profesores')->where('rfc', '=', "$usuario")->update(['updated_at' => $date]);
            if (!empty($p_nombre)) {
                DB::table('users')->where('username', '=', "$usuario")->update(['name' => $p_nombre]);
                $fech_act = DB::table('profesores')->where('rfc', '=', "$usuario")->update(['updated_at' => $date]);
            }
            if (!empty($rfc)) {
                $user = DB::table('users')->where('username', '=', "$usuario")->update(['email' => $correo]);
                $fech_act = DB::table('users')->where('username', '=', "$usuario")->update(['updated_at' => $date]);
            }
            if (!empty($correo)) {
                $user = DB::table('users')->where('username', '=', "$usuario")->update(['username' => $rfc,]);
                $fech_act = DB::table('users')->where('username', '=', "$usuario")->update(['updated_at' => $date]);
            }
            if (!empty($password)) {
                $user = DB::table('users')->where('username', '=', "$usuario")->update(['password' => Hash::make($password)]);
                $fech_act = DB::table('users')->where('username', '=', "$usuario")->update(['updated_at' => $date]);
            }

            Session::flash('message', 'Profesor Actualizado');
            $alumno = \DB::table('solicitudes')->get();
            $recibidos_ind = $this->retorna_mensajes();
            $resumen = $this->obtener_resumen();
            return view('servicio.index', compact('alumno', 'recibidos_ind', 'resumen'));
        }
    }

    public function agregar_profesores(Request $request)
    {
        $p_nombre = $request->input('p_nombre');
        $s_nombre = $request->input('s_nombre');
        $paterno  = $request->input('a_paterno');
        $materno  = $request->input('a_materno');
        $rfc      = $request->input('rfc');
        $correo   = $request->input('correo');
        $celular  = $request->input('celular');
        $departamento = $request->input('departamento');
        $password     = $request->input('password');
        $estatus      = $request->input('estatus');
        $date         = Carbon::now();
        $obtener_usuario  = \DB::table('profesores')->where('rfc', '=', "$rfc")->count();
        $obtener_registro = \DB::table('users')->where('username', '=', "$rfc")->count();
        if ($obtener_usuario > 0 or $obtener_registro > 0) {
            Session::flash('message', 'Este profesor ya existe favor de verificar datos');
        } else {
            $user = User::create([
                'name' => $p_nombre,
                'username' => $rfc,
                'estatus' => $estatus,
                'email' => $correo,
                'password' => Hash::make($password),
            ]);
            $user->roles()->attach(Role::where('name', 'profesor')->first());
            $profe = DB::table('profesores')->insertGetId(['p_nombre' => "{$p_nombre}", 's_nombre' => "{$s_nombre}", 'a_paterno' => "{$paterno}", 'a_materno' => "{$materno}", 'rfc' => "{$rfc}",  'celular' => "{$celular}", 'correo' => "{$correo}",  'departamento' => "{$departamento}", 'estatus' => "{$estatus}", 'created_at' => "{$date}", 'updated_at' => "{$date}"]);
            Session::flash('message', 'Profesor Agregado');
        }

        $alumno    = Solicitud::where('s_estatus', '!=', '2')->get();
        $nuevas    = Solicitud::where('s_estatus', '2')->count();
        $aceptado  = Solicitud::where('s_estatus', '12')->count();
        $revision  = Solicitud::where('s_estatus', '3')->count();
        $rechazado = Solicitud::where('s_estatus', '9')->count();
        $recibidos_ind = $this->retorna_mensajes();
        $resumen = $this->obtener_resumen();
        return view('servicio.index', compact('alumno', 'nuevas', 'aceptado', 'revision', 'rechazado', 'recibidos_ind', 'resumen'));
    }

    public function obtener_carreras()
    {
        $carreras = Carrera::all();
        $recibidos_ind = $this->retorna_mensajes();
        return view('servicio.carreras', compact('carreras', 'recibidos_ind'));
    }

    public function agregar_carrera(Request $request)
    {
        $nombre  = $request->input('nombre');
        $estatus = $request->input('estatus');
        $date    = Carbon::now();
        $carrera = DB::table('carreras')->insertGetId(['nombre' => "{$nombre}", 'estatus' => "{$estatus}", 'created_at' => "{$date}", 'updated_at' => "{$date}"]);
        Session::flash('message', 'Nueva Carrera agregada');
        $alumno = \DB::table('solicitudes')->get();
        $recibidos_ind = $this->retorna_mensajes();
        return view('servicio.index', compact('alumno', 'recibidos_ind'));
    }

    public function actualizar_carrera(Request $request)
    {
        $id_carrera = $request->input('id_carrera');
        $date = Carbon::now();
        foreach ($_POST as $key => $value) {
            if (trim($value) != '') {
                $sqlArr[$key] = "$value";
            }
        }
        unset($sqlArr['_token']);
        unset($sqlArr['id_carrera']);
        if (!empty($id_carrera and !empty($sqlArr))) {
            $profesor = DB::table('carreras')->where('id', '=', "$id_carrera")->update($sqlArr);
            $fech_act = DB::table('carreras')->where('id', '=', "$id_carrera")->update(['updated_at' => $date]);
            $mensaje  = "Carrera Actualizada";
        } else {
            $mensaje = "ERROR Carrera NO Actualizada";
        }

        Session::flash('message', $mensaje);
        $alumno = \DB::table('solicitudes')->get();
        $recibidos_ind = $this->retorna_mensajes();
        $resumen = $this->obtener_resumen();
        return view('servicio.index', compact('alumno', 'recibidos_ind', 'resumen'));
    }

    //Planes/////////////////////

    public function obtener_planes()
    {
        $planes = Plan::all();
        $recibidos_ind = $this->retorna_mensajes();
        return view('servicio.planes', compact('planes', 'recibidos_ind'));
    }

    public function agregar_planes(Request $request)
    {
        $nombre = $request->input('nombre');
        $year   = $request->input('anio');
        $date   = Carbon::now();
        $plan   = DB::table('planes')->insertGetId(['nombre' => "{$nombre}", 'anio' => "{$year}", 'created_at' => "{$date}", 'updated_at' => "{$date}"]);
        Session::flash('message', 'Nuevo plan agregado');
        $alumno = \DB::table('solicitudes')->get();
        $recibidos_ind = $this->retorna_mensajes();
        $resumen = $this->obtener_resumen();
        return view('servicio.index', compact('alumno', 'recibidos_ind', 'resumen'));
    }

    public function actualizar_planes(Request $request)
    {
        $id_plan = $request->input('id_plan');
        $date = Carbon::now();
        foreach ($_POST as $key => $value) {
            if (trim($value) != '') {
                $sqlArr[$key] = "$value";
            }
        }
        unset($sqlArr['_token']);
        unset($sqlArr['id_plan']);
        if (!empty($id_plan) and !empty($sqlArr)) {
            $profesor = DB::table('planes')->where('id', '=', "$id_plan")->update($sqlArr);
            $fech_act = DB::table('planes')->where('id', '=', "$id_plan")->update(['updated_at' => $date]);
            $mensaje = "Plan Actualizado";
        } else {
            $mensaje = "ERROR Plan NO Actualizado";
        }

        Session::flash('message', $mensaje);
        $alumno = \DB::table('solicitudes')->get();
        $recibidos_ind = $this->retorna_mensajes();
        $resumen = $this->obtener_resumen();
        return view('servicio.index', compact('alumno', 'recibidos_ind', 'resumen'));
    }

    public function agregar_usuario_rol(Request $request)
    {
        $nombre   = $request->input('name');
        $username = $request->input('username');
        $email    = $request->input('email');
        $password = $request->input('password');
        $estatus  = $request->input('estatus');
        $rol      = $request->input('rol');
        $verificar_usuario = User::where('username', '=', $username)->first();
        if (empty($verificar_usuario)) {
            $usuario = new User;
            $usuario->name = $nombre;
            $usuario->username = $username;
            $usuario->estatus = $estatus;
            $usuario->email = $email;
            $usuario->password = Hash::make($password);
            $usuario->save();
            $obtener_id_user = $usuario->id;
            $fecha   = Carbon::now();
            $new_rol = \DB::table('role_user')->insert(['role_id' => $rol, 'user_id' => $obtener_id_user, 'created_at' => $fecha, 'updated_at' => $fecha]);
            Session::flash('message', 'Usuario registrado con Exito!');
            $alumno = \DB::table('solicitudes')->get();
            $recibidos_ind = $this->retorna_mensajes();
            $resumen = $this->obtener_resumen();
            return view('servicio.index', compact('alumno', 'recibidos_ind', 'resumen'));
        } else {
            Session::flash('message', 'Este usuario ya existe favor de verificar');
            $alumno = \DB::table('solicitudes')->get();
            $recibidos_ind = $this->retorna_mensajes();
            $resumen = $this->obtener_resumen();
            return view('servicio.index', compact('alumno', 'recibidos_ind', 'resumen'));
        }
    }

    public function actualizar_usuario_rol(Request $request)
    {
        $nombre = $request->input('name');
        $user   = $request->input('user');
        $username = $request->input('username');
        $id_usr   = $request->input('id_usr');
        $email    = $request->input('email');
        $password = $request->input('password');
        $estatus  = $request->input('estatus');
        $rol = $request->input('rol');
        $verificar_usuario = User::where('username', '=', $user)->first();

        if (!empty($_POST) and !empty($user) and !empty($id_usr)) {
            $i = 1;
            foreach ($_POST as $key => $value) {
                if (trim($value) != '') {
                    $sqlArr[$key] = "$value";
                }
            }
            unset($sqlArr['_token']);
            unset($sqlArr['user']);
            unset($sqlArr['rol']);
            unset($sqlArr['id_usr']);
            unset($sqlArr['password']);
            //dd($sqlArr);
            $n_usuario = DB::table('users')->where('id', $id_usr)->update($sqlArr);

            if (!empty($password)) {
                $n_usuario_pw = DB::table('users')->where('id', '=', "$id_usr")->update(['password' => Hash::make($password)]);
            }

            if (!empty($rol)) {
                $n_rol = DB::table('role_user')->where('user_id', '=', "$id_usr")->update(['role_id' => $rol]);
            }
            //dd($n_usuario);
            Session::flash('message', 'Usuario Actualizado con Exito!');
            $alumno = \DB::table('solicitudes')->get();
            $recibidos_ind = $this->retorna_mensajes();
            $resumen = $this->obtener_resumen();
            return view('servicio.index', compact('alumno', 'recibidos_ind', 'resumen'));
        } else {
            Session::flash('message', 'ERROR al Actualizar verifica datos');
            $alumno = \DB::table('solicitudes')->get();
            $recibidos_ind = $this->retorna_mensajes();
            $resumen = $this->obtener_resumen();
            return view('servicio.index', compact('alumno', 'recibidos_ind', 'resumen'));
        }
    }


    public function eliminar_usuario_rol($id)
    {
        DB::table('users')->where('id', '=', $id)->delete();
        DB::table('role_user')->where('user_id', '=', $id)->delete();

        Session::flash('message', 'Usuario Eliminado con Exito!');
        $alumno = \DB::table('solicitudes')->get();
        $recibidos_ind = $this->retorna_mensajes();
        $resumen = $this->obtener_resumen();
        return view('servicio.index', compact('alumno', 'recibidos_ind', 'resumen'));
    }

    public function actualizar_solicitud(Request $request)
    {


        $usuario         = $request->input('solicitud');
        $p_rev           = $request->input('p_r');
        $s_rev           = $request->input('s_r');
        $t_rev           = $request->input('t_r');
        $primer_revisor  = $request->input('primer_revisor');
        $segundo_revisor = $request->input('segundo_revisor');
        $tercer_revisor  = $request->input('tercer_revisor');
        $cambio_estado   = $request->input('cambio_estado_proyecto');
        $impresion_definitiva  = $request->input('impresion_definitiva');
        $concluye_tramite      = $request->input('concluye_tramite');
        $alumno_titulado       = $request->input('alumno_titulado');
        $oficio_titulado       = $request->file('oficio_titulado');
        $oficio_ceremonia      = $request->input('oficio_ceremonia');
        $oficio_sol_sinodales  = $request->file('oficio_sol_sinodales');
        $oficio_sol_sinodales2 = $request->file('oficio_sol_sinodales2');

        $of_lib_pro = $request->file('oficio_liberacion_proyecto');

        $of_auto_op_ti = $request->file('oficio_autorizacion_op_titulacion');
        $of_regi_pro   = $request->file('oficio_registro_proyecto');
        $of_asi_rev    = $request->file('oficio_asigacion_revisores');
        $of_aut_pro    = $request->file('oficio_autorizacion_proyecto');
        $of_imp_def    = $request->file('oficio_impresion_definitiva');


        //$cuart_revisor=$request->input('cuarto_revisor');
        $presidente = $request->input('presidente');
        $secretario = $request->input('secretario');
        $vocal      = $request->input('v_propietario');
        $vocal_suplente = $request->input('v_suplente');
        $estatus = 6;
        $estatus_solicitud = 2;
        $comentario = "";
        $date = Carbon::now();
        $solicitud  = Solicitud::where('id', "$usuario")->get();

        if (!empty($of_auto_op_ti)) {
            $tip_of = 1;

            //Adjuntar oficio
            if ($request->hasFile('oficio_autorizacion_op_titulacion')) {
                //indicamos que queremos guardar un nuevo archivo en el disco local
                $file = $request->file('oficio_autorizacion_op_titulacion')->store('public');
                //dd($_FILES);
                $of_archivo_name = str_replace("public/", "", $file);
                $this->adjuntar_oficio($of_archivo_name, $tip_of, $usuario);
            }
            $this->cambio_estado_solicitud($usuario, 3);
            Session::flash('message', 'El documento se adjunto a la solicitud');

            //Registro en bitacora
            $usr = auth()->user()->username;
            $descripcion = "En revision Docencia/Se autoriza la opcion de titulacion";
            $fecha_actual = Carbon::now();
            $this->registrar_bitacora($usr, $usuario, 3, $descripcion, $fecha_actual);
        }

        // para los que no son Ceneval
        if (!empty($oficio_sol_sinodales2)) {

            $duplicados = $this->verifica_dup_sinodal($presidente, $secretario, $vocal, $vocal_suplente);

            if ($duplicados == true) {
                Session::flash('message', 'Propuesta de sinodales duplicados, Verificar');
            } else {
                //Adjuntar of
                $tip_of = 8;
                //Adjuntar oficio
                $mi_oficio2 = db::table('oficios_solicitud')->where('id_tipo_oficio', "8")->where('id_solicitud', "$usuario")->first('url');
                if (!empty($mi_oficio2)) {
                    if ($request->hasFile('oficio_sol_sinodales2')) {
                        //indicamos que queremos guardar un nuevo archivo en el disco local
                        if (Storage::exists('public/' . $mi_oficio2->url)) {
                            Storage::delete('public/' . $mi_oficio2->url);
                        }
                        $file = $request->file('oficio_sol_sinodales2')->store('public');
                        //dd($_FILES);
                        $of_archivo_name = str_replace("public/", "", $file);

                        DB::table('oficios_solicitud')->where('id_solicitud', $usuario)->where('id_tipo_oficio', "8")->update(['url' => $of_archivo_name, 'updated_at' => $date]);
                    }
                } else {
                    if ($request->hasFile('oficio_sol_sinodales2')) {
                        //indicamos que queremos guardar un nuevo archivo en el disco local
                        $file = $request->file('oficio_sol_sinodales2')->store('public');
                        //dd($_FILES);
                        $of_archivo_name = str_replace("public/", "", $file);
                        $this->adjuntar_oficio($of_archivo_name, $tip_of, $usuario);
                    }
                }
            }
        }

        // para los que  son Ceneval
        if (!empty($oficio_sol_sinodales)) {

            $duplicados = $this->verifica_dup_sinodal($presidente, $secretario, $vocal, $vocal_suplente);

            if ($duplicados == true) {
                Session::flash('message', 'Propuesta de sinodales duplicados, Verificar');
            } else {
                $tip_of = 8;
                //actualizar oficio
                $mi_oficio = db::table('oficios_solicitud')->where('id_tipo_oficio', "8")->where('id_solicitud', "$usuario")->first('url');
                if (!empty($mi_oficio)) {

                    if ($request->hasFile('oficio_sol_sinodales')) {
                        $mi_oficio = db::table('oficios_solicitud')->where('id_tipo_oficio', "8")->where('id_solicitud', "$usuario")->first('url');
                        if (Storage::exists('public/' . $mi_oficio->url)) {
                            Storage::delete('public/' . $mi_oficio->url);
                        }
                        //indicamos que queremos guardar un nuevo archivo en el disco local
                        $file = $request->file('oficio_sol_sinodales')->store('public');
                        //dd($_FILES);
                        $of_archivo_name = str_replace("public/", "", $file);
                        DB::table('oficios_solicitud')->where('id_solicitud', $usuario)->where('id_tipo_oficio', "8")->update(['url' => $of_archivo_name, 'updated_at' => $date]);
                    }
                } else {
                    if ($request->hasFile('oficio_sol_sinodales')) {
                        //indicamos que queremos guardar un nuevo archivo en el disco local
                        $file = $request->file('oficio_sol_sinodales')->store('public');
                        //dd($_FILES);
                        $of_archivo_name = str_replace("public/", "", $file);
                        $this->adjuntar_oficio($of_archivo_name, $tip_of, $usuario);
                    }
                }
            }
        }


        /*
        // para los que no son Ceneval sinodal
        if(!empty($of_asi_rev)){
            //Adjuntar of
            $tip_of = 3;
            //Falta verificar cuando se actualiza
            $this->adjuntar_oficio($of_asi_rev,$tip_of,$usuario);

        }
        */

        if (!empty($of_regi_pro)) {
            $tip_of = 2;
            //Adjuntar oficio
            if ($request->hasFile('oficio_registro_proyecto')) {
                //indicamos que queremos guardar un nuevo archivo en el disco local
                $file = $request->file('oficio_registro_proyecto')->store('public');
                //dd($_FILES);
                $of_archivo_name = str_replace("public/", "", $file);
                $this->adjuntar_oficio($of_archivo_name, $tip_of, $usuario);
            }
            $this->cambio_estado_solicitud($usuario, 6);
            Session::flash('message', 'El documento se adjunto a la solicitud');

            //Registro en bitacora
            $usr = auth()->user()->username;
            $descripcion = "En proceso de asignacion de revisores /Docencia";
            $fecha_actual = Carbon::now();
            $this->registrar_bitacora($usr, $usuario, 6, $descripcion, $fecha_actual);
        }

        if (!empty($of_aut_pro)) {
            $tip_of = 5;
            if ($request->hasFile('oficio_autorizacion_proyecto')) {
                //indicamos que queremos guardar un nuevo archivo en el disco local
                $file = $request->file('oficio_autorizacion_proyecto')->store('public');
                //dd($_FILES);
                $of_archivo_name = str_replace("public/", "", $file);
                $this->adjuntar_oficio($of_archivo_name, $tip_of, $usuario);
            }
            $this->cambio_estado_solicitud($usuario, 14);
            Session::flash('message', 'El documento se adjunto a la solicitud');

            //Registro en bitacora
            $usr = auth()->user()->username;
            $descripcion = "En proceso de liberacion de proyecto";
            $fecha_actual = Carbon::now();
            $this->registrar_bitacora($usr, $usuario, 14, $descripcion, $fecha_actual);
        }

        if (!empty($concluye_tramite)) {
            $this->cambio_estado_solicitud($usuario, 13);

            //Registro en bitacora
            $usr = auth()->user()->username;
            $descripcion = "El tramite de titulacion concluido ";
            $fecha_actual = Carbon::now();
            $this->registrar_bitacora($usr, $usuario, 13, $descripcion, $fecha_actual);
        }

        // para cuando es diferente a CENEVAL
        if (!empty($of_imp_def)) {
            $tip_of = 10;
            if ($request->hasFile('oficio_impresion_definitiva')) {
                //indicamos que queremos guardar un nuevo archivo en el disco local
                $file = $request->file('oficio_impresion_definitiva')->store('public');
                //dd($_FILES);
                $of_archivo_name = str_replace("public/", "", $file);
                $this->adjuntar_oficio($of_archivo_name, $tip_of, $usuario);
            }
            $this->cambio_estado_solicitud($usuario, 8);
            Session::flash('message', 'Enviado a Cordinacion de titulaciones para asigancion de ceremonia');

            //Registro en bitacora
            $usr = auth()->user()->username;
            $descripcion = "En proceso de Asignacion de ceremonia";
            $fecha_actual = Carbon::now();
            $this->registrar_bitacora($usr, $usuario, 8, $descripcion, $fecha_actual);
        }

        if (!empty($oficio_ceremonia)) {
            $this->cambio_estado_solicitud($usuario, 8);
            Session::flash('message', 'Enviado a Cordinacion de titulaciones para asigancion de ceremonia');

            //Registro en bitacora
            $usr = auth()->user()->username;
            $descripcion = "En proceso de Asignacion de seremonia";
            $fecha_actual = Carbon::now();
            $this->registrar_bitacora($usr, $usuario, 8, $descripcion, $fecha_actual);
        }

        //liberacion de proyecto estatus=14 tipo=1,2,3,5
        if (!empty($of_lib_pro)) {
            $tip_of = 6;
            if ($request->hasFile('oficio_liberacion_proyecto')) {
                //indicamos que queremos guardar un nuevo archivo en el disco local
                $file = $request->file('oficio_liberacion_proyecto')->store('public');
                //dd($_FILES);
                $of_archivo_name = str_replace("public/", "", $file);
                $this->adjuntar_oficio($of_archivo_name, $tip_of, $usuario);
            }
            $this->cambio_estado_solicitud($usuario, 4);
            Session::flash('message', '');

            //Registro en bitacora
            $usr = auth()->user()->username;
            $descripcion = "En revision Coordinacion ";
            $fecha_actual = Carbon::now();
            $this->registrar_bitacora($usr, $usuario, 4, $descripcion, $fecha_actual);
        }

        if (!empty($alumno_titulado)) {
            $tipo_oficio = 12;

            if ($request->hasFile('oficio_titulado')) {
                //indicamos que queremos guardar un nuevo archivo en el disco local
                $file = $request->file('oficio_titulado')->store('public');
                //dd($_FILES);
                $of_archivo_name = str_replace("public/", "", $file);
                $this->adjuntar_oficio($of_archivo_name, $tipo_oficio, $usuario);
                Session::flash('message', 'Alumno registrado como titulado al oficio se adjunto al axpediente');
            }

            $this->cambio_estado_solicitud($usuario, 10);

            //Registro en bitacora
            $usr = auth()->user()->username;
            $descripcion = "En proceso de registro alumno titulado ";
            $fecha_actual = Carbon::now();
            $this->registrar_bitacora($usr, $usuario, 10, $descripcion, $fecha_actual);
        }
        // proceso para el cambio de estado cuando se encuentra en tipo 15
        if (!empty($impresion_definitiva)) {
            $this->cambio_estado_solicitud($usuario, 8);

            //Registro en bitacora
            $usr = auth()->user()->username;
            $descripcion = "En proceso de Asignacion de seremonia";
            $fecha_actual = Carbon::now();
            $this->registrar_bitacora($usr, $usuario, 8, $descripcion, $fecha_actual);

            /*foreach ($solicitud as $sol) {
                $estado= $sol->s_estatus;
                //$tipo_s = $sol->id_optitulacion;
            }
            $tipo_s = $sol->id_optitulacion;
            if($estado==15 and $tipo_s !=4){
                Solicitud::where('id', '=', "$usuario")->update(['s_estatus'=>8]);
            }
            */
        } else {
            // proceso para el cambio de estado cuando se encuentra en tipo 14

            if (!empty($cambio_estado)) {

                $this->cambio_estado_solicitud($usuario, 4);

                //Registro en bitacora
                $usr = auth()->user()->username;
                $descripcion = "En revision Coordinacion ";
                $fecha_actual = Carbon::now();
                $this->registrar_bitacora($usr, $usuario, 4, $descripcion, $fecha_actual);
                /*foreach ($solicitud as $sol) {
                    $estado= $sol->s_estatus;
                    //$tipo_s = $sol->id_optitulacion;
                }
                $tipo_s = $sol->id_optitulacion;
                if($estado==14 and $tipo_s !=4){
                    Solicitud::where('id', '=', "$usuario")->update(['s_estatus'=>4]);
                }
                */
            } else {

                if (!empty($primer_revisor) and !empty($segundo_revisor) and !empty($tercer_revisor)) {

                    $obtener_revisor = Revisor::where('id_solicitud', "$usuario")->exists();
                    if ($obtener_revisor) {
                        Revisor::where('id_solicitud', "$usuario")->where('id_tipo', '1')->update(['id_profesor' => "$primer_revisor", 'id_estatus' => "$estatus_solicitud"]);
                        Revisor::where('id_solicitud', "$usuario")->where('id_tipo', '2')->update(['id_profesor' => "$segundo_revisor", 'id_estatus' => "$estatus_solicitud"]);
                        Revisor::where('id_solicitud', "$usuario")->where('id_tipo', '3')->update(['id_profesor' => "$tercer_revisor", 'id_estatus' => "$estatus_solicitud"]);

                        if ($request->hasFile('oficio_asigacion_revisores')) {
                            $file = $request->file('oficio_asigacion_revisores');
                            //si el archivo existe que sea eliminado antes de registrar otro
                            $mi_oficio = db::table('oficios_solicitud')->where('id_tipo_oficio', "3")->where('id_solicitud', "$usuario")->first('url');
                            if (Storage::exists('public/' . $mi_oficio->url)) {
                                Storage::delete('public/' . $mi_oficio->url);
                            }
                            //indicamos que queremos actualizar un nuevo archivo en el disco local
                            $file = $request->file('oficio_asigacion_revisores')->store('public');
                            $pro_archivo = str_replace("public/", "", $file);
                            DB::table('oficios_solicitud')->where('id_solicitud', $usuario)->where('id_tipo_oficio', 3)->update(['url' => $pro_archivo, 'updated_at' => $date]);
                        }
                    } else {

                        $pr_revisor = new Revisor(array(
                            'id_profesor'  => $primer_revisor,
                            'id_solicitud' => $usuario,
                            'id_estatus'   => 2,
                            'comentario'   => "",
                            'id_tipo'      => 1
                        ));
                        $seg_revisor = new Revisor(array(
                            'id_profesor'  => $segundo_revisor,
                            'id_solicitud' => $usuario,
                            'id_estatus'   => 2,
                            'comentario'   => "",
                            'id_tipo'      => 2
                        ));
                        $tercer_revisor = new Revisor(array(
                            'id_profesor'  => $tercer_revisor,
                            'id_solicitud' => $usuario,
                            'id_estatus'   => 2,
                            'comentario'   => "",
                            'id_tipo'      => 3
                        ));

                        $pr_revisor->save();
                        $seg_revisor->save();
                        $tercer_revisor->save();

                        // Adjuntando oficio
                        $tip_of = 3;
                        if ($request->hasFile('oficio_asigacion_revisores')) {
                            //indicamos que queremos guardar un nuevo archivo en el disco local
                            $file = $request->file('oficio_asigacion_revisores')->store('public');
                            //dd($_FILES);
                            $of_archivo_name = str_replace("public/", "", $file);
                            $this->adjuntar_oficio($of_archivo_name, $tip_of, $usuario);
                        }
                    }

                    //Enviar notificacion a los revisores

                    $emisor   = auth()->user()->username;
                    $correo  = auth()->user()->email;
                    $asunto   = "Asignado para ser revisor";
                    $mensaje  = "Muy buenos dias profesor (a) se le informa que a sido seleccionado para ser revisor de proyecto, favor 
                de aceptar o rechachar en la opcion de revisores. att:Docencia";
                    $revisores = Revisor::select('revisores.id_profesor', 'profesores.correo')
                        ->join('profesores', 'profesores.id', '=', 'revisores.id_profesor')
                        ->where('profesores.estatus', "1")
                        ->get();
                    //dd($revisores);
                    foreach ($revisores as $rev) {
                        if ($rev->id_profesor == $primer_revisor) {
                            $receptor = $rev->correo;
                            $this->notificar($emisor, $correo, $receptor, $asunto, $mensaje);
                        } else {
                            if ($rev->id_profesor == $segundo_revisor) {
                                $receptor2 = $rev->correo;
                                $this->notificar($emisor, $correo, $receptor2, $asunto, $mensaje);
                            } else {
                                if ($rev->id_profesor == $tercer_revisor) {
                                    $receptor3 = $rev->correo;
                                    $this->notificar($emisor, $correo, $receptor3, $asunto, $mensaje);
                                }
                            }
                        }
                    }
                    //dd($primer_revisor);
                    //dd($rev->id);
                    Session::flash('message', 'Asignacion de revisores correcta, se notifico por mensaje a los profesores asignados');
                }

                if (!empty($presidente) and !empty($secretario) and !empty($vocal) and !empty($vocal_suplente)) {

                    $duplicados = $this->verifica_dup_sinodal($presidente, $secretario, $vocal, $vocal_suplente);

                    if ($duplicados == true) {
                        Session::flash('message', 'Propuesta de sinodales duplicados, Verificar');
                    } else {
                        $obtener_sinodal = Sinodal::where('id_solicitud', "$usuario")->exists();
                        if ($obtener_sinodal) {
                            Sinodal::where('id_solicitud', "$usuario")->where('id_tipo', '1')->update(['id_profesor' => "$presidente", 'id_estatus' => "$estatus_solicitud"]);
                            Sinodal::where('id_solicitud', "$usuario")->where('id_tipo', '2')->update(['id_profesor' => "$secretario", 'id_estatus' => "$estatus_solicitud"]);
                            Sinodal::where('id_solicitud', "$usuario")->where('id_tipo', '3')->update(['id_profesor' => "$vocal", 'id_estatus' => "$estatus_solicitud"]);
                            Sinodal::where('id_solicitud', "$usuario")->where('id_tipo', '4')->update(['id_profesor' => "$vocal_suplente", 'id_estatus' => "$estatus_solicitud"]);
                            $name_of = DB::table('oficios_solicitud')->where('id_solicitud', "$usuario")->where('id_tipo_oficio', "8")->first('url');
                        } else {

                            $pr_presidente = new Sinodal(array(
                                'id_profesor'  => $presidente,
                                'id_solicitud' => $usuario,
                                'id_estatus'   => 2,
                                'comentario'   => "",
                                'id_tipo'      => 1
                            ));
                            $seg_secretario = new Sinodal(array(
                                'id_profesor'  => $secretario,
                                'id_solicitud' => $usuario,
                                'id_estatus'   => 2,
                                'comentario'   => "",
                                'id_tipo'      => 2
                            ));
                            $tercer_vocal = new Sinodal(array(
                                'id_profesor'  => $vocal,
                                'id_solicitud' => $usuario,
                                'id_estatus'   => 2,
                                'comentario'   => "",
                                'id_tipo'      => 3
                            ));
                            $cuarto_vocal_supl = new Sinodal(array(
                                'id_profesor'  => $vocal_suplente,
                                'id_solicitud' => $usuario,
                                'id_estatus'   => 2,
                                'comentario'   => "",
                                'id_tipo'      => 4
                            ));

                            $pr_presidente->save();
                            $seg_secretario->save();
                            $tercer_vocal->save();
                            $cuarto_vocal_supl->save();



                            //$this->cambio_estado_solicitud($usuario,15);

                            Session::flash('message', 'Se envio solicitud a coordinacion para asiganacion de seremonia de titulacion ');
                        }

                        if (!empty($oficio_sol_sinodales)) {
                            // Cambio de estado de la solicitud 
                            $this->cambio_estado_solicitud($usuario, 8);
                            Session::flash('message', 'Se envio solicitud a coordinacion para asiganacion de seremonia de titulacion ');

                            //Registro en bitacora
                            $usr = auth()->user()->username;
                            $descripcion = "En proceso de Asignacion de seremonia ";
                            $fecha_actual = Carbon::now();
                            $this->registrar_bitacora($usr, $usuario, 8, $descripcion, $fecha_actual);
                        }
                        if (!empty($oficio_sol_sinodales2)) {
                            //Registro en bitacora
                            $usr = auth()->user()->username;
                            $descripcion = "Se genero oficio de impresion definitiva";
                            $fecha_actual = Carbon::now();
                            $this->registrar_bitacora($usr, $usuario, $usuario, $descripcion, $fecha_actual);

                            $this->cambio_estado_solicitud($usuario, 15);
                            Session::flash('message', 'Se envio solicitud a coordinacion para asiganacion de seremonia de titulacion ');

                            //Registro en bitacora
                            $usr = auth()->user()->username;
                            $descripcion = "En proceso de generacion de impresion definitiva ";
                            $fecha_actual = Carbon::now();
                            $this->registrar_bitacora($usr, $usuario, 15, $descripcion, $fecha_actual);
                        }
                        Session::flash('message', 'Asignacion de Sinodales correcta se dara seguimiento a la solicitud');
                    }
                }
            }
        }

        $alumno = \DB::table('solicitudes')->get();
        $recibidos_ind = $this->retorna_mensajes();
        $resumen = $this->obtener_resumen();

        return view('servicio.index', compact('alumno', 'recibidos_ind', 'resumen'));
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
            return view('servicio.mensajes_inbox', compact('recibidos', 'enviados', 'm_nuevos', 'paginados', 'fecha', 'recibidos_ind'));
        } else {
            if ($name == "borrados") {
                $usr = auth()->user()->email;
                $estatus = 3;
                $recibidos = DB::table('chat_sistema')->where('receptor', "$usr")->where('estatus', "$estatus")->orderBy('fecha', 'DESC')->simplePaginate(15);
                $paginados = DB::table('chat_sistema')->where('receptor', "$usr")->orderBy('fecha', 'DESC')->simplePaginate(15);
                $enviados  = array();
                $m_nuevos  = DB::table('chat_sistema')->where('receptor', "$usr")->where('estatus', "1")->get();
                $recibidos_ind = $this->retorna_mensajes();

                return view('servicio.mensajes_inbox', compact('recibidos', 'enviados', 'm_nuevos', 'paginados', 'recibidos_ind'));
            } else {
                if ($name == "importantes") {
                    $usr = auth()->user()->email;
                    $estatus = 4;
                    $recibidos = DB::table('chat_sistema')->where('receptor', "$usr")->where('estatus', "$estatus")->orderBy('fecha', 'DESC')->simplePaginate(15);
                    $paginados = DB::table('chat_sistema')->where('receptor', "$usr")->orderBy('fecha', 'DESC')->simplePaginate(15);
                    $enviados  = array();
                    $m_nuevos  = DB::table('chat_sistema')->where('receptor', "$usr")->where('estatus', "1")->get();
                    $recibidos_ind = $this->retorna_mensajes();

                    return view('servicio.mensajes_inbox', compact('recibidos', 'enviados', 'm_nuevos', 'paginados', 'recibidos_ind'));
                } else {
                    if ($name == "enviados") {
                        $usr = auth()->user()->email;
                        $estatus = 4;
                        $recibidos = array();
                        $paginados = DB::table('chat_sistema')->where('receptor', "$usr")->orderBy('fecha', 'DESC')->simplePaginate(15);
                        $enviados  = DB::table('chat_sistema')->where('correo', "$usr")->orderBy('fecha', 'DESC')->simplePaginate(15);
                        $m_nuevos  = DB::table('chat_sistema')->where('receptor', "$usr")->where('estatus', "1")->get();
                        $recibidos_ind = $this->retorna_mensajes();


                        return view('servicio.mensajes_inbox_env', compact('recibidos', 'enviados', 'm_nuevos', 'paginados', 'recibidos_ind'));
                    }
                }
            }
        }

        $usr = auth()->user()->email;
        $recibidos = DB::table('chat_sistema')->where('receptor', "$usr")->orderBy('fecha', 'DESC')->Paginate(15);
        $paginados = DB::table('chat_sistema')->where('receptor', "$usr")->orderBy('fecha', 'DESC')->simplePaginate(15);
        $enviados  = array();
        $m_nuevos  = DB::table('chat_sistema')->where('receptor', "$usr")->where('estatus', "1")->get();
        //dd($recibidos);
        $fecha = Carbon::now();
        //Session::flash('message', 'Sin acceso a mensajes');
        $recibidos_ind = $this->retorna_mensajes();
        return view('servicio.mensajes_inbox', compact('recibidos', 'enviados', 'm_nuevos', 'paginados', 'fecha', 'recibidos_ind'));
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

        return view('servicio.mensajes_nuevo', compact('usuarios', 'm_nuevos', 'recibidos_ind'));
    }

    public function mensajes_detalle($id)
    {
        $usr = auth()->user()->email;
        $mensaje   = DB::table('chat_sistema')->where('id', "$id")->where('receptor', "$usr")->orderBy('fecha', 'DESC')->get();
        $enviados  = DB::table('chat_sistema')->where('usuario_envio', "$usr")->get();
        $m_nuevos  = DB::table('chat_sistema')->where('receptor', "$usr")->where('estatus', "1")->get();
        $estatus   = 2;
        $fecha = Carbon::now();
        DB::table('chat_sistema')->where('receptor', "$usr")->where('id', "$id")->update(['estatus' => $estatus, 'updated_at' => $fecha]);
        $ob_re  = DB::table('chat_sistema')->where('id', "$id")->first('correo');
        $id_receptor = User::where('email', "$ob_re->correo")->first('id');
        $id_receptor = $id_receptor->id;
        //DB::table('chat_sistema')->where('receptor',"$usr")->where('id',"$id")->update(['estatus'=>$estatus,'updated_at'=>$fecha]);
        //dd($ob_re->correo);
        $recibidos_ind = $this->retorna_mensajes();
        return view('servicio.mensajes', compact('mensaje', 'enviados', 'm_nuevos', 'id_receptor', 'recibidos_ind'));
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
        return view('servicio.mensajes', compact('mensaje', 'enviados', 'm_nuevos', 'id_receptor', 'recibidos_ind'));
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
        return view('servicio.mensajes', compact('mensaje', 'enviados', 'm_nuevos', 'id_receptor', 'recibidos_ind'));
    }

    public function enviar_mensaje(Request $request)
    {
        $usr = auth()->user()->username;
        $mi_correo = auth()->user()->email;
        $destin    = $request->input('usuario');
        $mensaje   = $request->input('descr');
        $asunto    = $request->input('asunto');
        $fecha     = Carbon::now();
        $estatus   = 1;
        $receptor  = User::where('id', "$destin")->first('email');
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

    //oficios 
    public function obtener_oficios()
    {
        $us = "docencia";
        $oficios = DB::table('oficios')->where('us_genero', "$us")->get();
        $recibidos_ind = $this->retorna_mensajes();
        return view('servicio.oficios', compact('oficios', 'recibidos_ind'));
    }

    public function agregar_oficio(Request $request)
    {

        //dd($_REQUEST['field_name']);
        $nombre  = $request->input('nombre');
        $estatus = $request->input('estatus');
        $caracteriticas = $request->input('caracteriticas');
        $fecha = Carbon::now();
        $us_genero = "docencia";
        DB::table('oficios')->insert(['nombre' => "$nombre", 'caracteristicas' => "$caracteriticas", 'estatus' => "$estatus", 'us_genero' => "$us_genero", 'created_at' => $fecha, 'updated_at' => $fecha]);
        Session::flash('message', 'Se agrego correctamente');
        $us = "docencia";
        $oficios = DB::table('oficios')->where('us_genero', "$us")->get();
        $recibidos_ind = $this->retorna_mensajes();
        return view('servicio.oficios', compact('oficios', 'recibidos_ind'));
    }

    public function actualizar_oficio(Request $request)
    {
        $id_oficio = $request->input('id_oficio');
        $nombre    = $request->input('nombre');
        $estatus   = $request->input('estatus');
        $caracteriticas = $request->input('caracteriticas');
        $fecha = Carbon::now();

        //dd($_POST);

        if (!empty($_POST) and !empty($id_oficio)) {
            $i = 1;
            foreach ($_POST as $key => $value) {
                if (trim($value) != '') {
                    $sqlArr[$key] = "$value";
                }
            }
            unset($sqlArr['_token']);
            unset($sqlArr['id_oficio']);

            DB::table('oficios')->where('id', "$id_oficio")->update($sqlArr);
            DB::table('oficios')->where('id', "$id_oficio")->update(['updated_at' => $fecha]);
            Session::flash('message', 'Se actualizo el oficio correctamente');
        }
        $us = "docencia";
        $oficios = DB::table('oficios')->where('us_genero', "$us")->get();
        $recibidos_ind = $this->retorna_mensajes();
        return view('servicio.oficios', compact('oficios', 'recibidos_ind'));
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


        $solicitud = Solicitud::where('id', "$id_alumno")->get();
        $fecha = Carbon::now();
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $fecha = Carbon::parse($fecha);
        $mes = $meses[($fecha->format('n')) - 1];
        $fecha_completa = $fecha->format('d') . ' de ' . $mes . ' de ' . $fecha->format('Y');

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

        $pdf = \PDF::loadView('servicio.oficio_imprimir', compact('datos', 'tipo_oficio', 'fecha', 'fecha_completa', 'solicitud', 'carreras', 'planes', 'titulaciones', 'profesores', 'revisores', 'sinodales'));
        $pdf->setPaper('A4');
        return $pdf->stream('result.pdf');
        //return view('docencia.oficio_imprimir',compact('datos','tipo_oficio','fecha','solicitud'));
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
