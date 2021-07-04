<?php

namespace App\Http\Controllers;

use App\Carrera;
use App\Ceremonia;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Role;
use Session;
use App\Estatus;
use App\Profesor;
use App\Revisor;
use App\Sinodal;
use App\Solicitud;
use App\User;


class ProfesorController extends Controller
{

    public function index(){
        
        $mensajes_rec = $this->verificar_mensajes();
        //dd($mensajes_rec);
        $usr_c = auth()->user()->email;
        $recibidos_ind =$this->retorna_mensajes_pr(); 
        return view('profesores.index', compact('mensajes_rec','recibidos_ind'));


    }

    public function perfil(){
        
        $mensajes_rec = $this->verificar_mensajes();
        $recibidos_ind =$this->retorna_mensajes_pr();
        //dd($mensajes_rec);
        return view('profesores.perfil', compact('mensajes_rec','recibidos_ind'));


    }
     public function asignados()
    {
        //* SE ACTUALIZO VERIFICAR

        //hacer validacion pertinente para poder mostrar las solicitudes asignadas inconsistencia de datos
        $usr=auth()->user()->username;
        $profesores=Profesor::all();
        $idp='';
        foreach ($profesores as $prof) {
            if($prof->rfc==$usr){
                $idp=$prof->id;
            }
        }
        $revisores = Revisor::where('id_profesor',"$idp")->get();
        //$id_solicitud = Revisor::where('id_profesor',"$idp")->find('id_solicitud');
        //$asignados = Solicitud::all();
        $estatus= Estatus::all();
        $mi_id=$idp;
        $carreras = Carrera::all();
        $estatus2= DB::table('estatus_revisor_sinodal')->get();
        

        $asignados  = Solicitud::select('solicitudes.id','solicitudes.n_control','solicitudes.p_nombre','solicitudes.s_nombre','solicitudes.a_paterno','solicitudes.a_materno','solicitudes.id_carrera','solicitudes.id_plan','solicitudes.n_proyecto','solicitudes.proy_archivo','solicitudes.repositorio_documentos','solicitudes.created_at','solicitudes.s_estatus','solicitudes.id_optitulacion')
        ->join('revisores', 'solicitudes.id', '=', 'revisores.id_solicitud')
        ->where('revisores.id_profesor',"$idp")
        ->where('solicitudes.s_estatus',"6")
        ->orwhere('solicitudes.s_estatus',"7")
        ->distinct()
        ->orderBy('solicitudes.created_at','DESC')
        ->get();

        //dd($mensajes);
        
       /* DB::table('chat_proyecto')->select('chat_proyecto.usuario_envio','chat_proyecto.mensaje', 'chat_proyecto.receptor','chat_proyecto.fecha','chat_proyecto.estatus','solicitudes.p_nombre')
        ->join('revisores', 'chat_proyecto.id_solicitud', '=', 'revisores.id_solicitud')
        ->join('solicitudes', 'chat_proyecto.id_solicitud', '=', 'solicitudes.id')
        ->where('chat_proyecto.receptor',"$usr")
        ->where('chat_proyecto.estatus',"1")
        ->orderBy('chat_proyecto.fecha','DESC')
        ->distinct()
        ->get();
        */

        $mensajes_rec = $this->verificar_mensajes();
        $recibidos_ind =$this->retorna_mensajes_pr();
        
        return view('profesores.asignados',compact('asignados','revisores','estatus','carreras','estatus2','mensajes_rec','recibidos_ind'));
        
    }

    public function asignados_sinodal()
    {
        
        $mi_id=auth()->user()->username;
        $profesores=Profesor::where('rfc',"$mi_id")->get();
        foreach ($profesores as $prof) {
                $idp=$prof->id;
        }
        $sinodales = Sinodal::where('id_profesor',"$idp")->get();
        //$asignados = Solicitud::all();
        $estatus= Estatus::all();
        $mi_id=$idp;
        $carreras = Carrera::all();
        $estatus2= DB::table('estatus_revisor_sinodal')->get();
        $tipoS= DB::table('tipo_sinodal')->get();
        $tip= json_encode($sinodales);
        $ceremonias = DB::table('ceremonias')->get();
        $salas= DB::table('sala_eventos')->get();
        //dd($tip);
        //return $tip;
        $asignados  = Solicitud::select('solicitudes.id','solicitudes.n_control','solicitudes.p_nombre','solicitudes.s_nombre','solicitudes.a_paterno','solicitudes.a_materno','solicitudes.id_carrera','solicitudes.id_plan','solicitudes.n_proyecto','solicitudes.proy_archivo','solicitudes.repositorio_documentos','solicitudes.created_at','solicitudes.s_estatus','solicitudes.id_optitulacion')
        ->join('sinodales', 'solicitudes.id', '=', 'sinodales.id_solicitud')
        ->where('sinodales.id_profesor',"$idp")
        ->where('solicitudes.s_estatus',"5")
        ->orwhere('solicitudes.s_estatus',"17")
        ->orwhere('solicitudes.s_estatus',"9")
        ->orwhere('solicitudes.s_estatus',"10")
        ->distinct()
        ->orderBy('solicitudes.created_at','DESC')
        ->get();
        //dd($tipoS);


        $mensajes_rec = $this->verificar_mensajes();
        $recibidos_ind =$this->retorna_mensajes_pr();
        return view('profesores.asignados_sinodal',compact('asignados','sinodales','estatus','carreras','estatus2','tipoS','ceremonias','salas','mensajes_rec','recibidos_ind'));
        
    }



    public function obtener_mensajes()
    {
        $usr       = auth()->user()->username;
        $solicitud = Solicitud::where('s_estatus',7)->where('id_optitulacion','!=',4)->get();
        $profesores = Profesor::where('rfc',"$usr")->get();
        $mensajes_rec = $this->verificar_mensajes();
        $recibidos_ind =$this->retorna_mensajes_pr();
        


        if(!empty($profesores) and !empty($solicitud)){
            foreach ($profesores as $prof) {
                //$estado= $prof->s_estatus;
                //$tipo_s = $sol->id_optitulacion;
            }
            $id_prof   = $prof->id;
            $revisores = Revisor::where('id_profesor',"$id_prof")->get();
            $mensajes  = DB::table('chat_proyecto')->orderBy('fecha','ASC')->get();
            

            return view('profesores.mensajes', compact('mensajes','profesores','solicitud','revisores','mensajes_rec','recibidos_ind')); 

        }else{
            
            Session::flash('message', 'Sin acceso a mensajes');
            return view('profesores.index', compact('mensajes_rec','recibidos_ind'));
        }

    }

    public function enviar_mensaje(Request $request)
    {
        $usr       = auth()->user()->username;
        $id_solicitud =  $request->input('solicitud');
        $id_revisor   =  $request->input('revisor');
        $mensaje      =  $request->input('mensaje');
        $mensajes_rec = $this->verificar_mensajes();
        $recibidos_ind =$this->retorna_mensajes_pr();
        //$usuario_envio = Profesor::where('rfc',"$usr")->first('id');
        $receptor     =  Solicitud::where('id',"$id_solicitud")->first('n_control');
        $fecha = Carbon::now();
        $estatus = 1;
        if(!empty($id_solicitud) and !empty($id_revisor) and !empty($mensaje)){
            DB::table('chat_proyecto')->insert(['usuario_envio'=>$usr,'mensaje'=>$mensaje,'id_solicitud'=>$id_solicitud,'id_revisor'=>$id_revisor,'receptor'=>$receptor->n_control,'fecha'=>$fecha,'estatus'=>$estatus]);
            Session::flash('message', 'Mensaje enviado');
        }
        //dd("hola");
       // datos para la vista
        $solicitud = Solicitud::where('s_estatus',7)->where('id_optitulacion','!=',4)->get();
        $profesores = Profesor::where('rfc',"$usr")->get();

            foreach ($profesores as $prof) {
                //$estado= $prof->s_estatus;
                //$tipo_s = $sol->id_optitulacion;
            }
            $id_prof   = $prof->id;
            $revisores = Revisor::where('id_profesor',"$id_prof")->get();
            $mensajes  = DB::table('chat_proyecto')->get();

        
        
            return view('profesores.mensajes', compact('mensajes','profesores','solicitud','revisores','mensajes_rec','recibidos_ind')); 

    }

    
    public function actualizar_solicitud(Request $request){
        $usr=auth()->user()->username;
        $aceptar_sol = $request->input('aceptar');
        $rechaza_sol = $request->input('rechazar');
        $aceptar_sinodal = $request->input('aceptar_sinodal');
        $rechaza_sinodal = $request->input('rechazar_sinodal');
        $aceptar_proyecto = $request->input('aceptar_proyecto');
        $rechaza_proyecto = $request->input('rechazar_proyecto');
        $solicitud   = $request->input('solicitud');
        $verificar_id_revisor = Profesor::where('rfc',"$usr")->first('id');
        $date = Carbon::now();
        $mensajes_rec = $this->verificar_mensajes();
        $recibidos_ind =$this->retorna_mensajes_pr();

        // Para Aceptar/Rechazar  ser Revisor
        if(!empty($aceptar_sol)){
            $estatus_solicitud=5;
            Revisor::where('id_solicitud',"$solicitud")->where('id_profesor',"$verificar_id_revisor->id")->update(['id_estatus' => $estatus_solicitud,'updated_at' => $date]);
        }else{
            if(!empty($rechaza_sol)){
                $estatus_solicitud=6;
                $quitar_rev=0;
                Revisor::where('id_solicitud',"$solicitud")->where('id_profesor',"$verificar_id_revisor->id")->update(['id_estatus' => $estatus_solicitud,'updated_at' => $date]);
            }
        }

        // Para Aceptar/Rechazar ser Sinodal
        if(!empty($aceptar_sinodal)){
            // Actualizamos estatus de Sinodal
            $estatus_solicitud=3;
            Sinodal::where('id_solicitud',"$solicitud")->where('id_profesor',"$verificar_id_revisor->id")->update(['id_estatus' => $estatus_solicitud,'updated_at' => $date]);
        }else{
            if(!empty($rechaza_sinodal)){
                $estatus_solicitud=4;
                $quitar_rev=0;
                Sinodal::where('id_solicitud',"$solicitud")->where('id_profesor',"$verificar_id_revisor->id")->update(['id_estatus' => $estatus_solicitud,'updated_at' => $date]);
            }
        }

        // verificar si es el ultimo profesor para cambiar el estatus de la solicitud contar cuantos son
       $tramite_sol = Solicitud::where('id',"$solicitud")->get();
       
        foreach (  $tramite_sol  as $sol) {
            $estado= $sol->s_estatus;
            //$tipo_s = $sol->id_optitulacion;
        }
        $tipo_s = $sol->id_optitulacion;
        $estado_s= $sol->s_estatus;

        //cambiar estado de la solicitud cuando es diferente a Tesis

        if($estado_s == 6 and $tipo_s == 1 or $tipo_s == 2 or $tipo_s == 3 ){
            // verificar si es el ultimo profesor para cambiar el estatus de la solicitud contar cuantos son
            $v_estatus_sol = Revisor::where('id_estatus','5')->where('id_solicitud',"$solicitud")->count();
            if($v_estatus_sol==3){
                Solicitud::where('id',"$solicitud")->update(['s_estatus'=>"7",'updated_at' => $date]);

                 //Registro en bitacora
            $usr = auth()->user()->username;
            $descripcion= "En proceso de Revision de proyecto ";
            $fecha_actual= Carbon::now();
            $this->registrar_bitacora($usr,$solicitud,7,$descripcion,$fecha_actual);

            }

        }

         
        
        // Verificar cuando es tipo de CENEVAL
        if($tipo_s == 4 and  $estado== 17 ){
            $v_estatus_sol = Sinodal::where('id_estatus','3')->where('id_solicitud',"$solicitud")->count();
            if($v_estatus_sol==4){
                // Avanza a estatus 9
                Solicitud::where('id',"$solicitud")->update(['s_estatus'=>"9",'updated_at' => $date]);

                 //Registro en bitacora
            $usr = auth()->user()->username;
            $descripcion= "En proceso de tramite de Titulacion";
            $fecha_actual= Carbon::now();
            $this->registrar_bitacora($usr,$solicitud,9,$descripcion,$fecha_actual);

            }
        }else{
            // Para cuando la solicitud es otro tipo de titulacion
            if($estado_s == 17 and $tipo_s == 1 or $tipo_s == 2 or $tipo_s == 3 ){
            $v_estatus_sol = Sinodal::where('id_estatus','3')->where('id_solicitud',"$solicitud")->count();
            if($v_estatus_sol==4){
                Solicitud::where('id',"$solicitud")->update(['s_estatus'=>"9",'updated_at' => $date]);
               
                //Registro en bitacora
            $usr = auth()->user()->username;
            $descripcion= "En proceso de tramite de Titulacion";
            $fecha_actual= Carbon::now();
            $this->registrar_bitacora($usr,$solicitud,9,$descripcion,$fecha_actual);
            }
           
            
        }
    }
    Session::flash('message','Todo Correcto');
    return view('profesores.index',compact('mensajes_rec','recibidos_ind'));
}

    public function actualizar_proyecto(Request $request){
        $usr=auth()->user()->username;
        $aceptar_proyecto = $request->input('aceptar_proyecto');
        $rechaza_proyecto = $request->input('rechazar_proyecto');
        $solicitud   = $request->input('solicitud');
        $verificar_id_revisor = Profesor::where('rfc',"$usr")->first('id');
        $date = Carbon::now();
        $mensajes_rec = $this->verificar_mensajes();
        $recibidos_ind =$this->retorna_mensajes_pr();
        //dd($_POST);
        // cambiar el estatus de los revisores del proyecto 
        if(!empty($aceptar_proyecto)){
            $estatus_solicitud=7;
            Revisor::where('id_solicitud',"$solicitud")->where('id_profesor',"$verificar_id_revisor->id")->update(['id_estatus' => $estatus_solicitud,'updated_at' => $date]);
            DB::table('chat_proyecto')->where('receptor',"$usr")->where('id_solicitud',"$solicitud")->update(['estatus'=>'2','updated_at' => $date]);
        }else{
            if(!empty($rechaza_proyecto)){
                $estatus_solicitud=8;
                $quitar_rev=0;
                Revisor::where('id_solicitud',"$solicitud")->where('id_profesor',"$verificar_id_revisor->id")->update(['id_estatus' => $estatus_solicitud,'updated_at' => $date]);
                DB::table('chat_proyecto')->where('receptor',"$usr")->where('id_solicitud',"$solicitud")->update(['estatus'=>'2','updated_at' => $date]);
            }
        }
        // verificar si es el ultimo profesor para cambiar el estatus de la solicitud contar cuantos son
        $v_estatus_sol_apro = Revisor::where('id_estatus','7')->where('id_solicitud',"$solicitud")->count();
        if($v_estatus_sol_apro==3){
            Solicitud::where('id',"$solicitud")->update(['s_estatus'=>"11",'updated_at' => $date]);

            //Registro en bitacora
            $usr = auth()->user()->username;
            $descripcion= "El proyecto fue aprobado";
            $fecha_actual= Carbon::now();
            $this->registrar_bitacora($usr,$solicitud,11,$descripcion,$fecha_actual);
            DB::table('chat_proyecto')->where('id_solicitud',"$solicitud")->update(['estatus'=>'2','updated_at' => $date]);
            
        }else{
            $v_estatus_sol_recha = Revisor::where('id_estatus','8')->where('id_solicitud',"$solicitud")->count();
            $suma= $v_estatus_sol_apro+$v_estatus_sol_recha;
            if($suma == 3){
                Solicitud::where('id',"$solicitud")->update(['s_estatus'=>"12",'updated_at' => $date]);

                //Registro en bitacora
            $usr = auth()->user()->username;
            $descripcion= "El proyecto fue rechazado / no cumple con los requisitos";
            $fecha_actual= Carbon::now();
            $this->registrar_bitacora($usr,$solicitud,12,$descripcion,$fecha_actual);
            DB::table('chat_proyecto')->where('id_solicitud',"$solicitud")->update(['estatus'=>'2','updated_at' => $date]);

            }
        }

        

        Session::flash('message','Todo Correcto ');
        	return view('profesores.index',compact('mensajes_rec','recibidos_ind'));

    }

    public function alumnoD($id)
    {
        $usr      = auth()->user()->username;
        $alumno   = Solicitud::where('id',"$id")->get();
        $profesor = Profesor::where('rfc',"$usr")->first('id');
        $revisor  = Revisor::where('id_solicitud',"$id")->where('id_profesor',"$profesor->id")->where('id_estatus',"5")->orwhere('id_estatus',"3")->get(); 
        $carreras = Carrera::all();
        $mensajes_rec = $this->verificar_mensajes();
        $recibidos_ind =$this->retorna_mensajes_pr();
        //dd($revisor);
        if(count($revisor)){
            return view('profesores.detalles',compact('alumno','carreras','mensajes_rec','recibidos_ind'));
        }else{
        	Session::flash('message','El tramite sobre este proceso cambio, no es posible acceder');
        	return view('profesores.index',compact('mensajes_rec','recibidos_ind'));
        }         
    }

    public function ceremonias(){
        $usr=auth()->user()->username;
        $ceremonia = array();
        $profe_id = Profesor::where('rfc',"$usr")->first('id');
        $id=$profe_id->id;
        $sinodales = Sinodal::where('id_profesor',"$id")->get();
        $id_sol = Revisor::where('id_profesor',"$id")->get();
        $salas= DB::table('sala_eventos')->get();
        $fecha= Carbon::now();
        $mensajes_rec = $this->verificar_mensajes();
        $recibidos_ind =$this->retorna_mensajes_pr();
        
        $f1=$fecha->firstOfMonth();
        $f1=$f1->format('Y-m-d');
        $f2=$fecha->endOfMonth();
        $f2=$f2->format('Y-m-d');
        $ceremonia= DB::table('ceremonias')->whereBetween('fecha',array($f1,$f2))->get();
        //dd($f2);

        return view('profesores.eventos',compact('ceremonia','sinodales','salas','mensajes_rec','recibidos_ind')); 
    }

    private function cambio_estado_solicitud($id_solicitud,$nuevo_estado){
        $correcto = false;
        $cambio   = Solicitud::where('id', '=', "$id_solicitud")->update(['s_estatus'=>$nuevo_estado]);
        if($cambio){
            $correcto=true;
        }
        return $correcto;
        

    }

    private function verificar_mensajes(){
        $usr     = auth()->user()->username;
        //$mi_id = Solicitud::where('n_control',"$usr")->first('id');
        $mensajes = DB::table('chat_proyecto')->select('chat_proyecto.usuario_envio','chat_proyecto.mensaje', 'chat_proyecto.receptor','chat_proyecto.fecha','chat_proyecto.estatus','solicitudes.p_nombre')
        ->join('revisores', 'chat_proyecto.id_solicitud', '=', 'revisores.id_solicitud')
        ->join('solicitudes', 'chat_proyecto.id_solicitud', '=', 'solicitudes.id')
        ->where('chat_proyecto.receptor',"$usr")
        ->where('chat_proyecto.estatus',"1")
        ->orderBy('chat_proyecto.fecha','DESC')
        ->distinct()
        ->get();
        //$mensajes = DB::table('chat_proyecto')->where('receptor',"$usr")->where('estatus',"1")->get();
        return $mensajes;
    }

    public function actualizar_mensajes(Request $request){
        $usr     = auth()->user()->username;
        $usuario_envio = $request->input('usuario_envio');
        $estatus = 2;
        $mensajes = DB::table('chat_proyecto')->where('receptor',"$usr")->where('id_revisor',"$usuario_envio")->update(['estatus'=>$estatus]);
        
        return "exito";
    }

    private function registrar_bitacora($usuario,$solicitud,$estatus,$descripcion,$fecha){
        // verificar si ya se habia regitrado
        $verificar= DB::table('bitacora')->where('id_solicitud',"$solicitud")->where('id_estatus',"$estatus")->exists();
        if($verificar){
            $estado = DB::table('bitacora')->update(['updated_at'=>$fecha]);
        }else{
            $estado = DB::table('bitacora')->insert(['id_usuario'=>$usuario,'id_solicitud'=>$solicitud,'id_estatus'=>$estatus,'descripcion'=>$descripcion,'created_at'=>$fecha,'updated_at'=>$fecha]);

        }
       
         return $estado;    
    }


    // --------------------------Mensajes
public function obtener_mensajes_pr($name){
    if($name=="inbox"){
        $usr = auth()->user()->email;
        $recibidos = DB::table('chat_sistema')->where('receptor',"$usr")->orderBy('fecha','DESC')->Paginate(15);
        $paginados = DB::table('chat_sistema')->where('receptor',"$usr")->orderBy('fecha','DESC')->simplePaginate(15);
        $enviados  = array();
        $m_nuevos  = DB::table('chat_sistema')->where('receptor',"$usr")->where('estatus',"1")->get();
         //dd($recibidos);
        $fecha = Carbon::now();
         //Session::flash('message', 'Sin acceso a mensajes');
         $recibidos_ind =$this->retorna_mensajes_pr();
         $mensajes_rec = $this->verificar_mensajes();
         return view('profesores.bandeja_inbox',compact('recibidos','enviados','m_nuevos','paginados','fecha','recibidos_ind','mensajes_rec'));

    }else{
        if($name=="borrados"){
            $usr = auth()->user()->email;
            $estatus= 3;
            $recibidos = DB::table('chat_sistema')->where('receptor',"$usr")->where('estatus',"$estatus")->orderBy('fecha','DESC')->simplePaginate(15);
            $paginados = DB::table('chat_sistema')->where('receptor',"$usr")->orderBy('fecha','DESC')->simplePaginate(15);
            $enviados  = array();
            $m_nuevos  = DB::table('chat_sistema')->where('receptor',"$usr")->where('estatus',"1")->get();
            $recibidos_ind =$this->retorna_mensajes_pr();
            $mensajes_rec = $this->verificar_mensajes();
        
         return view('profesores.bandeja_inbox',compact('recibidos','enviados','m_nuevos','paginados','recibidos_ind','mensajes_rec'));

        }else{
            if($name=="importantes"){
                $usr = auth()->user()->email;
                $estatus= 4;
                $recibidos = DB::table('chat_sistema')->where('receptor',"$usr")->where('estatus',"$estatus")->orderBy('fecha','DESC')->simplePaginate(15);
                $paginados = DB::table('chat_sistema')->where('receptor',"$usr")->orderBy('fecha','DESC')->simplePaginate(15);
                $enviados  = array();
                $m_nuevos  = DB::table('chat_sistema')->where('receptor',"$usr")->where('estatus',"1")->get();
                $recibidos_ind =$this->retorna_mensajes_pr();
                $mensajes_rec = $this->verificar_mensajes();
            
             return view('profesores.bandeja_inbox',compact('recibidos','enviados','m_nuevos','paginados','recibidos_ind','mensajes_rec'));

            }else{
                if($name=="enviados"){
                    $usr = auth()->user()->email;
                    $estatus= 4;
                    $recibidos = array();
                    $paginados = DB::table('chat_sistema')->where('receptor',"$usr")->orderBy('fecha','DESC')->simplePaginate(15);
                    $enviados  = DB::table('chat_sistema')->where('correo',"$usr")->orderBy('fecha','DESC')->simplePaginate(15);
                    $m_nuevos  = DB::table('chat_sistema')->where('receptor',"$usr")->where('estatus',"1")->get();
                    $recibidos_ind =$this->retorna_mensajes_pr();
                    $mensajes_rec = $this->verificar_mensajes();
                    
                
                 return view('profesores.bandeja_inbox_env',compact('recibidos','enviados','m_nuevos','paginados','recibidos_ind','mensajes_rec'));
    
                }
                

            }

        }
    }

    $usr = auth()->user()->email;
    $recibidos = DB::table('chat_sistema')->where('receptor',"$usr")->orderBy('fecha','DESC')->Paginate(15);
    $paginados = DB::table('chat_sistema')->where('receptor',"$usr")->orderBy('fecha','DESC')->simplePaginate(15);
    $enviados  = array();
    $m_nuevos  = DB::table('chat_sistema')->where('receptor',"$usr")->where('estatus',"1")->get();
     //dd($recibidos);
    $fecha = Carbon::now();
     //Session::flash('message', 'Sin acceso a mensajes');
     $recibidos_ind =$this->retorna_mensajes_pr();
     $mensajes_rec = $this->verificar_mensajes();
     return view('profesores.bandeja_inbox',compact('recibidos','enviados','m_nuevos','paginados','fecha','recibidos_ind','mensajes_rec'));
    
    
}

public function nuevo_mensaje_pr()
{
    $usr = auth()->user()->email;
    //dd("hola");
    $usuarios = User::select('users.name','users.email', 'role_user.role_id','role_user.user_id','roles.description')
    ->join('role_user', 'users.id', '=', 'role_user.user_id')
    ->join('roles', 'roles.id', '=', 'role_user.role_id')
    ->where('role_user.role_id',"4")
    ->get();
    //dd($usuarios);
    
    $m_nuevos  = DB::table('chat_sistema')->where('receptor',"$usr")->where('estatus',"1")->get();
    $recibidos_ind =$this->retorna_mensajes_pr();
    $mensajes_rec = $this->verificar_mensajes();

    

    return view('profesores.bandeja_nuevo',compact('usuarios','m_nuevos','recibidos_ind','mensajes_rec'));
}

public function mensajes_detalle_pr($id){
    $usr = auth()->user()->email;
    $mensaje   = DB::table('chat_sistema')->where('id',"$id")->where('receptor',"$usr")->orderBy('fecha','DESC')->get();
    $enviados  = DB::table('chat_sistema')->where('usuario_envio',"$usr")->get();
    $m_nuevos  = DB::table('chat_sistema')->where('receptor',"$usr")->where('estatus',"1")->get();
    $estatus   = 2;
    $fecha = Carbon::now();
    DB::table('chat_sistema')->where('receptor',"$usr")->where('id',"$id")->update(['estatus'=>$estatus,'updated_at'=>$fecha]);
    $ob_re  = DB::table('chat_sistema')->where('id',"$id")->first('correo');
    $id_receptor = User::where('email',"$ob_re->correo")->first('id');
    $id_receptor = $id_receptor->id;
    //DB::table('chat_sistema')->where('receptor',"$usr")->where('id',"$id")->update(['estatus'=>$estatus,'updated_at'=>$fecha]);
    //dd($ob_re->correo);
    $recibidos_ind = $this->retorna_mensajes_pr();
    $mensajes_rec = $this->verificar_mensajes();
    return view('profesores.bandeja',compact('mensaje','enviados','m_nuevos','id_receptor','recibidos_ind','mensajes_rec'));
    
    
}

public function mensajes_detalle_r_pr($id){
    $usr = auth()->user()->email;
    $mensaje   = DB::table('chat_sistema')->where('id',"$id")->where('receptor',"$usr")->orderBy('fecha','DESC')->get();
    $enviados  = DB::table('chat_sistema')->where('usuario_envio',"$usr")->orderBy('fecha','DESC')->get();
    $m_nuevos  = DB::table('chat_sistema')->where('receptor',"$usr")->where('estatus',"1")->get();
    $estatus= 2;
    $fecha = Carbon::now();
    $ob_re  = DB::table('chat_sistema')->where('id',"$id")->first('receptor');
    $id_receptor = User::where('email',"$ob_re->receptor")->first('id');
    $id_receptor = $id_receptor->id;
    //DB::table('chat_sistema')->where('receptor',"$usr")->where('id',"$id")->update(['estatus'=>$estatus,'updated_at'=>$fecha]);
    //dd($ob_re->receptor);
    $recibidos_ind =$this->retorna_mensajes_pr();
    $mensajes_rec = $this->verificar_mensajes();
    return view('profesores.bandeja',compact('mensaje','enviados','m_nuevos','id_receptor','recibidos_ind','mensajes_rec'));
  
    
}

public function mensajes_detalle_r2_pr($id){
    $usr = auth()->user()->email;
    $mensaje   = DB::table('chat_sistema')->where('id',"$id")->where('correo',"$usr")->orderBy('fecha','DESC')->get();
    $enviados  = DB::table('chat_sistema')->where('usuario_envio',"$usr")->orderBy('fecha','DESC')->get();
    $m_nuevos  = DB::table('chat_sistema')->where('receptor',"$usr")->where('estatus',"1")->get();
    $estatus= 2;
    $fecha = Carbon::now();
    $ob_re  = DB::table('chat_sistema')->where('id',"$id")->first('receptor');
    $id_receptor = User::where('email',"$ob_re->receptor")->first('id');
    $id_receptor = $id_receptor->id;
    //DB::table('chat_sistema')->where('receptor',"$usr")->where('id',"$id")->update(['estatus'=>$estatus,'updated_at'=>$fecha]);
    //dd($ob_re->receptor);
    $recibidos_ind =$this->retorna_mensajes_pr();
    $mensajes_rec = $this->verificar_mensajes();
    return view('profesores.bandeja',compact('mensaje','enviados','m_nuevos','id_receptor','recibidos_ind','mensajes_rec'));
    
}

public function enviar_mensaje_pr(Request $request)
{
    $usr = auth()->user()->name;
    $mi_correo = auth()->user()->email;
    $destin    = $request->input('usuario');
    $mensaje   = $request->input('descr');
    $asunto    = $request->input('asunto');
    $fecha     = Carbon::now();
    $estatus   = 1;
    $receptor  = User::where('id',"$destin")->first('email');
    DB::table('chat_sistema')->insert(['usuario_envio'=>$usr,'correo'=>$mi_correo,'asunto'=>$asunto,'mensaje'=>$mensaje,'receptor'=>$receptor->email,'fecha'=>$fecha,'estatus'=>$estatus,'created_at'=>$fecha,'updated_at'=>$fecha]);
    Session::flash('message', 'Mensaje enviado');
    return $this->obtener_mensajes_pr('inbox');
}

public function retorna_mensajes_pr(){
    $usr_c = auth()->user()->email;
    $recibidos_ind = DB::table('chat_sistema')->where('receptor',"$usr_c")->where('estatus',"1")->latest()->get();
    return $recibidos_ind;
}
    
   

    

}
 