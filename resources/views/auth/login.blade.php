@extends('layouts.cabeceraLogin')

@section('content')
<div id="main-container" class="container-fluid single-page">
  <div class="middle-panel-login">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <div class="row">
          <div class="col-sm-2 col-sm-offset-5 col-xs-4 col-xs-offset-4">
            <img src="{{asset('/res/recurso/sge_white.png') }}" alt="SGE" class="img-responsive">
          </div>
        </div>
        <br>
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="panel panel-default">
            <div class="panel-heading image text-center">
              <img src="{{asset('/res/recurso/tnm.png') }}" alt="Logo Tec" class="img-heading hidden-xs">
              <h3 class="panel-title"> Instituto Tecnológico de Morelia</h3>
              <img src="{{asset('/res/recurso/zpHB68Mn9ybbH7l9JuRsVwOpxeDW25rmC5cMVEeQ.png') }}" alt="Logo Tec" class="img-heading hidden-xs">
            </div>
            <div class="panel-body">
              <p class="text-center">Bienvenido al Sistema de Gestión Escolar, por favor selecciona la opción de acuerdo a tus actividades.</p>
              <br>
              <ul class="nav nav-pills nav-center">
                <li role="presentation" class="active">
                  <a href="{{ route('login') }}">Inicio</a>
                </li>
                <li role="presentation"><a href="{{ route('/login/administrativo') }}">Personal del Instituto</a></li>
                <li role="presentation" >
                  <a href="{{ route('/login/alumno') }}">Alumno</a>
                </li>
                <li role="presentation"><a href="{{ route('/login/profesor') }}">Profesor</a>
                </li>
              </ul>
              <br>  
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
