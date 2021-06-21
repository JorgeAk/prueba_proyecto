<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    //Aqui redireccionamos a cada usuario dependiendo de su ROL
        public function authenticated()
        {
            if(auth()->user()->hasRole('alumno'))
            {
                return redirect('/alumnos');
            }else{
                if(auth()->user()->hasRole('profesor')){
                    return redirect('/profesor');
                }else{
                    if(auth()->user()->hasRole('admin')){
                        return redirect('/admin');
                    }
                    if(auth()->user()->hasRole('docencia')){
                        return redirect('/docencia');
                    }else{
                        if(auth()->user()->hasRole('d_academico')){
                            return redirect('/academico');
                        }else{
                            if(auth()->user()->hasRole('coordinacion_t')){
                            return redirect('/coordinacion/titulaciones');
                        }else{
                            if(auth()->user()->hasRole('d_estudios_p')){
                                return redirect('/estudios_profesionales');
                            }else{
                                if(auth()->user()->hasRole('coordinacion_s_e')){
                                    return redirect('coordinacion/servicios_es');
                                }else{
                                    if(auth()->user()->hasRole('servicio')){
                                        return redirect('/docencia/ss');
                                    }  
                                }
                            }
                        }
                        }
                    }
                }
            return redirect('/home');
        }

    }

    public function username()
{
    return 'username';
}
}
