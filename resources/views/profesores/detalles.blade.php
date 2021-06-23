@extends('layouts.cabeceraPr')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
  <div>
    <div class="col-lg-12">
      <h1 class="page-header">
        Panel <small>Proyecto Docencia </small>
      </h1>
      <ol class="breadcrumb">
        <li class="active">
          <i class="fa fa-dashboard"></i> Profesor/Alumno/Solicitud/<STRONG>Detalle</STRONG>
        </li>
      </ol>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h5>Solicitud Titulación</h5>
    </div>
    <div class="card-body">
      @if (count($alumno))
      <div class="row">
        <div class="col-md-12 register-right">
          <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist"></ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active table-responsive" id="home" role="tabpanel" aria-labelledby="home-tab">
              <table class="table table-striped jambo_table ">
                <table class="table table-bordered table-hover table-striped ">
                  <thead>
                  </thead>
                  <tbody>
                    @foreach ($alumno as $alum)
                    <tr class="centrar">
                      <th>Nombre</th>
                      <td>{{ $alum->p_nombre}}</td>
                    </tr>
                    <tr class="centrar">
                      <th>Carrera</th>
                      @foreach ($carreras as $carr)
                      @if ($carr->id == $alum->id_carrera)
                      <td>{{ $carr->nombre }}</td>
                      @endif
                      @endforeach
                    </tr>
                    <tr class="centrar">
                      <th>Nombre del proyecto</th>
                      <td>{{$alum->n_proyecto}}</td>
                    </tr>
                    <tr class="centrar">
                      <th>Proyecto PDF</th>
                      <td><a href="{{ route('storage',$alum->proy_archivo)}}" download="proyecto_{{$alum->n_control}}.pdf" class="btn btn-success"> <i class="fa fa-cloud-download"></i>&nbsp;&nbsp;<i class="fa fa-file-pdf-o"></i> Descargar</a></td>
                    </tr>
                    <tr class="centrar">
                      <th>Opciones</th>
                      <td><a href="{{ route('/profesor/mensajes') }}" class="btn btn-success "> <i class="fa fa-envelope"></i> Enviar mensaje</a>
                      </td>
                    </tr>
                    <tr class="centrar">
                      <th>Aprobar proyecto de titulacion</th>
                      <td>
                        <a href="#" class="btn btn-lg btn-success btn-sm" data-toggle="modal" data-target="#basicAcept{{$alum->id}}">Aceptar</a>
                        <a href="#" class="btn btn-lg btn-danger btn-sm" data-toggle="modal" data-target="#basicCancel{{$alum->id}}">Rechazar</a>
                      </td>
                    </tr>
                    <!-- basic modalAcept -->
                    <div class="modal fade" id="basicAcept{{$alum->id}}" tabindex="-1" role="dialog" aria-labelledby="basicAcept" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <h4>¿Desea aprobar el proyecto de titulacion?</h4>
                            <h5>Proyecto: {{$alum->n_proyecto}}</h5>
                            <h5>Alumno: {{$alum->p_nombre}} {{$alum->s_nombre}} {{$alum->a_paterno}} {{$alum->a_materno}}</h5>
                            <h5>N° Control :{{$alum->n_control}}</h5>
                            <h4>No podra volver a cambiarlo de nuevo</h4>
                            <form class="" method="POST" action="{{ route('/profesor/alumnos/asignados/actualizar/proyecto') }}">
                              @csrf
                              <input hidden type="text" id="last-name" name="aceptar_proyecto" value="si" class="form-control">
                              <input hidden type="text" id="last-name" name="solicitud" value="{{$alum->id}}" class="form-control">
                              <button type="submit" class="btn btn-success btn-block">Confirmar</button>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- basic modalCancel -->
                    <div class="modal fade" id="basicCancel{{$alum->id}}" tabindex="-1" role="dialog" aria-labelledby="basicCancel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <h4>¿Desea dar como no aprobado el proyecto de titulacion?</h4>
                            <h5>Proyecto: {{$alum->n_proyecto}}</h5>
                            <h5>Alumno: {{$alum->p_nombre}} {{$alum->s_nombre}} {{$alum->a_paterno}} {{$alum->a_materno}}</h5>
                            <h5>N° Control :{{$alum->n_control}}</h5>
                            <h4>No podra volver a cambiarlo de nuevo</h4>
                            <form class="" method="POST" action="{{ route('/profesor/alumnos/asignados/actualizar/proyecto') }}">
                              @csrf
                              <input hidden type="text" id="last-name" name="rechazar_proyecto" value="si" class="form-control">
                              <input hidden type="text" id="last-name" name="solicitud" value="{{$alum->id}}" class="form-control">
                              <button type="submit" class="btn btn-success btn-block">Confirmar</button>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endforeach
                  </tbody>
                </table>
                <form class="" method="POST" enctype="multipart/form-data" action="{{ route('/docencia/alumnos/solicitudes/actualizar') }}">
                  @csrf
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @else
  @if(Session::has('message'))
  <div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    {{Session::get('message')}}
  </div>
  @endif
  @endif
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