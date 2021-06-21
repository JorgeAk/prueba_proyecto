@extends('layouts.cabeceraDc')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
  <div>
    <div class="col-lg-12">
      <h1 class="page-header">
        Panel <small>Proyecto Docencia Profesores</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active">
          <i class="fa fa-dashboard"></i> Alumnos/<STRONG>Solicitudes</STRONG>
        </li>
      </ol>
    </div>
  </div>
  <div class="card">

    <div class="card-header"><h4>Lista de profesores asignados como revisores</h4></div>
    @if(Session::has('message'))
    <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      {{Session::get('message')}}
    </div>
    @endif
    <div class="card-body">
      <!-- table -->
      <div class="row">
        <div class="col-md-12 register-right">
          <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist"></ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active table-responsive" id="home" role="tabpanel" aria-labelledby="home-tab">
              <br>
              <table id="example" class="table table-striped jambo_table ">
                <thead>
                  <tr>
                    <th scope="col"># RFC</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido Paterno</th>
                    <th scope="col">Apellido Materno</th>
                    <th scope="col">Alumno Asignado</th>
                    <th scope="col">Estatus</th>
                    <th scope="col">Notificar por correo</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($revisores as $rev)
                  <tr class="centrar">
                    @foreach ($profesores as $profe)
                        @if ($rev->id_profesor == $profe->id)
                        <td>{{$profe->rfc}}</td>
                        <td>{{$profe->p_nombre}} {{$profe->s_nombre}}</td>
                        <td>{{$profe->a_paterno }}</td>
                        <td>{{$profe->a_materno }}</td>
                        @endif
                    @endforeach
                    @foreach ($alumno as $alum)
                    @if ($rev->id_solicitud == $alum->id)
                    <td>{{$alum->n_control}}</td>
                    @endif
                    @endforeach
                    @foreach ($estatus as $est)
                    @if ($rev->id_estatus == $est->id)
                    <td>{{$est->nombre}}</td>  
                    @endif 
                    @endforeach
                    @foreach ($profesores as $profe)
                        @if ($rev->id_profesor == $profe->id)
                        <td><a class="btn btn-sm btn-default fa fa-envelope-square fa-3x" href="mailto: {{$profe->correo}}"></a></td>
                        
                        @endif
                    @endforeach
                  </tr>
                  @endforeach
                </tbody>
              </table>
              
            </div>
          </div>
        </div>
      </div>
      <!-- /table-->
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