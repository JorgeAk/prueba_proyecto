<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\DocenciaController;
use App\Role;
use App\Profesor;
use App\Estatus;
use App\Optitulacion;
use App\Plan;
use App\Solicitud;
use App\User;

Route::get('/', function () {
	return view('auth.login');
});
#Rutas publicas login
Route::get('/login/alumno','AlumnoController@redirec', function () {
})->name('/login/alumno');

Route::get('/login/profesor', function () {
	return view('profesores.login');
})->name('/login/profesor');

Route::get('/login/administrativo', function () {
	return view('admin.login');
})->name('/login/administrativo');




#Rutas privadas
Auth::routes();


//Alumnos  //

Route::group(['prefix' => 'alumnos','middleware' => ['auth', 'role:alumno']],function() {
	
	Route::get('/','AlumnoController@index', function(){})->name('/alumnos');
	Route::get('/perfil','AlumnoController@perfil', function () {})->name('/alumnos/perfil');
	Route::post('/actualiza/archivo','AlumnoController@actualiza_archivo', function () {})->name('/alumnos/actualiza/archivo');
	
	//------------------ Alumno Imprimir------------------------------------------//
	//*cambiar name ruta
	Route::get('/imprimir', 'ImprimirController@imprimir', function(){})->name('imprimir');
	Route::get('/imprimir/ver', 'ImprimirController@ver', function(){})->name('imprimir/ver');
	
	//------------------ Alumno Mensajes Chat ------------------------------------------//
	Route::get('/mensajes','AlumnoController@obtener_mensajes', function () {})->name('/alumnos/mensajes');
	Route::post('/mensajes/nuevo','AlumnoController@enviar_mensaje', function () {})->name('/alumnos/mensajes/nuevo');
	Route::post('/mensajes/actualizar','AlumnoController@actualizar_mensajes', function () {})->name('/alumnos/mensajes/actualiza');

	//------------------ AlumnoSolicitud ------------------------------------------//
	Route::get('/solicitud','AlumnoController@obtener', function () {})->name('/alumnos/solicitud');

	#generar verificar seguridad que no se genere mas que 1 vez
	Route::get('/solicitud/generar','AlumnoController@generar', function () {})->name('/alumnos/solicitud/generar');
	Route::get('/solicitud/editar','AlumnoController@obtenerAL', function () {})->name('/alumnos/solicitud/editar');
	Route::post('/solicitud/editar/actualizar','AlumnoController@actualizar', function () {})->name('/alumnos/solicitud/editar/actualizar');
	Route::post('/solicitud/reg', 'AlumnoController@registrar', function () {})->name('/alumnos/reg');
	Route::get('/solicitud/eliminar','AlumnoController@eliminar', function () {})->name('/alumnos/solicitud/eliminar');
	Route::get('/solicitud/eliminar/del','AlumnoController@eliminarS', function () {	})->name('/alumnos/solicitud/eliminar/del');
	Route::get('/solicitud/estatus','AlumnoController@estatus', function () {})->name('/alumnos/solicitud/estatus');
});

//Ruta caso especial
Route::get('/obtenerp','HomeController@obtenerpr', function(){})->name('/obtenerp')->middleware('auth', 'role:alumno');
Route::post('/confirmarSol','AlumnoController@confirmarS', function(){})->name('/confirmarSol')->middleware('auth', 'role:alumno');


//Profesores  //
Route::group(['prefix' => 'profesor','middleware' => ['auth', 'role:profesor']],function() {
	Route::get('/','ProfesorController@index', function () {})->name('/profesor');
	Route::get('/perfil','ProfesorController@perfil', function () {})->name('/profesor/perfil');
	//------------------ Profesor Mensajes Chat Alumno------------------------------------------//
	Route::get('/mensajes', 'ProfesorController@obtener_mensajes', function () {})->name('/profesor/mensajes');
	Route::post('/mensajes/nuevo', 'ProfesorController@enviar_mensaje', function () {})->name('/profesor/mensajes/nuevo');
	Route::post('/mensajes/actualizar','ProfesorController@actualizar_mensajes', function () {})->name('/profesor/mensajes/actualiza');
	//------------------ Profesor Alumnos------------------------------------------//
	Route::get('/alumnos/asignados','ProfesorController@asignados', function () {})->name('/profesor/alumnos/asignados');
	Route::get('/alumnos/asignados/sinodal','ProfesorController@asignados_sinodal', function () {})->name('/profesor/alumnos/asignados/sinodal');
	Route::post('/alumnos/asignados/actualizar','ProfesorController@actualizar_solicitud', function () {})->name('/profesor/alumnos/asignados/actualizar');
	Route::post('/alumnos/asignados/actualizar/proyecto','ProfesorController@actualizar_proyecto', function () {})->name('/profesor/alumnos/asignados/actualizar/proyecto');
	Route::get('/alumnos/asignados/detalle/{id}','ProfesorController@alumnoD', function () {})->name('alumnoDetalle');
	//------------------ Profesor Eventos------------------------------------------//
	Route::get('/alumnos/eventos','ProfesorController@ceremonias', function () {})->name('/profesor/alumnos/eventos');
	
	//------------------ Mensajes rutas------------------------------------------//
	Route::get('/bandeja/mensajes/{name?}','ProfesorController@obtener_mensajes_pr', function () {})->name('profesor/correo/mensajes');
	Route::get('/bandeja/mensajes/nuevo/crear','ProfesorController@nuevo_mensaje_pr', function () {})->name('profesor/correo/mensajes/nuevo/crear');
	Route::post('/bandeja/mensajes/nuevo/enviar','ProfesorController@enviar_mensaje_pr', function () {})->name('profesor/correo/mensajes/nuevo/enviar');
	Route::get('/bandeja/mensajes/inbox/{id}','ProfesorController@mensajes_detalle_pr', function () {})->name('profesor/mensajeSe_Detalle');
	Route::get('/bandeja/mensajes/enviado/{id}','ProfesorController@mensajes_detalle_r_pr', function () {})->name('profesor/mensajeSe_Detalle_r');  
	Route::get('/bandeja/mensajes/enviado/detalle/{id}','ProfesorController@mensajes_detalle_r2_pr', function () {})->name('profesor/mensajeSe_Detalle_r2');  
});

//Ruta caso especial
Route::get('/storage/{archivo}', function ($archivo) {
     $public_path = public_path();
     $url = $public_path.'/storage/'.$archivo;
     //verificamos si el archivo existe y lo retornamos
     if (Storage::exists($archivo))
     {
       return response()->download($url);
     }
     //si no se encuentra lanzamos un error 404.
     abort(404);
	})->name('storage');


Route::get('/storage/{$file}', function($file){
	$public_path = public_path();
     $url = $public_path.'storage/'.$file;
     //verificamos si el archivo existe y lo retornamos
     if (Storage::exists($file))
     {
       return response()->download($url);
     }
     //si no se encuentra lanzamos un error 404.
     abort(404);
	})->name('descargar_archivo');

	

	



//Docencia CORREO Eliminar
Route::get('/docencia/correo','DocenciaController@obtener', function () {	})->name('/docencia/correo')->middleware('auth', 'role:docencia');
Route::get('/docencia/correo/mensajes','DocenciaController@obtener', function () {})->name('/docencia/correo/mensajes')->middleware('auth', 'role:docencia'); 



//Docencia   //
Route::group(['prefix' => 'docencia','middleware'=>['auth', 'role:docencia']],function() {
	Route::get('/','DocenciaController@obtener', function () {})->name('/docencia');
	
	Route::get('/perfil', function () {
		$usr_c = auth()->user()->email;
		$recibidos_ind = DB::table('chat_sistema')->where('receptor',"$usr_c")->where('estatus',"1")->latest()->take(2)->get();
		return view('docencia.perfil',compact('recibidos_ind'));
	})->name('/docencia/perfil');

	//------------------ Ceremonias------------------------------------------//
	Route::get('/alumnos/ceremonias/agregar','DocenciaController@ceremonias', function () {})->name('docencia/ceremonias');
	
	//------------------ Docencia Solicitudes------------------------------------------//
	Route::get('/alumnos/solicitudes','DocenciaController@obtener_solicitudes', function () {})->name('/docencia/alumnos/solicitudes');
	Route::get('/alumnos/solicitudes/detalle/{id}','DocenciaController@detalle_solicitud', function () {})->name('solicitudDetalle');
	Route::post('/alumnos/solicitudes/actualizar','DocenciaController@actualizar_solicitud', function () {})->name('/docencia/alumnos/solicitudes/actualizar');

	//------------------ Docencia Carreras------------------------------------------//
	Route::get('/carreras/agregar', function () {
		$usr_c = auth()->user()->email;
		$recibidos_ind = DB::table('chat_sistema')->where('receptor',"$usr_c")->where('estatus',"1")->latest()->take(2)->get();
		return view('docencia.carreras_agregar',compact('recibidos_ind'));
	})->name('/docencia/carreras/agregar');
	Route::post('/carreras/agregar/nueva','DocenciaController@agregar_carrera', function () {})->name('/docencia/carreras/agregar/nueva');
	Route::get('/carreras/modificar','DocenciaController@obtener_carreras', function () {})->name('/docencia/carreras/modificar');
	Route::post('/carreras/modificar/actualizar','DocenciaController@actualizar_carrera', function () {})->name('/docencia/carreras/modificar/actualizar');

	//------------------ Docencia Planes------------------------------------------//
	Route::get('/planes/agregar', function () {
		$usr_c = auth()->user()->email;
		$recibidos_ind = DB::table('chat_sistema')->where('receptor',"$usr_c")->where('estatus',"1")->latest()->take(2)->get();
		return view('docencia.planes_agregar',compact('recibidos_ind'));
	})->name('/docencia/planes/agregar');
	Route::post('/planes/agregar/nuevo','DocenciaController@agregar_planes', function () {})->name('/docencia/planes/agregar/nuevo');
	Route::get('/planes/modificar','DocenciaController@obtener_planes', function () {})->name('/docencia/planes/modificar');
	Route::post('/planes/modificar/actualizar','DocenciaController@actualizar_planes', function () {})->name('/docencia/planes/modificar/actualizar');

	//------------------ Docencia Profesores------------------------------------------//
	Route::get('/profesores/agregar', function () {
		$usr_c = auth()->user()->email;
		$recibidos_ind = DB::table('chat_sistema')->where('receptor',"$usr_c")->where('estatus',"1")->latest()->take(2)->get();
		return view('docencia.profesores_agregar',compact('recibidos_ind'));})->name('/docencia/profesores/agregar');
	Route::post('/profesores/agregar/nuevo','DocenciaController@agregar_profesores' ,function () {})->name('/docencia/profesores/agregar/nuevo');
	Route::get('/profesores/modificar','DocenciaController@obtener_profesores' ,function () {})->name('/docencia/profesores/modificar');
	Route::post('/profesores/modificar/actualizar','DocenciaController@actualizar_profesores' ,function () {})->name('/docencia/profesores/modificar/actualizar');
	Route::get('/profesores/solicitudes/revisores','DocenciaController@obtener_revisores', function () {})->name('/docencia/profesores/solicitudes/revisores');
	Route::get('/profesores/solicitudes/sinodales','DocenciaController@obtener_sinodales', function () {})->name('/docencia/profesores/solicitudes/sinodales');
	
	//------------------ Docencia Control de usuarios------------------------------------------//
	Route::get('/control/usuarios', function () {
		$usr_c = auth()->user()->email;
		$roles         = Role::whereIn('name', ['servicio','docencia','coordinacion_t','d_estudios_p','d_academico','coordinacion_s_e'])->get();
		$recibidos_ind = DB::table('chat_sistema')->where('receptor',"$usr_c")->where('estatus',"1")->latest()->take(2)->get();
		return view('docencia.controlUsuarios_agregar',compact('roles','recibidos_ind'));})->name('/docencia/control/usuarios');
	Route::post('/control/usuarios/nuevo','DocenciaController@agregar_usuario_rol', function () {})->name('/docencia/control/usuarios/nuevo');
	Route::get('/control/usuarios/modificar', function () {
		$roles    = Role::whereIn('name', ['servicio','docencia','coordinacion_t','d_estudios_p','d_academico','coordinacion_s_e'])->get();
		$usuarios = \DB::table('users')->join('role_user','users.id','=','role_user.user_id')->get();
		$usr_c = auth()->user()->email;
		$recibidos_ind = DB::table('chat_sistema')->where('receptor',"$usr_c")->where('estatus',"1")->latest()->take(2)->get();
		return view('docencia.controlUsuarios',compact('roles','usuarios','recibidos_ind'));})->name('/docencia/control/usuarios/modificar');
	Route::post('/control/usuarios/modificar/actualizar','DocenciaController@actualizar_usuario_rol', function () {})->name('/docencia/control/usuarios/modificar/actualizar');
	Route::get('/control/usuarios/modificar/actualizar/{id}','DocenciaController@eliminar_usuario_rol', function () {})->name('alumnoDel');
	
	//------------------ Docencia Resumen------------------------------------------//
	Route::get('/resumen','DocenciaController@resumen', function () {})->name('/docencia/resumen');
	
	//------------------ Docencia OFICIOS------------------------------------------//
	Route::get('/oficios/agregar', function () {
		$usr_c = auth()->user()->email;
		$recibidos_ind = DB::table('chat_sistema')->where('receptor',"$usr_c")->where('estatus',"1")->latest()->take(2)->get();
		return view('docencia.oficios_agregar',compact('recibidos_ind'));
	})->name('/docencia/oficios/agregar');
	Route::post('/oficios/agregar/nuevo','DocenciaController@agregar_oficio', function () {})->name('/docencia/oficios/agregar/nuevo');
	Route::get('/oficios/modificar','DocenciaController@obtener_oficios', function () {})->name('/docencia/oficios/modificar');
	Route::post('/oficios/modificar/actualizar','DocenciaController@actualizar_oficio', function () {})->name('/docencia/oficios/modificar/actualizar');
	Route::get('/oficios/generar', function () {
		$us="docencia";
		$usr_c = auth()->user()->email;
		$oficios=DB::table('oficios')->where('us_genero',"$us")->get();
		$alumnos =Solicitud::where('s_estatus',"!=","1")->get();
		$recibidos_ind = DB::table('chat_sistema')->where('receptor',"$usr_c")->where('estatus',"1")->latest()->take(2)->get();
        return view('docencia.oficios_generar',compact('oficios','recibidos_ind','alumnos'));
	})->name('/docencia/oficios/generar');
	Route::post('/oficios/imprimir','DocenciaController@construir_oficio', function () {})->name('/docencia/oficios/imprimir');
	Route::get('/oficios/obtener/formulario/{id}','DocenciaController@obtener_oficio', function () {})->name('/docencia/oficios/obtener/formulario');

	//------------------ Mensajes rutas------------------------------------------//
	Route::get('/correo/mensajes/{name?}','DocenciaController@obtener_mensajes', function () {})->name('docencia/correo/mensajes');
	Route::get('/correo/mensajes/nuevo/crear','DocenciaController@nuevo_mensaje', function () {})->name('docencia/correo/mensajes/nuevo/crear');
	Route::post('/correo/mensajes/nuevo/enviar','DocenciaController@enviar_mensaje', function () {})->name('docencia/correo/mensajes/nuevo/enviar');
	Route::get('/correo/mensajes/inbox/{id}','DocenciaController@mensajes_detalle', function () {})->name('docencia/mensajeSe_Detalle');
	Route::get('/correo/mensajes/enviado/{id}','DocenciaController@mensajes_detalle_r', function () {})->name('docencia/mensajeSe_Detalle_r');  
	Route::get('/correo/mensajes/enviado/detalle/{id}','DocenciaController@mensajes_detalle_r2', function () {})->name('docencia/mensajeSe_Detalle_r2');  
	


});

//Servicio Social  //
//Servicio Social  //

Route::group(['prefix' => 'docencia/ss','middleware'=>['auth', 'role:servicio']],function()  {
	Route::get('/','ServicioController@obtener', function () {})->name('/docencia/ss');
	
	Route::get('/perfil', function () {
		$usr_c = auth()->user()->email;
		$recibidos_ind = DB::table('chat_sistema')->where('receptor',"$usr_c")->where('estatus',"1")->latest()->take(2)->get();
		return view('servicio.perfil',compact('recibidos_ind'));
	})->name('/servicio/perfil');

	//------------------Servicio Social  Ceremonias------------------------------------------//
	Route::get('/alumnos/ceremonias/agregar','ServicioController@ceremonias', function () {})->name('/servicio/ceremonias');
	
	//------------------ Servicio Social Solicitudes------------------------------------------//
	Route::get('/alumnos/solicitudes','ServicioController@obtener_solicitudes', function () {})->name('/servicio/alumnos/solicitudes');
	Route::get('/alumnos/solicitudes/detalle/{id}','ServicioController@detalle_solicitud', function () {})->name('/servicio/solicitudDetalle');
	Route::post('/alumnos/solicitudes/actualizar','ServicioController@actualizar_solicitud', function () {})->name('/servicio/alumnos/solicitudes/actualizar');

	//------------------ Servicio SocialCarreras------------------------------------------//
	Route::get('/carreras/agregar', function () {
		$usr_c = auth()->user()->email;
		$recibidos_ind = DB::table('chat_sistema')->where('receptor',"$usr_c")->where('estatus',"1")->latest()->take(2)->get();
		return view('servicio.carreras_agregar',compact('recibidos_ind'));
	})->name('/servicio/carreras/agregar');
	Route::post('/carreras/agregar/nueva','ServicioController@agregar_carrera', function () {})->name('/servicio/carreras/agregar/nueva');
	Route::get('/carreras/modificar','ServicioController@obtener_carreras', function () {})->name('/servicio/carreras/modificar');
	Route::post('/carreras/modificar/actualizar','ServicioController@actualizar_carrera', function () {})->name('/servicio/carreras/modificar/actualizar');

	//------------------ Servicio Social Planes------------------------------------------//
	Route::get('/planes/agregar', function () {
		$usr_c = auth()->user()->email;
		$recibidos_ind = DB::table('chat_sistema')->where('receptor',"$usr_c")->where('estatus',"1")->latest()->take(2)->get();
		return view('servicio.planes_agregar',compact('recibidos_ind'));
	})->name('/servicio/planes/agregar');
	Route::post('/planes/agregar/nuevo','ServicioController@agregar_planes', function () {})->name('/servicio/planes/agregar/nuevo');
	Route::get('/planes/modificar','ServicioController@obtener_planes', function () {})->name('/servicio/planes/modificar');
	Route::post('/planes/modificar/actualizar','ServicioController@actualizar_planes', function () {})->name('/servicio/planes/modificar/actualizar');

	//------------------ Servicio Social Profesores------------------------------------------//
	Route::get('/profesores/agregar', function () {
		$usr_c = auth()->user()->email;
		$recibidos_ind = DB::table('chat_sistema')->where('receptor',"$usr_c")->where('estatus',"1")->latest()->take(2)->get();
		return view('servicio.profesores_agregar',compact('recibidos_ind'));})->name('/servicio/profesores/agregar');
	Route::post('/profesores/agregar/nuevo','ServicioController@agregar_profesores' ,function () {})->name('/servicio/profesores/agregar/nuevo');
	Route::get('/profesores/modificar','ServicioController@obtener_profesores' ,function () {})->name('/servicio/profesores/modificar');
	Route::post('/profesores/modificar/actualizar','ServicioController@actualizar_profesores' ,function () {})->name('/servicio/profesores/modificar/actualizar');
	Route::get('/profesores/solicitudes/revisores','ServicioController@obtener_revisores', function () {})->name('/servicio/profesores/solicitudes/revisores');
	Route::get('/profesores/solicitudes/sinodales','ServicioController@obtener_sinodales', function () {})->name('/servicio/profesores/solicitudes/sinodales');
	
	
	
	//------------------ Servicio Social Resumen------------------------------------------//
	Route::get('/resumen','ServicioController@resumen', function () {})->name('/servicio/resumen');
	
	//------------------ Servicio Social OFICIOS------------------------------------------//
	Route::get('/oficios/agregar', function () {
		$usr_c = auth()->user()->email;
		$recibidos_ind = DB::table('chat_sistema')->where('receptor',"$usr_c")->where('estatus',"1")->latest()->take(2)->get();
		return view('servicio.oficios_agregar',compact('recibidos_ind'));
	})->name('/servicio/oficios/agregar');
	Route::post('/oficios/agregar/nuevo','ServicioController@agregar_oficio', function () {})->name('/servicio/oficios/agregar/nuevo');
	Route::get('/oficios/modificar','ServicioController@obtener_oficios', function () {})->name('/servicio/oficios/modificar');
	Route::post('/oficios/modificar/actualizar','ServicioController@actualizar_oficio', function () {})->name('/servicio/oficios/modificar/actualizar');
	Route::get('/oficios/generar', function () {
		$us="docencia";
		$usr_c = auth()->user()->email;
		$oficios=DB::table('oficios')->where('us_genero',"$us")->get();
		$alumnos =Solicitud::where('s_estatus',"!=","1")->get();
		$recibidos_ind = DB::table('chat_sistema')->where('receptor',"$usr_c")->where('estatus',"1")->latest()->take(2)->get();
        return view('servicio.oficios_generar',compact('oficios','recibidos_ind','alumnos'));
	})->name('/servicio/oficios/generar');
	Route::post('/oficios/imprimir','ServicioController@construir_oficio', function () {})->name('/servicio/oficios/imprimir');
	Route::get('/oficios/obtener/formulario/{id}','ServicioController@obtener_oficio', function () {})->name('/servicio/oficios/obtener/formulario');

	//------------------ Servicio Social Mensajes rutas------------------------------------------//
	Route::get('/correo/mensajes/{name?}','ServicioController@obtener_mensajes', function () {})->name('/servicio/correo/mensajes');
	Route::get('/correo/mensajes/nuevo/crear','ServicioController@nuevo_mensaje', function () {})->name('/servicio/correo/mensajes/nuevo/crear');
	Route::post('/correo/mensajes/nuevo/enviar','ServicioController@enviar_mensaje', function () {})->name('/servicio/correo/mensajes/nuevo/enviar');
	Route::get('/correo/mensajes/inbox/{id}','ServicioController@mensajes_detalle', function () {})->name('/servicio/mensajeSe_Detalle');
	Route::get('/correo/mensajes/enviado/{id}','ServicioController@mensajes_detalle_r', function () {})->name('/servicio/mensajeSe_Detalle_r');  
	Route::get('/correo/mensajes/enviado/detalle/{id}','ServicioController@mensajes_detalle_r2', function () {})->name('/servicio/mensajeSe_Detalle_r2');  
	


});


/*
Route::group(['prefix' => 'docencia/ss','middleware'=>['auth', 'role:servicio']],function() {

	Route::get('/','ServicioController@index', function () {})->name('/ss');
	Route::get('/perfil', function () {return view('servicio.perfil');})->name('/docencia/ss/perfil');
	//------------------ Solicitudes------------------------------------------//
	Route::get('/solicitudes','ServicioController@obtener_solicitudes', function () {})->name('/docencia/ss/solicitudes');
	Route::get('/solicitudes/detalle/{id}','ServicioController@detalle_solicitud', function () {})->name('detalleSS');
	Route::post('/solicitudes/actualizar','ServicioController@actualizar_solicitud', function () {})->name('/docencia/ss/solicitudes/actualizar');
	//------------------ Profesores------------------------------------------//
	Route::get('/profesores/revisores','ServicioController@obtener_revisores', function () {})->name('/docencia/ss/profesores/revisores');
	Route::get('/profesores/sinodales','ServicioController@obtener_sinodales', function () {})->name('/docencia/ss/profesores/sinodales');
	
});

*/

//Coordinacion de Titulaciones //

Route::group(['prefix' => 'coordinacion/titulaciones','middleware' => ['auth', 'role:coordinacion_t']],function() {
	Route::get('/','CoordinacionTitulacionesController@index', function () {})->name('/coordinacion/titulaciones');
	Route::get('/perfil','CoordinacionTitulacionesController@perfil', function () {})->name('/coordinacion/titulaciones/perfil');
	
	//------------------ Solicitudes------------------------------------------//
	Route::get('/alumnos/solicitudes','CoordinacionTitulacionesController@solicitudes', function () {})->name('/coordinacion/titulaciones/alumnos/solicitudes');
	Route::get('/alumnos/solicitudes/detalle/{id}','CoordinacionTitulacionesController@solicitudes_detalles', function () {})->name('detalleCT');
	Route::post('/alumnos/solicitudes/actualizar','CoordinacionTitulacionesController@actualizar_documentacion', function () {})->name('actualizar_documentacion');
	
	//------------------ Ceremonias------------------------------------------//
	Route::get('/alumnos/ceremonias/agregar','CoordinacionTitulacionesController@ceremonias', function () {})->name('ceremonia_agregar');
	Route::post('/alumnos/ceremonias/agregar/nuevo','CoordinacionTitulacionesController@ceremonia_nuevo', function () {})->name('ceremonia_nuevo');
	Route::post('/alumnos/ceremonias/modificar/actualizar','CoordinacionTitulacionesController@ceremonia_actualizar', function () {})->name('/coordinacion/titulaciones/alumnos/ceremonias/modificar/actualizar');
	
	//------------------ Documentos------------------------------------------//
	Route::get('/documentos/agregar','CoordinacionTitulacionesController@doc_agregar', function () {})->name('/coordinacion/titulaciones/documentos/agregar');
	Route::post('/documentos/agregar/nuevo','CoordinacionTitulacionesController@documentos_nuevo', function () {})->name('/docencia/documentos/agregar/nuevo');
	Route::get('/documentos/modificar','CoordinacionTitulacionesController@documentos_obtener', function () {})->name('/coordinacion/titulaciones/documentos/modificar');
	Route::post('/documentos/modificar/actualizar','CoordinacionTitulacionesController@documentos_actualizar', function () {})->name('/coordinacion/titulaciones/documentos/modificar/actualizar');
	
	//------------------ Salas------------------------------------------//
	Route::get('/salas/agregar', function () {
		$usr_c = auth()->user()->email;
        $recibidos_ind = DB::table('chat_sistema')->where('receptor',"$usr_c")->where('estatus',"1")->latest()->take(2)->get();
		return view('coordinacion_t.salas_agregar',compact('recibidos_ind'));
	})->name('/coordinacion/titulaciones/salas/agregar');
	
	Route::get('/salas/modificar','CoordinacionTitulacionesController@sala_obtener', function () {})->name('/coordinacion/titulaciones/salas/modificar');
	Route::post('/salas/modificar/actualizar','CoordinacionTitulacionesController@sala_actualizar', function () {})->name('/coordinacion/titulaciones/salas/modificar/actualizar');
	Route::post('/salas/nuevo','CoordinacionTitulacionesController@sala_nuevo', function () {})->name('/docencia/documentos/salas/nuevo');
	
	//------------------ Oficios------------------------------------------//
	Route::get('/oficios/agregar', function () {
		$usr_c = auth()->user()->email;
		$recibidos_ind = DB::table('chat_sistema')->where('receptor',"$usr_c")->where('estatus',"1")->latest()->take(2)->get();
		return view('coordinacion_t.oficios_agregar',compact('recibidos_ind'));})->name('/coordinacion/titulaciones/oficios/agregar');
	Route::post('/oficios/agregar/nuevo','CoordinacionTitulacionesController@agregar_oficio', function () {})->name('/coordinacion/titulaciones/oficios/agregar/nuevo');
	Route::get('/oficios/modificar','CoordinacionTitulacionesController@obtener_oficios', function () {})->name('/coordinacion/titulaciones/oficios/modificar');
	Route::post('/oficios/modificar/actualizar','CoordinacionTitulacionesController@actualizar_oficio', function () {})->name('/coordinacion/titulaciones/oficios/modificar/actualizar');
	Route::get('/oficios/generar', function () {
		$us="coordinacion";
		$usr_c = auth()->user()->email;
		$oficios=DB::table('oficios')->where('us_genero',"coordinacion_t")->where('estatus',"1")->get();
		$alumnos =Solicitud::all();
		$salas = DB::table('sala_eventos')->where('disponibilidad',"1")->orderBy('created_at', 'ASC')->get();
		$recibidos_ind = DB::table('chat_sistema')->where('receptor',"$usr_c")->where('estatus',"1")->latest()->take(2)->get();
        return view('coordinacion_t.oficios_generar',compact('oficios','recibidos_ind','alumnos','salas'));
	})->name('/coordinacion/titulaciones/oficios/generar');
	Route::get('/oficios/obtener/formulario/{id}','DocenciaController@obtener_oficio', function () {})->name('/coordinacion/oficios/obtener/formulario');

	Route::post('/oficios/imprimir','CoordinacionTitulacionesController@construir_oficio', function () {})->name('/coordinacion/oficios/imprimir');


	//------------------ Mensajes rutas------------------------------------------//
	Route::get('/correo/mensajes/{name?}','CoordinacionTitulacionesController@obtener_mensajes', function () {})->name('coordinacion/titulaciones/correo/mensajes');
	Route::get('/correo/mensajes/nuevo/crear','CoordinacionTitulacionesController@nuevo_mensaje', function () {})->name('coordinacion/titulaciones/correo/mensajes/nuevo/crear');
	Route::post('/correo/mensajes/nuevo/enviar','CoordinacionTitulacionesController@enviar_mensaje', function () {})->name('coordinacion/titulaciones/correo/mensajes/nuevo/enviar');
	Route::get('/correo/mensajes/inbox/{id}','CoordinacionTitulacionesController@mensajes_detalle', function () {})->name('coordinacion/titulaciones/mensajeSe_Detalle');
	Route::get('/correo/mensajes/enviado/{id}','CoordinacionTitulacionesController@mensajes_detalle_r', function () {})->name('coordinacion/titulaciones/mensajeSe_Detalle_r');  
	Route::get('/correo/mensajes/enviado/detalle/{id}','CoordinacionTitulacionesController@mensajes_detalle_r2', function () {})->name('coordinacion/titulaciones/mensajeSe_Detalle_r2');  

});

//Coordinacion de Servicios escolares

Route::group(['prefix' => 'coordinacion/servicios_es','middleware' => ['auth', 'role:coordinacion_s_e']],function() {
	Route::get('/','ServiciosEscolaresController@index', function () {})->name('/coordinacion/servicios_es');
	Route::get('/perfil','ServiciosEscolaresController@perfil', function () { })->name('/coordinacion/servicios_es/perfil');
	//------------------ Solicitudes------------------------------------------//
	Route::get('/alumnos/solicitudes','ServiciosEscolaresController@solicitudes', function () {})->name('/coordinacion/servicios_es/alumnos/solicitudes');
	Route::get('/alumnos/solicitudes/detalle/{id}','ServiciosEscolaresController@detalle_solicitud', function () {})->name('solicitudDetalleCSE');
	Route::post('/alumnos/solicitudes/actualizar','ServiciosEscolaresController@actualizar_solicitud', function () {})->name('/coordinacion/servicios_es/alumnos/solicitudes/actualizar');
	//------------------ Mensajes rutas------------------------------------------//
	Route::get('/correo/mensajes/{name?}','ServiciosEscolaresController@obtener_mensajes', function () {})->name('/coordinacion/servicios_es/correo/mensajes');
	Route::get('/correo/mensajes/nuevo/crear','ServiciosEscolaresController@nuevo_mensaje', function () {})->name('/coordinacion/servicios_es/correo/mensajes/nuevo/crear');
	Route::post('/correo/mensajes/nuevo/enviar','ServiciosEscolaresController@enviar_mensaje', function () {})->name('/coordinacion/servicios_es/correo/mensajes/nuevo/enviar');
	Route::get('/correo/mensajes/inbox/{id}','ServiciosEscolaresController@mensajes_detalle', function () {})->name('/coordinacion/servicios_es/mensajeSe_Detalle');
	Route::get('/correo/mensajes/enviado/{id}','ServiciosEscolaresController@mensajes_detalle_r', function () {})->name('/coordinacion/servicios_es/mensajeSe_Detalle_r');  
	Route::get('/correo/mensajes/enviado/detalle/{id}','ServiciosEscolaresController@mensajes_detalle_r2', function () {})->name('/coordinacion/servicios_es/mensajeSe_Detalle_r2');  
});



//Division de Estudios Profesionales

Route::group(['prefix' => 'division/profesionales','middleware' => ['auth', 'role:d_estudios_p']],function() {
	Route::get('/', function () { return view('division_es_profesionales.index');})->name('/division/profesionales');
	Route::get('/perfil','ServiciosEscolaresController@perfil', function () {return view('coordinacion_serv_escolares.perfil'); })->name('division/profesionales/perfil');
	//------------------ Mensajes rutas------------------------------------------//
	Route::get('/correo/mensajes/{name?}','ServiciosEscolaresController@obtener_mensajes', function () {})->name('division/profesionales/correo/mensajes');
	Route::get('/correo/mensajes/nuevo/crear','ServiciosEscolaresController@nuevo_mensaje', function () {})->name('division/profesionales/correo/mensajes/nuevo/crear');
	Route::post('/correo/mensajes/nuevo/enviar','ServiciosEscolaresController@enviar_mensaje', function () {})->name('division/profesionales/correo/mensajes/nuevo/enviar');
	Route::get('/correo/mensajes/inbox/{id}','ServiciosEscolaresController@mensajes_detalle', function () {})->name('division/profesionales/mensajeSe_Detalle');
	Route::get('/correo/mensajes/enviado/{id}','ServiciosEscolaresController@mensajes_detalle_r', function () {})->name('division/profesionales/mensajeSe_Detalle_r');  
	Route::get('/correo/mensajes/enviado/detalle/{id}','ServiciosEscolaresController@mensajes_detalle_r2', function () {})->name('division/profesionales/mensajeSe_Detalle_r2');  
});

//JEFE de Departamento Academico

Route::group(['prefix' => 'departamento/academico','middleware' => ['auth', 'role:d_academico']],function() {
	Route::get('/', function () {return view('departamento_academico.index');})->name('/departamento/academico');
	Route::get('/perfil','ServiciosEscolaresController@perfil', function () {return view('coordinacion_serv_escolares.perfil'); })->name('departamento/academico/servicios_es/perfil');
	//------------------ Mensajes rutas------------------------------------------//
	Route::get('/correo/mensajes/{name?}','ServiciosEscolaresController@obtener_mensajes', function () {})->name('departamento/academico/correo/mensajes');
	Route::get('/correo/mensajes/nuevo/crear','ServiciosEscolaresController@nuevo_mensaje', function () {})->name('departamento/academico/correo/mensajes/nuevo/crear');
	Route::post('/correo/mensajes/nuevo/enviar','ServiciosEscolaresController@enviar_mensaje', function () {})->name('departamento/academico/correo/mensajes/nuevo/enviar');
	Route::get('/correo/mensajes/inbox/{id}','ServiciosEscolaresController@mensajes_detalle', function () {})->name('departamento/academico/mensajeSe_Detalle');
	Route::get('/correo/mensajes/enviado/{id}','ServiciosEscolaresController@mensajes_detalle_r', function () {})->name('departamento/academico/mensajeSe_Detalle_r');  
	Route::get('/correo/mensajes/enviado/detalle/{id}','ServiciosEscolaresController@mensajes_detalle_r2', function () {})->name('departamento/academico/mensajeSe_Detalle_r2');  
});





Route::get('/home', 'HomeController@index')->name('home');
