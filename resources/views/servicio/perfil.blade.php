@extends('layouts.cabeceraSS')

@section('content')
<div class="right_col" role="main">
  <div class="col-lg-12">
    <h1 class="page-header">
      Panel <small>Proyecto Docencia</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active">
        <i class="fa fa-dashboard"></i> Servicio/<STRONG>Perfil</STRONG>
      </li>
    </ol>
  </div>
  <div class="">
    <div class="">
      <div class="card">
        <div class="card-header ">
          <h4>Ver Perfil</h4>
        </div>
        <div class="card-body">
          <div class="row justify-content-center">
            <img class="img-thumbnail img-circle " width="125" height="125" src="{{asset('/res/imagen/default.png') }}">
          </div>
          <div class="row justify-content-center">
            <a class="btn btn-sm btn-default fa fa-envelope-square fa-3x" href='mailto:"{{ Auth::user()->email }}"'></a>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped ">
              <thead>
              </thead>
              <tbody>
                <tr class="centrar">
                  <th>Nombre</td>
                  <td>{{ Auth::user()->name }}</td>
                </tr>
                <tr class="centrar">
                  <th>Correo</th>
                  <td>{{ Auth::user()->email }}</td>
                </tr>
                <tr class="centrar">
                  <th>Telefono</th>
                  <td>01-800</td>
                </tr>
                <tr class="centrar">
                  <th>Se creo</th>
                  <td>{{ Auth::user()->created_at }}</td>
                </tr>
                <tr class="centrar">
                  <th>Opciones</th>
                  <td>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!-- Añadir personal -->
      </div>
    </div>
  </div>
</div>
<!-- footer content -->
<footer>
  <div class="pull-right">
    Titulacion SGE by <a href="">IT Morelia</a>
  </div>
  <div class="clearfix"></div>
</footer>
<!-- /footer content -->

@endsection