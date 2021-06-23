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
          <i class="fa fa-dashboard"></i> Servicio/Bandeja/<STRONG></STRONG>
        </li>
      </ol>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="animated flipInY col-lg-2 col-md-3 col-sm-6  ">
        </div>
        <div class="animated flipInY col-lg-2 col-md-3 col-sm-6  ">
          <div class="tile-stats ">
            <div class="icon"> <i class="fa fa fa-file-text "></i>
            </div>
            <span class="badge bg-red"> Nuevas</span>
            <div class="count">179</div>
            <h4 class="centrar">Solicitudes!</h4>
          </div>
          <div class="color1" style="">
            <h5 class="centrar "><small><a href="#">Ver <i class="fa fa-arrow-circle-right"></i></a> </small></h5>
          </div>
        </div>
        <div class="animated flipInY col-lg-2 col-md-3 col-sm-6  ">
          <div class="tile-stats ">
            <div class="icon"><i class="fa fa-check-square-o "></i>
            </div>
            <span class="badge bg-red"> Nuevas</span>
            <div class="count">179</div>
            <h4 class="centrar">Aceptados!</h4>
          </div>
          <div class="color1" style="">
            <h5 class="centrar"><small><a href="#">Ver <i class="fa fa-arrow-circle-right"></i></a> </small></h5>
          </div>
        </div>
        <div class="animated flipInY col-lg-2 col-md-3 col-sm-6  ">
          <div class="tile-stats ">
            <div class="icon"><i class="fa fa-eye pink"></i>
            </div>
            <span class="badge bg-red"> Nuevas</span>
            <div class="count">179</div>
            <h4 class="centrar">En revision!</h4>
          </div>
          <div class="color1" style="">
            <h5 class="centrar"><small><a href="#">Ver <i class="fa fa-arrow-circle-right"></i></a> </small></h5>
          </div>
        </div>
        <div class="animated flipInY col-lg-2 col-md-3 col-sm-6   ">
          <div class="tile-stats ">
            <div class="icon "><i class="fa fa-times-circle "></i>
            </div>
            <span class="badge bg-blue"> Nuevas</span>
            <div class="count">179</div>
            <h4 class="centrar">Rechazados!</h4>
          </div>
          <div class="color1" style="">
            <h5 class="centrar"><small><a href="#">Ver <i class="fa fa-arrow-circle-right"></i></a> </small></h5>
          </div>
        </div>
      </div>
    </div>
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
                    <th scope="col"># Control</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido Paterno</th>
                    <th scope="col">Apellido Materno</th>
                    <th scope="col">Carrera</th>
                    <th scope="col">Plan</th>
                    <th scope="col">Evaluar</th>
                    <th scope="col">Ver Completo</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($alumno as $alum)
                  <tr class="centrar">
                    <td scope="row">1</td>
                    <td>{{$alum->p_nombre}}</td>
                    <td>{{$alum->carrera}}</td>
                    <td>{{$alum->n_proyecto}}</td>
                    <td> </td>
                    <td>Si/No</td>
                    <td><a href="#" class="btn btn-lg btn-success btn-sm" data-toggle="modal" data-target="#M{{$alum->id}}">Ver</a>
                    </td>
                    <td><a href="#" class="btn btn-lg btn-success btn-sm">Ver</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              @foreach ($alumno as $alum)
              <!-- basic modal -->
              <div class="modal fade" id="M{{$alum->id}}" tabindex="-1" role="dialog" aria-labelledby="M{{$alum->id}}" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel">Datos del Alumno</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Nombre: {{$alum->p_nombre}}</p>
                      <p>Carrera: {{$alum->carrera}} </p>
                      <p></p>
                      <hr>
                      <p> <button type="button" class="btn btn-success btn-lg btn-sm"> Descargar Proyecto <i class="fas fa-file-download"></i> <span class="oi oi-data-transfer-download"></span></button></p>
                      <hr>
                      <form>
                        <div class="form-group">
                          <label for="exampleFormControlTextarea1">Comentario</label>
                          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      <button type="button" class="btn btn-primary">Enviar Comentario</button>
                    </div>
                  </div>
                </div>
              </div>
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