<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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


class ServiciosEscolaresController extends Controller
{
    public function index(){
        $usr_c = auth()->user()->email;
        $recibidos_ind =$this->retorna_mensajes(); 
        $m_nuevos  = DB::table('chat_sistema')->where('receptor',"$usr_c")->where('estatus',"1")->count();
        $alumno = Solicitud::where('s_estatus','!=','1')->get();
        $resumen= $this->obtener_resumen();
        

        //dd($resumen->nuevas);
       return view('coordinacion_serv_escolares.index',compact('alumno','recibidos_ind','resumen'));
   }

   public function perfil(){
    $usr_c = auth()->user()->email;
    $recibidos_ind =$this->retorna_mensajes(); 
    $m_nuevos  = DB::table('chat_sistema')->where('receptor',"$usr_c")->where('estatus',"1")->count();
    $alumno = Solicitud::where('s_estatus','!=','1')->get();
    
   return view('coordinacion_serv_escolares.perfil',compact('alumno','recibidos_ind'));
}

   

   public function solicitudes(){
    $planes     = Plan::all();
    $titulacion = Optitulacion::all();
    $alumno     = Solicitud::all();
    $estatus    = Estatus::all();
    $revisores  = Revisor::all();
    $sinodales  = Sinodal::all();
    $profesores = Profesor::all();
    $carreras   = Carrera::all();
    $estatus2   = \DB::table('estatus_revisor_sinodal')->get();
    $recibidos_ind =$this->retorna_mensajes();
    //dd($alumno);
    
    return view('coordinacion_serv_escolares.solicitudes',compact('alumno','planes','estatus2','titulacion','estatus','profesores','revisores','sinodales','carreras','recibidos_ind'));
    
   }

   public function detalle_solicitud($id)
   {
       $usr             = auth()->user()->id;
       $solicitud       = Solicitud::where('id',"$id")->get();
       $planes          = Plan::all();
       $op_titulaciones = Optitulacion::all();
       $profesores      = Profesor::all();
       $revisores       = Revisor::all();
       $sinodales       = Sinodal::all();
       $carreras        = Carrera::all();
       $estatus2   = \DB::table('estatus_revisor_sinodal')->get();
       $oficios    = DB::table('oficios_solicitud')->where('id_solicitud', "$id")->get();
       $documentos = DB::table('documentos_adjuntos')->where('id_solicitud', "$id")->get();
       $tipo_oficio = DB::table('oficios')->get();

       foreach ($solicitud as $sol) {
           $estado = $sol->s_estatus;  
       }
       $tipo_s = $sol->id_optitulacion;
      
       //dd("hola3",$tipo_s);
       $profesores = Profesor::all();
       $revisores  = Revisor::all();
       $sinodales  = Sinodal::all();
       
       $solicitud = Solicitud::where('id',"$id")->get();
       $recibidos_ind =$this->retorna_mensajes();
       return view('coordinacion_serv_escolares.detalles',compact('solicitud','carreras','planes','op_titulaciones','profesores','revisores','sinodales','recibidos_ind','estatus2','oficios','documentos','tipo_oficio')); 
   }

   public function actualizar_solicitud(Request $request)
    {
        $usuario         = $request->input('solicitud');
        $cambio_estado   = $request->input('cambio_estado_proyecto');
        $concluye_tramite      = $request->input('concluye_tramite');
        $alumno_titulado       = $request->input('alumno_titulado');
        $oficio_titulado       = $request->file('oficio_titulado');
        
       
        //dd($_FILES);
         if(!empty($concluye_tramite )){
            $this->cambio_estado_solicitud($usuario,13);
         }
         if(!empty($alumno_titulado )){
            $this->cambio_estado_solicitud($usuario,10);
            // Adjuntando oficio
            $tip_of=12;
            if($request->hasFile('oficio_titulado')){
                //indicamos que queremos guardar un nuevo archivo en el disco local
                $file = $request->file('oficio_titulado')->store('public');
                //dd($_FILES);
                $of_archivo_name = str_replace("public/", "", $file);
                $this->adjuntar_oficio($of_archivo_name,$tip_of,$usuario);
             }

            //Registro en bitacora
            $usr = auth()->user()->username;
            $descripcion= "Alumno titulado ";
            $fecha_actual= Carbon::now();
            $this->registrar_bitacora($usr,$usuario,10,$descripcion,$fecha_actual);
         }
        $alumno = \DB::table('solicitudes')->get();
        $recibidos_ind =$this->retorna_mensajes();
        $resumen= $this->obtener_resumen();
        return view('coordinacion_serv_escolares.index',compact('alumno','recibidos_ind','resumen'));

    }


    private function cambio_estado_solicitud($id_solicitud,$nuevo_estado){
        $correcto = false;
        $cambio   = Solicitud::where('id', '=', "$id_solicitud")->update(['s_estatus'=>$nuevo_estado]);
        if($cambio){
            $correcto=true;
        }
        return $correcto;
        

    }

    private function adjuntar_oficio($url,$tipo,$solicitud){
        $fecha  = Carbon::now();
        $estado = DB::table('oficios_solicitud')->insert(['url'=>$url,'id_tipo_oficio'=>$tipo,'id_solicitud'=>$solicitud,'created_at'=>$fecha,'updated_at'=>$fecha]);
        return $estado;
    }
 
   

 // Registro en la bitacora del movimiento de la solicitud 
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

 //********** Mensajes */

 public function obtener_mensajes($name){
    if($name=="inbox"){
        $usr = auth()->user()->email;
        $recibidos = DB::table('chat_sistema')->where('receptor',"$usr")->orderBy('fecha','DESC')->Paginate(15);
        $paginados = DB::table('chat_sistema')->where('receptor',"$usr")->orderBy('fecha','DESC')->simplePaginate(15);
        $enviados  = array();
        $m_nuevos  = DB::table('chat_sistema')->where('receptor',"$usr")->where('estatus',"1")->get();
         //dd($recibidos);
        $fecha = Carbon::now();
         //Session::flash('message', 'Sin acceso a mensajes');
         $recibidos_ind =$this->retorna_mensajes();
         return view('coordinacion_serv_escolares.mensajes_inbox',compact('recibidos','enviados','m_nuevos','paginados','fecha','recibidos_ind'));

    }else{
        if($name=="borrados"){
            $usr = auth()->user()->email;
            $estatus= 3;
            $recibidos = DB::table('chat_sistema')->where('receptor',"$usr")->where('estatus',"$estatus")->orderBy('fecha','DESC')->simplePaginate(15);
            $paginados = DB::table('chat_sistema')->where('receptor',"$usr")->orderBy('fecha','DESC')->simplePaginate(15);
            $enviados  = array();
            $m_nuevos  = DB::table('chat_sistema')->where('receptor',"$usr")->where('estatus',"1")->get();
            $recibidos_ind =$this->retorna_mensajes();
        
         return view('coordinacion_serv_escolares.mensajes_inbox',compact('recibidos','enviados','m_nuevos','paginados','recibidos_ind'));

        }else{
            if($name=="importantes"){
                $usr = auth()->user()->email;
                $estatus= 4;
                $recibidos = DB::table('chat_sistema')->where('receptor',"$usr")->where('estatus',"$estatus")->orderBy('fecha','DESC')->simplePaginate(15);
                $paginados = DB::table('chat_sistema')->where('receptor',"$usr")->orderBy('fecha','DESC')->simplePaginate(15);
                $enviados  = array();
                $m_nuevos  = DB::table('chat_sistema')->where('receptor',"$usr")->where('estatus',"1")->get();
                $recibidos_ind =$this->retorna_mensajes();
            
             return view('coordinacion_serv_escolares.mensajes_inbox',compact('recibidos','enviados','m_nuevos','paginados','recibidos_ind'));

            }else{
                if($name=="enviados"){
                    $usr = auth()->user()->email;
                    $estatus= 4;
                    $recibidos = array();
                    $paginados = DB::table('chat_sistema')->where('receptor',"$usr")->orderBy('fecha','DESC')->simplePaginate(15);
                    $enviados  = DB::table('chat_sistema')->where('correo',"$usr")->orderBy('fecha','DESC')->simplePaginate(15);
                    $m_nuevos  = DB::table('chat_sistema')->where('receptor',"$usr")->where('estatus',"1")->get();
                    $recibidos_ind =$this->retorna_mensajes();
                    
                
                 return view('coordinacion_serv_escolares.mensajes_inbox_env',compact('recibidos','enviados','m_nuevos','paginados','recibidos_ind'));
    
                }
                

            }

        }
    }
    
    
}

public function nuevo_mensaje()
{
    $usr = auth()->user()->email;
    $usuarios = User::select('users.name','users.email', 'role_user.role_id','role_user.user_id','roles.description')
    ->join('role_user', 'users.id', '=', 'role_user.user_id')
    ->join('roles', 'roles.id', '=', 'role_user.role_id')
    ->where('role_user.role_id','!=',"2")
    ->where('role_user.role_id','!=',"3")
    ->where('role_user.role_id','!=',"9")
    ->get();
    //dd($usuarios);
    //
    $m_nuevos  = DB::table('chat_sistema')->where('receptor',"$usr")->where('estatus',"1")->get();
    $recibidos_ind =$this->retorna_mensajes();

    return view('coordinacion_serv_escolares.mensajes_nuevo',compact('usuarios','m_nuevos','recibidos_ind'));
}

public function mensajes_detalle($id){
    $usr = auth()->user()->email;
    $mensaje   = DB::table('chat_sistema')->where('id',"$id")->where('receptor',"$usr")->orderBy('fecha','DESC')->get();
    $enviados  = DB::table('chat_sistema')->where('usuario_envio',"$usr")->get();
    $m_nuevos  = DB::table('chat_sistema')->where('receptor',"$usr")->where('estatus',"1")->get();
    $estatus= 2;
    $fecha = Carbon::now();
    DB::table('chat_sistema')->where('receptor',"$usr")->where('id',"$id")->update(['estatus'=>$estatus,'updated_at'=>$fecha]);
    $ob_re  = DB::table('chat_sistema')->where('id',"$id")->first('correo');
    $id_receptor = User::where('email',"$ob_re->correo")->first('id');
    $id_receptor = $id_receptor->id;
    //DB::table('chat_sistema')->where('receptor',"$usr")->where('id',"$id")->update(['estatus'=>$estatus,'updated_at'=>$fecha]);
    //dd($ob_re->receptor);
    $recibidos_ind =$this->retorna_mensajes();
    return view('coordinacion_serv_escolares.mensajes',compact('mensaje','enviados','m_nuevos','id_receptor','recibidos_ind'));
    
    
}

public function mensajes_detalle_r($id){
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
    $recibidos_ind =$this->retorna_mensajes();
    return view('coordinacion_serv_escolares.mensajes',compact('mensaje','enviados','m_nuevos','id_receptor','recibidos_ind'));
  
    
}

public function mensajes_detalle_r2($id){
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
    $recibidos_ind =$this->retorna_mensajes();
    return view('coordinacion_serv_escolares.mensajes',compact('mensaje','enviados','m_nuevos','id_receptor','recibidos_ind'));
    
}

public function enviar_mensaje(Request $request)
{
    $usr = auth()->user()->username;
    $mi_correo = auth()->user()->email;
    $destin = $request->input('usuario');
    $mensaje = $request->input('descr');
    $asunto = $request->input('asunto');
    $fecha = Carbon::now();
    
    $estatus= 1;
    $receptor = User::where('id',"$destin")->first('email');
    DB::table('chat_sistema')->insert(['usuario_envio'=>$usr,'correo'=>$mi_correo,'asunto'=>$asunto,'mensaje'=>$mensaje,'receptor'=>$receptor->email,'fecha'=>$fecha,'estatus'=>$estatus,'created_at'=>$fecha,'updated_at'=>$fecha]);

    Session::flash('message', 'Mensaje enviado');

    return $this->obtener_mensajes('inbox');
}

public function retorna_mensajes(){
    $usr_c = auth()->user()->email;
    $recibidos_ind = DB::table('chat_sistema')->where('receptor',"$usr_c")->where('estatus',"1")->latest()->get();
    return $recibidos_ind;
}

private function obtener_resumen(){
    
    
    $solicitudes    = Solicitud::where('s_estatus','!=','2')->count();
    $nuevas         = Solicitud::where('s_estatus','2')->count();
    $aceptado       = Solicitud::where('s_estatus','11')->orwhere('s_estatus','11')->orwhere('s_estatus','14')->count();
    $revision       = Solicitud::where('s_estatus','7')->count();
    $rechazado      = Solicitud::where('s_estatus','12')->count();

    $resumen = array('solicitudes'=>"$solicitudes",'nuevas'=>"$nuevas",'aceptados'=>"$aceptado",'revision'=>"$revision",'rechazado'=>"$rechazado");
    
    return $resumen;

}



}
