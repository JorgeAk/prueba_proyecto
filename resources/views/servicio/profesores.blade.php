@extends('layouts.cabeceraSS')

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
          <i class="fa fa-dashboard"></i> Servicio/Profesor<STRONG>/Modificar</STRONG>
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
                                                <th scope="col">Apellido Paterno</th>
                                                <th scope="col">Apellido Materno</th>
                                                <th scope="col">Correo</th>
                                                <th scope="col">Celular</th>
                                                <th scope="col">Departamento</th>
                                                <th scope="col">Estatus</th>
                                                <th scope="col">Editar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($profesores as $profe) 
                                            <tr class="centrar">
                                                <td scope="row">{{$profe->rfc}}</td>
                                                <td>{{$profe->p_nombre}} {{$profe->s_nombre}}</td>
                                                <td>{{$profe->a_paterno}}</td>
                                                <td>{{$profe->a_materno}}</td>
                                                <td>{{$profe->correo}}</td>
                                                <td>{{$profe->celular}}</td>
                                                <td>{{$profe->departamento}}</td>
                                                @if ($profe->estatus==1)
                                                <td>Activo</td>
                                                @else
                                                <td>Inactivo</td>
                                                @endif
                                                <td><a href="#" class="btn btn-lg btn-success btn-sm" data-toggle="modal" data-target="#Modal_profe{{$profe->id}}">Ver</a>
                                                </td>
                                                </tr>
                                                @endforeach 
                                            </tbody>
                                        </table>
                                        @foreach ($profesores as $profe) 
                                        <!-- basic modal -->
                                        <div class="modal fade" id="Modal_profe{{$profe->id}}" tabindex="-1" role="dialog" aria-labelledby="Modal_profe" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">Datos del Profesor</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="demo-form2" method="POST" action="{{ route('/servicio/profesores/modificar/actualizar') }}"  class="form-horizontal form-label-left" > 
                                                            @csrf

                                                            <input hidden type="text" id="last-name" name="username"  value="{{$profe->rfc}}"  class="form-control">
                                      
                                                            <div class="item form-group">
                                                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre<span class="required">*</span>
                                                              </label>
                                                              <div class="col-md-6 col-sm-6 ">
                                                                <input type="text" id="first-name" name="p_nombre"  class="form-control " placeholder="{{$profe->p_nombre}}"  autofocus>
                                                              </div>
                                                            </div>
                                                            <div class="item form-group">
                                                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Segundo Nombre<span class="required"></span>
                                                              </label>
                                                              <div class="col-md-6 col-sm-6 ">
                                                                <input type="text" id="first-name" name="s_nombre" placeholder="{{$profe->s_nombre}}"  class="form-control ">
                                                              </div>
                                                            </div>
                                                            <div class="item form-group">
                                                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Apellido Paterno <span class="required">*</span>
                                                              </label>
                                                              <div class="col-md-6 col-sm-6 ">
                                                                <input type="text" id="last-name" name="a_paterno" placeholder="{{$profe->a_paterno}}"  class="form-control">
                                                              </div>
                                                            </div>
                                                            <div class="item form-group">
                                                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Apellido Materno <span class="required">*</span>
                                                              </label>
                                                              <div class="col-md-6 col-sm-6 ">
                                                                <input type="text" id="last-name" name="a_materno" placeholder="{{$profe->a_materno}}" class="form-control">
                                                              </div>
                                                            </div>
                                                            <div class="item form-group">
                                                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">RFC <span class="required">*</span>
                                                              </label>
                                                              <div class="col-md-6 col-sm-6 ">
                                                                <input type="text" id="last-name" name="rfc" placeholder="{{$profe->rfc}}"  class="form-control">
                                                              </div>
                                                            </div>
                                                            <div class="item form-group">
                                                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Correo <span class="required">*</span>
                                                              </label>
                                                              <div class="col-md-6 col-sm-6 ">
                                                                <input type="email" id="last-name" name="correo" placeholder="{{$profe->correo}}"  class="form-control">
                                                              </div>
                                                            </div>
                                                            <div class="item form-group">
                                                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Celular <span class="required">*</span>
                                                              </label>
                                                              <div class="col-md-6 col-sm-6 ">
                                                                <input type="tel" id="last-name" name="celular" placeholder="{{$profe->celular}}"  class="form-control">
                                                              </div>
                                                            </div>
                                                            <div class="item form-group">
                                                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Departamento <span class="required">*</span>
                                                              </label>
                                                              <div class="col-md-6 col-sm-6 ">
                                                                <input type="text" id="last-name" name="departamento" placeholder="{{$profe->departamento}}"  class="form-control">
                                                              </div>
                                                            </div>
                                                            <div class="item form-group">
                                                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Contraseña <span class="required">*</span>
                                                              </label>
                                                              <div class="col-md-6 col-sm-6 ">
                                                                <input type="password" id="last-name" name="password"  class="form-control">
                                                                <small class="text-danger">*Si no deseas modificar la contraseña no escribas nada</small>
                                                              </div>
                                                            </div>
                                                            <div class="item form-group radio">
                                                                  <label class="col-form-label col-md-3 col-sm-3 label-align">
                                                                    Estatus <span class="required">*</span>
                                                                  </label>
                                                                  <label class="col-form-label col-md-3  ">
                                                                      @if ($profe->estatus==1)
                                                                      <input type="radio" checked value="1" id="optionsRadios1" name="estatus"> ACTIVO
                                                                      <br>
                                                                      <input type="radio" value="0" id="optionsRadios2" name="estatus"> INACTIVO 
                                                                      @else
                                                                      <input type="radio"  value="1" id="optionsRadios1" name="estatus"> ACTIVO
                                                                      <br>
                                                                      <input type="radio" checked value="0" id="optionsRadios2" name="estatus"> INACTIVO 
                                                                      @endif
                                                                  </label>
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
                                        <!-- END basic modal -->
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
    Titulacion SGE  by <a href="">IT Morelia</a>
  </div>
  <div class="clearfix"></div>
</footer>
<!-- /footer content -->

@endsection
