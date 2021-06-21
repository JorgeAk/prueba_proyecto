@extends('layouts.cabeceraDA')

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
          <i class="fa fa-dashboard"></i> Departamento Academico/<STRONG>Home</STRONG>
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
                        <div class="tile-stats"   >
                          <div class="icon" > <i class="fa fa fa-file-text "></i>
                          </div>
                          <span class="badge bg-red"> Nuevas</span>
                          @if (empty($nuevas))
                          <div class="count counter" data-target="0">0</div>
                              @else 
                              <div class="count counter" data-target="{{$nuevas}}">0</div>
                          @endif
                          
                          <h4 class="centrar" >Solicitudes!</h4>
                        </div>
                        <div class="color1 est " >
                            <h5 class="centrar " ><small><a href="{{ route('/docencia/alumnos/solicitudes') }}">Ver <i class="fa fa-arrow-circle-right"></i></a> </small></h5>
                          </div>
                      </div>
                      <div class="animated flipInY col-lg-2 col-md-3 col-sm-6  ">
                        <div class="tile-stats ">
                          <div class="icon"><i class="fa fa-check-square-o "></i>
                          </div>
                          <span class="badge bg-red"> Nuevas</span>
                          @if (empty($aceptados))
                          <div class="count counter" data-target="0">0</div>
                          @else 
                          <div class="count counter" data-target="{{$aceptado}}">0</div>
                          @endif
                          <h4 class="centrar">Aceptados!</h4>
                        </div>
                        <div class="color1 est" style="">
                            <h5 class="centrar" ><small><a href="{{ route('/docencia/alumnos/solicitudes') }}">Ver <i class="fa fa-arrow-circle-right"></i></a> </small></h5>
                          </div>
                      </div>
                      <div class="animated flipInY col-lg-2 col-md-3 col-sm-6  ">
                        <div class="tile-stats ">
                          <div class="icon"><i class="fa fa-eye pink"></i>
                          </div>
                          <span class="badge bg-red"> Nuevas</span>
                          @if (empty($revision))
                          <div class="count counter" data-target="0">0</div>
                              @else 
                              <div class="count counter" data-target="{{$revision}}">0</div>
                          @endif
                          <h4 class="centrar">En revision!</h4>
                        </div>
                        <div class="color1 est" style="">
                            <h5 class="centrar" ><small><a href="{{ route('/docencia/alumnos/solicitudes') }}">Ver <i class="fa fa-arrow-circle-right"></i></a> </small></h5>
                          </div>
                      </div>
                      <div class="animated flipInY col-lg-2 col-md-3 col-sm-6   ">
                        <div class="tile-stats ">
                          <div class="icon "><i class="fa fa-times-circle " ></i>
                          </div>
                          <span class="badge bg-blue"> Nuevas</span>
                          @if (empty($rechazado))
                          <div class="count counter" data-target="0" >0</div>
                          @else  
                          <div class="count counter" data-target="{{$rechazado}}" >0</div>
                          @endif
                          
                          <h4 class="centrar">Rechazados!</h4>
                        </div>
                        <div class="color1 est" style="">
                            <h5 class="centrar" ><small><a href="{{ route('/docencia/alumnos/solicitudes') }}">Ver <i class="fa fa-arrow-circle-right"></i></a> </small></h5>
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


          <!-- /table-->
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
