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
                                                <th scope="col">Ceremonia del alumno</th>
                                                <th scope="col">Descripcion</th>
                                                <th scope="col">Sala</th>
                                                <th scope="col">Fecha</th>

                                                <th scope="col">Editar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ceremonias as $doc)
                                            <tr class="centrar">
                                              <td>{{$doc->id}}</td>
                                                @foreach ($alumnos as $alum)
                                                    @if ($doc->id_solicitud== $alum->id)
                                                    <td>{{ $alum->p_nombre }} {{ $alum->s_nombre }} {{ $alum->a_paterno }} {{ $alum->a_materno }} </td>
                                                    @endif
                                                @endforeach

                                                <td>{{$doc->descripcion}}</td>
                                                @foreach ($salas as $sal)
                                                @if ($doc->id_sala== $sal->id)
                                                <td>{{ $sal->nombre }} </td>
                                                @endif 
                                                @endforeach
                                                <td>{{$doc->fecha}} {{$doc->hora}}</td>
                                                
                                                
                                                <td><a href="#" class="btn btn-lg btn-success btn-sm" data-toggle="modal" data-target="#M{{$doc->id}}">Ver</a>
                                                </td>
                                                
                                                
                                            </tr>
                                            @endforeach
                                                
                                            </tbody>
                                        </table>
                                        @foreach ($ceremonias as $doc)
                                        <!-- basic modal -->
                                        <div class="modal fade" id="M{{$doc->id}}" tabindex="-1" role="dialog" aria-labelledby="M" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">Datos del documento</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="demo-form2"  method="POST" action="{{ route('/coordinacion/titulaciones/alumnos/ceremonias/modificar/actualizar') }}" class="form-horizontal form-label-left" >
                                                          @csrf
                                                          <input hidden type="text" id="last-name" name="id_ceremonia" value="{{ $doc->id }}" class="form-control">
                                                          @foreach ($alumnos as $alum)
                                                          @if ($doc->id_solicitud == $alum->id)
                                                          <input hidden type="text" id="last-name" name="id_solicitud" value="{{ $alum->id }}" class="form-control">
                                                          <input hidden type="text" id="last-name" name="nombre" value="Ceremonia de titulacion de :{{ $alum->p_nombre }} {{ $alum->s_nombre }} {{ $alum->a_paterno }} {{ $alum->a_materno }} Con numero de control: {{ $alum->n_control }}" class="form-control">
                                                              
                                                          @endif
                                                          @endforeach
                                                          
                                                          <div class="item form-group">
                                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Fecha <span class="required">*</span></label>
                                                            <div class="col-md-6 col-sm-6 ">
                                                              <input id="birthday" name="fecha" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required="required" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                                                              <script>
                                                              function timeFunctionLong(input) {
                                                                setTimeout(function() {
                                                                  input.type = 'text';
                                                                  }, 60000);
                                                                  }
                                                              </script>
                                                            </div>
                                                          </div>
                                                          
                                                          <div class="item form-group">
                                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Hora <span class="required">*</span></label>
                                                            <div class="col-md-6 col-sm-6 ">
                                                              <div class="input-group " >
                                                                <input type="time" name="hora" class="form-control" required>
                                                              </span>
                                                            </div>
                                                          </div>
                                                        </div>

                                                        <div class="form-group row">
                                                          <label class="col-form-label col-md-3 col-sm-3 label-align">Sala</label>
                                                          <div class="col-md-6 col-sm-6">
                                                            <select class="form-control" name="id_sala" required>
                                                              <option class="hidden"  selected disabled>Selecciona</option>
                                                              @foreach ($salas as $sal)
                                                              <option value="{{$sal->id}}">{{$sal->nombre}}</option>
                                                              @endforeach
                                                            </select>
                                                          </div>
                                                        </div>
                                                        
                                                        <div class="form-group row">
                                                          <label class="control-label col-md-3 col-sm-3 ">Detalles de la ceremonia <span class="required">*</span></label>
                                                          <div class="col-md-6 col-sm-6 ">
                                                            <textarea class="form-control" rows="3" placeholder="" name="descripcion" ></textarea>
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

