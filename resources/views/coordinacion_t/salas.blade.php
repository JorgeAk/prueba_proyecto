@extends('layouts.cabeceraCT')

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
                                                <th scope="col">Disponibilidad</th>
                                                <th scope="col">Editar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($salas as $doc)
                                            <tr class="centrar">
                                                
                                                <td>{{{$doc->id}}}</td>
                                                <td scope="row">{{$doc->nombre}}</td>
                                                @if ($doc->disponibilidad == 1)
                                                <td>Disponible</td>
                                                @else 
                                                <td>No disponible</td>
                                                @endif
                                               
                                                
                                                
                                                <td><a href="#" class="btn btn-lg btn-success btn-sm" data-toggle="modal" data-target="#M{{$doc->id}}">Ver</a>
                                                </td>
                                                
                                                
                                            </tr>
                                            @endforeach
                                                
                                            </tbody>
                                        </table>
                                        @foreach ($salas as $doc)
                                        <!-- basic modal -->
                                        <div class="modal fade" id="M{{$doc->id}}" tabindex="-1" role="dialog" aria-labelledby="M" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">Datos de la sala</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="demo-form2"  method="POST" action="{{ route('/coordinacion/titulaciones/salas/modificar/actualizar') }}" class="form-horizontal form-label-left" >
                                                            @csrf
                                                            <input hidden type="text" id="first-name" name="id_sala" value="{{$doc->id}}" class="form-control ">
                                      
                                                            <div class="item form-group">
                                                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre<span class="required">*</span>
                                                              </label>
                                                              <div class="col-md-6 col-sm-6 ">
                                                                <input type="text" id="first-name" name="nombre" placeholder="{{$doc->nombre}}"  class="form-control ">
                                                              </div>
                                                            </div>
                                                            <div class="item form-group">
                                                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Disponible<span class="required">*</span>
                                                              </label>
                                                              <div class="col-md-6 col-sm-6 ">
                                                                <div class="radio">
                                                                  <label class="">
                                                                    <div class="iradio_flat-green" style="position: relative;"><input type="radio" @if ($doc->disponibilidad == 1) checked @endif class="flat" name="disponibilidad" value="1" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> SI
                                                                  </label>
                                                                </div>
                                                                <div class="radio">
                                                                  <label class="">
                                                                    <div class="iradio_flat-green" style="position: relative;"><input type="radio" @if ($doc->disponibilidad == 0) checked @endif class="flat" name="disponibilidad" value="0" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> NO
                                                                  </label>
                                                                </div>
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
    Titulacion SGE  by <a href="">IT Morelia</a>
  </div>
  <div class="clearfix"></div>
</footer>
<!-- /footer content -->

@endsection