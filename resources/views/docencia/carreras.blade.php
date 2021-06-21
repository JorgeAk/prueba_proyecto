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
          <i class="fa fa-dashboard"></i> Docencia/Carreras<STRONG>/Modificar</STRONG>
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
                                                <th scope="col">Estatus</th>
                                                <th scope="col">Editar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($carreras as $carr)
                                            <tr class="centrar">
                                                
                                                <td>{{{$carr->id}}}</td>
                                                <td scope="row">{{$carr->nombre}}</td>
                                                @if ($carr->estatus==1)
                                                <td>Activo</td>
                                                @else 
                                                <td>Inactivo</td>
                                                @endif
                                                <td><a href="#" class="btn btn-lg btn-success btn-sm" data-toggle="modal" data-target="#M{{$carr->id}}">Ver</a>
                                                </td>
                                                
                                                
                                            </tr>
                                            @endforeach
                                                
                                            </tbody>
                                        </table>
                                        @foreach ($carreras as $carr)
                                        <!-- basic modal -->
                                        <div class="modal fade" id="M{{$carr->id}}" tabindex="-1" role="dialog" aria-labelledby="M" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">Datos del la carrera</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="demo-form2"  method="POST" action="{{ route('/docencia/carreras/modificar/actualizar') }}" class="form-horizontal form-label-left" >
                                                            @csrf
                                                            <input hidden type="text" id="first-name" name="id_carrera" value="{{$carr->id}}" class="form-control ">
                                      
                                                            <div class="item form-group">
                                                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre<span class="required">*</span>
                                                              </label>
                                                              <div class="col-md-6 col-sm-6 ">
                                                                <input type="text" id="first-name" name="nombre" placeholder="{{$carr->nombre}}"  class="form-control ">
                                                              </div>
                                                            </div>
                                                            <div class="item form-group radio">
                                                              <label class="col-form-label col-md-3 col-sm-3 label-align">
                                                                Estatus <span class="required">*</span>
                                                              </label>
                                                              <label class="col-form-label col-md-3  ">
                                                                @if ($carr->estatus==1)
                                                                <input type="radio" checked value="1" id="optionsRadios1" name="estatus"> ACTIVO <br>
                                                                <input type="radio" value="0" id="estatus" name="estatus"> INACTIVO
                                                                @else 
                                                                <input type="radio"  value="1" id="optionsRadios1" name="estatus"> ACTIVO <br>
                                                                <input type="radio" checked value="0" id="estatus" name="estatus"> INACTIVO
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

                                        <!-- basic modal -->
                                        @endforeach
                                       

                                        <!-- basic modalAcept -->
                                        <div class="modal fade" id="basicAcept" tabindex="-1" role="dialog" aria-labelledby="basicAcept" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">Nombre</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h3>¿Desea Recibir el proyecto?, No podra volver a cambiarlo de nuevo</h3>
                                                        <p></p>
                                                        <form>
                                                            
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                        <button type="button" class="btn btn-primary">Aceptar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- basic modalCancel -->
                                        <div class="modal fade" id="basicCancel" tabindex="-1" role="dialog" aria-labelledby="basicCancel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h3>¿Desea no recibir el proyecto?, No podra cambiar el estatus despues</h3>
                                                        <p></p>
                                                        <form>
                                                            
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                        <button type="button" class="btn btn-primary">Aceptar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
