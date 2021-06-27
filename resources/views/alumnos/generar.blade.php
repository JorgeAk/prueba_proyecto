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
          <i class="fa fa-dashboard"></i> Alumno/Solicitud/<STRONG>Generar</STRONG>
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
      <div class="container register">
        <div class="row">
          <div class="col-md-12 register-right">
            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist"></ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <h3 class="register-heading">REGISTRAR</h3>
                <form class="" method="POST" enctype="multipart/form-data" action="{{ route('/alumnos/reg') }}">
                  @csrf
                  <div class="row ">
                    <div class="col-md-6">
                      <div class="">
                        <label for="inputfirstName">Primer Nombre</label>
                        <input id="inputfirstName" type="text" class="form-control  @error('name') is-invalid @enderror" name="p_nombre" value="{{ Auth::user()->name }}" autocomplete="name" placeholder="{{ Auth::user()->name }}" autofocus readonly="readonly" />
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                      <div class=" form-label-group">
                        <label for="inputSecondName">Segundo Nombre</label>
                        <input id="inputSecondName" name="s_nombre" type="text" class="form-control" placeholder="Segundo Nombre" />
                      </div>
                      <div class=" form-label-group">
                        <label for="inputAp">Apellido Paterno</label>
                        <input id="inputAp" name="a_paterno" type="text" class="form-control" placeholder="Apellido Paterno" required />
                      </div>
                      <div class=" form-label-group">
                        <label for="inputAm">Apellido Materno</label>
                        <input id="inputAm" name="a_materno" type="text" class="form-control" placeholder="Apellido Materno" required />
                      </div>

                      <div class=" form-label-group">
                        <label for="inputemail2">Correo</label>
                        <input id="inputemail2" name="s_correo" type="email" class="form-control" placeholder="Correo" />
                      </div>
                      <div class=" form-label-group">
                        <label for="inputtel">Telefono de Casa</label>
                        <input id="inputtel" name="telefono" type="tel" class="form-control" placeholder="Telefono de Casa" />
                      </div>
                      <div class=" form-label-group">
                        <label for="inputtel2">Celular</label>
                        <input id="inputtel2" name="celular" type="tel" minlength="10" maxlength="10" class="form-control" placeholder="Celular" required />
                      </div>
                      <div class=" form-label-group">
                        <label for="inputciudad">Link de archivos</label>
                        <input id="inputciudad" name="link_repo" type="text" class="form-control" placeholder="Ingresa link donde subiras tus archivos adjuntos" required />
                      </div>
                      <div class=" form-label-group">
                        <label for="inputciudad">Municipio</label>
                        <input id="inputciudad" name="municipio" type="text" class="form-control" placeholder="Ciudad de Residencia" required />
                      </div>
                      <div class=" form-label-group">
                        <label for="inputcp">CP</label>
                        <input id="inputcp" name="cp" type="text" class="form-control" placeholder="CP" required required />
                      </div>
                      <div class=" form-label-group">
                        <label for="inputestado">Entidad Federativa</label>
                        <input id="inputestado" name="entidad_f" type="text" class="form-control" placeholder="Estado" required />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class=" form-label-group">
                        <label for="inputNcontrol">Numero de Control</label>
                        <input id="inputNcontrol" name="n_control" type="text" class="form-control" value="{{ Auth::user()->username }}" placeholder="{{ Auth::user()->username }}" readonly="readonly" />
                      </div>
                      <br>
                      <h5>Documentos Requeridos (Solo en formato PDF)</h5>
                      <!-- Archivos adjuntos ---->
                      @if (count($documentos)>0)
                      @foreach ($documentos as $doc_r)
                      <div class="form-group">
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
                      <!-- Archivos adjuntos ---->
                      <div class=" form-label-group">
                        <label for=""></label>
                        <select class="form-control" name="carrera" required>
                          <option class="hidden" selected disabled>Carrera</option>
                          @foreach ($carreras as $carr)
                          <option value="{{$carr->id}}">{{$carr->nombre}}</option>
                          @endforeach
                        </select>

                      </div>
                      <div class=" form-label-group">
                        <label for=""></label>
                        <select class="form-control" name="plan" required>
                          <option class="hidden" selected disabled>Plan de Estudios</option>
                          @foreach ($planes as $pl)
                          <option value="{{$pl->id}}">{{$pl->nombre}}</option>
                          @endforeach
                        </select>
                      </div>
                      <br>
                      <div class=" form-label-group">
                        <label for="inputCarrera">Fecha de Ingreso</label>
                        <input id="inputCarrera" name="f_ingreso" type="date" class="form-control" placeholder="Carrera" required />
                      </div>
                      <div class=" form-label-group">
                        <label for="inputCarrera">Fecha de Egreso</label>
                        <input id="inputCarrera" name="f_egreso" type="date" class="form-control" placeholder="Carrera" required />
                      </div>
                      <div class=" form-label-group">
                        <label for=""></label>
                        <select id="op_status_tit" name="op_titulacion" onChange="mostrar(this.value);" class="form-control" required>
                          <option class="hidden" selected disabled>Opcion de titulación</option>
                          @foreach ($op_titulaciones as $tit)
                          <option value="{{$tit->id}}">{{$tit->nombre}}</option>

                          @endforeach
                        </select>
                      </div>
                      <div id="con1" class="contenido">
                      </div>
                      <br>
                      <div id="cont_a">
                      </div>
                      <hr class="my-4">
                      <input type="submit" class="btn btn-success" style="text-align: center;" value="Generar" />
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--..................Fin Registro ................................-->
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