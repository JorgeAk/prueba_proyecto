@extends('layouts.cabeceraDc')

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
          <i class="fa fa-dashboard"></i> Docencia/Planes<STRONG>/Agregar</STRONG>
        </li>
      </ol>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
    </div>
    @if(Session::has('message'))
    <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      {{Session::get('message')}}
    </div>
    @endif
    <div class="card-body">
      <div class="row">
        <div class="col-md-12 register-right">
          <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist"></ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active table-responsive" id="home" role="tabpanel" aria-labelledby="home-tab">
              <br>
              <table id="example" class="table table-striped jambo_table ">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Año</th>
                    <th scope="col">Editar</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($planes as $plan)
                  <tr class="centrar">
                    <td scope="row">{{$plan->id}}</td>
                    <td>{{$plan->nombre}}</td>
                    <td>{{$plan->anio}}</td>
                    <td><a href="#" class="btn btn-lg btn-success btn-sm" data-toggle="modal" data-target="#M{{$plan->id}}">Ver</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              @foreach ($planes as $plan)
              <!-- basic modal -->
              <div class="modal fade" id="M{{$plan->id}}" tabindex="-1" role="dialog" aria-labelledby="M" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel">Datos del Plan</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form id="demo-form2" method="POST" action="{{ route('/docencia/planes/modificar/actualizar') }}" class="form-horizontal form-label-left">
                        @csrf
                        <input hidden type="text" id="first-name" name="id_plan" value="{{$plan->id}}" required class="form-control ">
                        <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 ">
                            <input type="text" id="first-name" name="nombre" placeholder="{{$plan->nombre}}" class="form-control ">
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Año <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 ">
                            <input type="text" id="last-name" name="anio" placeholder="{{$plan->anio}}" class="form-control">
                          </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="item form-group">
                          <div class="col-md-6 col-sm-6 offset-md-5">
                            <button type="submit" class="btn btn-success">Actualizar</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- basic modal -->
              @endforeach
            </div>
          </div>
        </div>
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