@extends('layouts.cabeceraPr')

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
          <i class="fa fa-dashboard"></i> Profesor/Alumnos-<STRONG>Asignados</STRONG>
        </li>
      </ol>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h5>Alumnos Asignados</h5>      
    </div>    
    <div class="card-body">

       

      <!--..........................Inicio contenido........................-->
 @if ($asignados->count()>0)
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
                                <th scope="col">Carrera</th>
                                <th scope="col">Proyecto</th>
                                <th scope="col">Tipo de sinodal</th>
                                <th scope="col">Ceremonia Asignada</th>
                                <th scope="col">Ser sinodal</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php $tot=1; ?>
                            @foreach ($sinodales as $sino)
                                
                                    @foreach ($asignados as $asig)
                                    
                                        @if ($asig->id == $sino->id_solicitud)
                                        <tr>
                                            <td scope="row">{{$asig->n_control}}</td>
                                            <td>{{$asig->p_nombre}} {{$asig->s_nombre}}</td>
                                                @foreach ($carreras as $carr)
                                                    @if ($carr->id == $asig->id_carrera)
                                                        <td>{{$carr->nombre}}</td>
                                                    @endif 
                                    @endforeach 
                                        @if ($asig->n_proyecto)
                                            <td>{{$asig->n_proyecto}}</td>
                                        @else 
                                            <td>CENEVAL</td>
                                        @endif 

                                        @foreach ($tipoS as $tipS)
                                            @if ($tipS->id == $sino->id_tipo) 
                                                <td>{{$tipS->nombre}}</td>
                                            @endif 

                                        @endforeach
                                        @foreach ($ceremonias as $cer)
                                        @if ($sino->id_solicitud==$cer->id_solicitud)
                                        <td style="text-align:left; white-space: pre-wrap;"><b>Sala:</b><?php foreach($salas as $sala){if($sala->id==$cer->id_sala){echo $sala->nombre;}}?><br><b>Fecha:</b> <?php echo date_format (new DateTime($cer->fecha), 'd/m/Y');?><br><b>Hora:</b> {{$cer->hora}}</td>
                                        @endif
                                            
                                        @endforeach
                                    
                                    <td>
                                        @if ($sino->id_solicitud == $asig->id and $sino->id_estatus==2 )
                                            <a href="#" class="btn btn-lg btn-success btn-sm" data-toggle="modal" data-target="#basicAcept{{$sino->id_solicitud }}">Aceptar</a>
                                            <a href="#" class="btn btn-lg btn-danger btn-sm" data-toggle="modal" data-target="#basicCancel{{$sino->id_solicitud }}">Rechazar</a>
                                        @else 
                                            @foreach ($estatus2 as $est)
                                                @if ($est->id == $sino->id_estatus)
                                                    <p>{{$est->nombre}}</p>
                                                @endif
                                            @endforeach  
                                        @endif
                                    </td>
                                </tr>
                                    @endif
                                
                                    @endforeach
                                
                            @endforeach
                        </tbody>
                    </table>
                    
                    @foreach ($asignados as $alum)
                                    @foreach ($sinodales as $rev)
                                        @if( $rev->id_solicitud == $alum->id and $rev->id_estatus != 1 )
                                        <!-- basic modalAcept -->
                                        <div class="modal fade" id="basicAcept{{$alum->id}}" tabindex="-1" role="dialog" aria-labelledby="basicAcept" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel" style="text-align: center;"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> ¿Acepta ser sinodal?</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5 class="alert "><i class="fa fa-check-circle-o" aria-hidden="true"></i> No podra volver a cambiarlo de nuevo</h5>
                                                        <form class="" method="POST"  action="{{ route('/profesor/alumnos/asignados/actualizar') }}">
                                                            @csrf
                                                            <input hidden type="text" id="last-name" name="aceptar_sinodal"  value="si"  class="form-control">
                                                            <input hidden type="text" id="last-name" name="solicitud"  value="{{$alum->id}}"  class="form-control">
                                                            <div class="form-group">
                                                                <label for="exampleFormControlTextarea1"><h5 class="alert"><i class="fa fa-commenting-o" aria-hidden="true"></i> Si quiere puede agregar algun comentario de lo contrario dejarlo vacio:</h5></label>
                                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                            </div>
                                                            <button type="submit" class="btn btn-success btn-block">Confirmar</button>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- basic modalCancel -->
                                        <div class="modal fade" id="basicCancel{{$alum->id}}" tabindex="-1" role="dialog" aria-labelledby="basicCancel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel" style="text-align: center;"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> ¿No puede ser sinodal?</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5 class="alert "><i class="fa fa-check-circle-o" aria-hidden="true"></i> No podra volver a cambiarlo de nuevo</h5>
                                                        <form class="" method="POST"  action="{{ route('/profesor/alumnos/asignados/actualizar') }}">
                                                            @csrf
                                                            <input hidden type="text" id="last-name" name="rechazar_sinodal"  value="si"  class="form-control">
                                                            <input hidden type="text" id="last-name" name="solicitud"  value="{{$alum->id}}"  class="form-control">
                                                            <div class="form-group">
                                                                <label for="exampleFormControlTextarea1"><h5 class="alert"><i class="fa fa-commenting-o" aria-hidden="true"></i> Agregar algun comentario por el cual no es posible su participacion:</h5></label>
                                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
                                                            </div>
                                                            <button type="submit" class="btn btn-success btn-block">Confirmar</button>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        @endif
                                    @endforeach
                                @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

        </div>
      </div>

@endif
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
