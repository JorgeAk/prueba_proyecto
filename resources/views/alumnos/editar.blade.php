@extends('layouts.cabecera')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
  <div>
    <div class="col-lg-12">
      <h1 class="page-header">
        Panel <small>Proyecto Docencia</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active">
          <i class="fa fa-dashboard"></i> Alumno/<STRONG>Solicitud</STRONG>
        </li>
      </ol>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h5>Solicitud Titulación</h5>
      
    </div>
    <div class="card-body">
      <!--.........Ventana Registro ................................-->
      @if ($solicitud->count())
      @foreach ($solicitud as $alum)
      @if ($alum->s_estatus=="1")    
      <div class="container register">
        <div class="row">
          <div class="col-md-12 register-right">
            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist"></ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <h4 class="register-heading">REGISTRAR <small>Vuelve a ingresar tus datos</small></h4> 
                <form class="" method="POST" enctype="multipart/form-data"  action="{{ route('/alumnos/solicitud/editar/actualizar') }}">
                  @csrf
                  <div class="row ">
                    <div class="col-md-6">
                      <div class="">
                        <label  for="inputfirstName">Primer Nombre</label>
                        <input id="inputfirstName" type="text" class="form-control  @error('name') is-invalid @enderror" name="p_nombre"  autocomplete="name" placeholder="{{$alum->p_nombre}}"  autofocus  />
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                      <div class=" form-label-group">
                        <label  for="inputSecondName">Segundo Nombre</label>
                        <input id="inputSecondName" name="s_nombre" type="text" class="form-control"  placeholder="{{$alum->s_nombre}}"   />
                      </div>
                      <div class=" form-label-group">
                        <label  for="inputAp">Apellido Paterno</label>
                        <input id="inputAp" name="a_paterno" type="text" class="form-control"  placeholder="{{$alum->a_paterno}}"  />
                      </div>
                      <div class=" form-label-group">
                        <label  for="inputAm">Apellido Materno</label>
                        <input id="inputAm"  name="a_materno" type="text" class="form-control"  placeholder="{{$alum->a_materno}}"   />
                      </div>
                      
                      <div class=" form-label-group">
                        <label  for="inputemail2">Segundo Correo</label>
                        <input id="inputemail2" name="s_correo" type="email" class="form-control"  placeholder="{{$alum->s_correo}}" />
                      </div>
                      <div class=" form-label-group">
                        <label  for="inputtel">Telefono de Casa</label>
                        <input id="inputtel" name="telefono" type="tel" class="form-control"  placeholder="{{$alum->telefono}}"  />
                      </div>
                      <div class=" form-label-group">
                        <label  for="inputtel2">Celular</label>
                        <input id="inputtel2" name="celular" type="tel" minlength="10" maxlength="10" class="form-control"  placeholder="{{$alum->celular}}"  />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class=" form-label-group">
                        <label  for="inputciudad">Municipio</label>
                        <input id="inputciudad" name="municipio" type="text" class="form-control"  placeholder="{{$alum->municipio}}"  />
                      </div>
                      <div class=" form-label-group">
                        <label  for="inputcp">CP</label>
                        <input id="inputcp" name="cp" type="text" class="form-control"  placeholder="{{$alum->cp}}"  />
                      </div>
                      <div class=" form-label-group">
                       <label  for="inputestado">Entidad Federativa</label>
                       <input id="inputestado" name="entidad_f" type="text" class="form-control"  placeholder="{{$alum->entidad_f}}"  />
                     </div>
                     
                     <div class=" form-label-group">
                      <label  for="inputNcontrol">Numero de Control</label>
                      <input id="inputNcontrol" name="n_control" type="text" class="form-control"  placeholder="{{$alum->n_control}}"  />
                    </div>

                    <!-- Documentos adjuntos ----->
                    
                    <br>
                     <h5 class="centrar">Actualizar documentos:</h5>
                     <p class="centrar"><small class="text-danger" ><b>*Solo enviarlo cuando todos los documentos esten correctos</b></small></p>
                     <div class="centrar">
                       <div id="gender" class="btn-group" data-toggle="buttons">
                         <label class="btn btn-secondary active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                           <input type="radio" value="si" name="check" id="check"  onchange="javascript:showContent()" class="join-btn" data-parsley-multiple="gender" data-parsley-id="12"> &nbsp;SI&nbsp;
                         </label>
                         <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                           <input  type="radio"  value="no"  name="check" id="check2"  onchange="javascript:showContent()" class="join-btn" data-parsley-multiple="gender"> NO 
                         </label>
                       </div>
                     </div>
                     <br>
                     <br>
                     <div id="content" style="display: none;" >
                      @if (count($documentos)>0)
                      @foreach ($documentos as $doc_r)
                      <div class="form-group" >
                        <label>{{$doc_r->nombre}} <a href="#" class="text-danger" data-toggle="tooltip" data-placement="top" title="{{$doc_r->caracteristicas}}"><i class="fa fa-info-circle"></i></a></label>
                        <div class="input-group image-preview">
                          <span class="input-group-btn">
                            <div class="btn btn-default carga-archivo-input"> 
                              <span class="glyphicon glyphicon-folder-open"></span>
                              <span class="carga-archivo-input-title">Seleccionar archivo</span>
                              <input type="file" accept="application/pdf" name="{{strtoupper($doc_r->nombre)}}" />
                            </div>
                          </span>
                        </div>
                      </div>
                      <hr> 
                      @endforeach
                      @endif
                     </div>
                    
                    <!---END Documentos adjuntos ----->

                    
                    <div class=" form-label-group">
                      <label  for=""></label>
                      <select class="form-control" name="id_carrera">
                        <option class="hidden"  selected disabled>Carrera</option>
                        @foreach ($carreras as $carr)
                        <option value="{{$carr->id}}">{{$carr->nombre}}</option>
                        @endforeach
                      </select>
                      
                    </div>
                    <div class=" form-label-group">
                      <label  for=""></label>
                      <select class="form-control" name="id_plan">
                        <option class="hidden"  selected disabled>Planes</option>
                        @foreach ($planes as $pl)
                        <option value="{{$pl->id}}" >{{$pl->nombre}}</option>
                        @endforeach
                      </select>
                    </div>
                    <br>
                    <div class=" form-label-group">
                      <label  for="inputCarrera">Fecha de Ingreso</label>
                      <input id="inputCarrera" name="f_ingreso" type="date" class="form-control"  placeholder="Carrera"  />
                    </div>
                    <div class=" form-label-group">
                      <label  for="inputCarrera">Fecha de Egreso</label>
                      <input id="inputCarrera" name="f_egreso" type="date" class="form-control"  placeholder="Carrera"  />
                    </div>

                    <div class=" form-label-group">
                      <label  for=""></label>
                      <select id="op_status_tit" name="id_optitulacion" onChange="mostrar(this.value);" class="form-control" required>
                        <option class="hidden" selected disabled>Opcion de Titulacion</option>
                        @foreach ($op_titulaciones as $tit)
                        <option value="{{$tit->id}}" >{{$tit->nombre}}</option>
                        
                        @endforeach
                      </select>
                    </div>

                   
                    <div id="con1" class="contenido">
                    </div>
                    <br>
                    <div id="cont_a">
                    </div>       
                    <div class="form-group" hidden>
                      <label>Reemplazar archivo</label>
                      <div class="input-group image-preview">
                        <input type="text" class="form-control carga-archivo-filename" name="arch_antiguo" placeholder="{{$resultado2 = str_replace('public/', '',$alum->proy_archivo) }}" disabled>

                        <span class="input-group-btn">
                          <div class="btn btn-default carga-archivo-input"> 
                            <span class="glyphicon glyphicon-folder-open"></span>
                            <span class="carga-archivo-input-title">Seleccionar archivo</span>
                            <input type="file" accept="application/pdf" name="input_file"  />
                          </div>
                        </span>
                      </div>
                    </div> 
                    <hr class="my-4">
                    
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-6 col-centrada" >
                          <button type="submit" class="btn btn-success btn-block">Actualizar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    @else
    <div align="center">
      <h4>Tu solicitud ya fue enviada no es posible editarla</h4>
      
    </div>  
    @endif
    @endforeach
    @else
    <div align="center">
      <h4>¿Deseas generar tu solicitud?</h4>
      <a href="{{ route('/alumnos/solicitud/generar') }}">
        <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generar</button>
      </a>
    </div>  

    @endif

    <!--..................Fin Registro ................................-->
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
