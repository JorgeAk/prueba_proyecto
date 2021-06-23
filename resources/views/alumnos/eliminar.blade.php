@extends('layouts.cabecera')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div>
    <div class="col-lg-12">
      <h1 class="page-header">
        Panel <small>Proyecto Docencia</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active">
          <i class="fa fa-dashboard"></i> Alumno/Solicitud<STRONG>/Eliminar</STRONG>
        </li>
      </ol>
    </div>
  </div>
  <div class="">
    <div class="card text-center ">
      <div class="card-header ">
        <h5>Solicitud Titulación</h5>
        @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          {{Session::get('message')}}
        </div>
        @endif
      </div>
      <div class="card-body">
        @if ($estatus->count())
        @foreach ($estatus as $alum)
        @if ($alum->s_estatus=="1")

        <h4>¿Deseas eliminar tu solicitud?</h4>

        <a href="{{ route('/alumnos/solicitud/eliminar/del') }}">
          <button type="submit" class="btn btn-outline-danger">Elimina</button>
        </a>
        @else
        <div align="center">
          <h4>Tu solicitud ya fue enviada no es posible Eliminarla</h4>

        </div>
        @endif
        @endforeach
        @else
        <div align="center">
          <h4>¿Deseas generar tu solicitud?</h4>
          <a href="{{ route('/alumnos/solicitud/generar') }}">
            <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generar</button>
          </a>
        </div>
        @endif

      </div>
    </div>
  </div>
</div>
<!-- /page content -->
<!-- footer content -->
<footer>
  <div class="pull-right">
    Titulacion SGE by <a href="">IT Morelia</a>
  </div>
  <div class="clearfix"></div>
</footer>
<!-- /footer content -->
@endsection