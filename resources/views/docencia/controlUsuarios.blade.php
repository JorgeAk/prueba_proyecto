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
          <i class="fa fa-dashboard"></i> Docencia/Usuarios<STRONG>/Modificar</STRONG>
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
                                  <th scope="col">Username</th>
                                  <th scope="col">Correo</th>
                                  <th scope="col">Rol</th>
                                  <th scope="col">Estatus</th>
                                  <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $user)
                                @foreach ($roles as $rol)
                                @if ($user->role_id==$rol->id and Auth::user()->id!=$user->user_id)
                                <tr class="centrar">
                                    <td scope="row">{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$rol->description}}</td>
                                    @if ($user->estatus==1)
                                    <td>Activo</td>
                                    @else
                                    <td>Inactivo</td>
                                    @endif
                                    <td>
                                        <a href="#" class="btn btn-lg btn-success btn-sm" data-toggle="modal" data-target="#M{{$user->id}}"> <i class="fa fa-eye" aria-hidden="true"></i>Ver</a>
                                        <a href="{{ route('alumnoDel',$user->user_id)}}" class="btn btn-lg btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i>eliminar</a>    
                                       
                                        
                                    </td>
                                </tr>
                                            @endif
                                            @endforeach
                                            @endforeach
                                
                            </tbody>
                        </table>
                                         
                                        @foreach ($usuarios as $user)
                                            @foreach ($roles as $rol)
                                             <!-- basic modal -->
                                        <div class="modal fade" id="M{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="M" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">Datos del Usuario</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="demo-form2" method="POST"  class="form-horizontal form-label-left" action="{{ route('/docencia/control/usuarios/modificar/actualizar') }}">
                                                            @csrf
                                                            <input hidden type="text" id="last-name" name="id_usr"  value="{{$user->user_id}}"  class="form-control">
                                                            <input hidden type="text" id="last-name" name="user"  value="{{$user->username}}"  class="form-control">
                                                            <div class="item form-group">
                                                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre<span class="required">*</span>
                                                              </label>
                                                              <div class="col-md-6 col-sm-6 ">
                                                                <input type="text" id="first-name" name="name"  class="form-control" placeholder="{{$user->name}}">
                                                              </div>
                                                            </div>
                                                            <div  class="item form-group">
                                                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Username<span class="required">*</span>
                                                              </label>
                                                              
                                                              <div class="col-md-6 col-sm-6 ">
                                                                <input type="text" id="first-name" name="username"  class="form-control" placeholder="{{$user->username}}">
                                                                <small class="text-danger">* para personal del ITM usar RFC como Username</small>
                                                                
                                                              </div>
                                                            </div>
                                                            <div hidden class="item form-group">
                                                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Apellido Paterno <span class="required">*</span>
                                                              </label>
                                                              <div class="col-md-6 col-sm-6 ">
                                                                <input type="text" id="last-name" name="a_paterno" class="form-control">
                                                              </div>
                                                            </div>
                                                            <div hidden class="item form-group">
                                                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Apellido Materno <span class="required">*</span>
                                                              </label>
                                                              <div class="col-md-6 col-sm-6 ">
                                                                <input type="text" id="last-name" name="a_materno"  class="form-control">
                                                              </div>
                                                            </div>
                                                            <div class="item form-group">
                                                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Correo <span class="required">*</span>
                                                              </label>
                                                              <div class="col-md-6 col-sm-6 ">
                                                                <input type="email" id="last-name" name="email"  class="form-control" placeholder="{{$user->email}}">
                                                              </div>
                                                            </div>
                                                            <div hidden class="item form-group">
                                                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Celular <span class="required">*</span>
                                                              </label>
                                                              <div class="col-md-6 col-sm-6 ">
                                                                <input type="text" id="last-name" name="celular"  class="form-control">
                                                              </div>
                                                            </div>
                                                            <div class="item form-group">
                                                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Contraseña <span class="required">*</span>
                                                              </label>
                                                              <div class="col-md-6 col-sm-6 ">
                                                                <input type="password" id="last-name" name="password"  class="form-control">
                                                              </div>
                                                            </div>
                                                            <div class="item form-group">
                                                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Rol <span class="required">*</span>
                                                              </label>
                                                              <div class="col-md-6 col-sm-6 ">
                                                                <select class="form-control" name="rol">
                                                                  <option class="hidden"  selected disabled>Selecciona</option>
                                                                  @foreach ($roles as $rol)
                                                                  <option value="{{$rol->id}}">{{$rol->description}}</option>
                                                                  @endforeach
                                                                </select>
                                                              </div>
                                                            </div>
                                                            <div class="item form-group radio">
                                                                  <label class="col-form-label col-md-3 col-sm-3 label-align">
                                                                    Estatus <span class="required">*</span>
                                                                  </label>
                                                                  <label class="col-form-label col-md-3  ">
                                                                      @if ($user->estatus==1)
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
                                        <!-- basic modal -->

                                                
                                            @endforeach
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
