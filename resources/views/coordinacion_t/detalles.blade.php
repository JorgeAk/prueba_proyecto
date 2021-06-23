@extends('layouts.cabeceraCT')


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
                    <i class="fa fa-dashboard"></i> Coordinacion de titulaciones/Alumno/<STRONG>Solicitud</STRONG>
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
            <div class="container register">
                <div class="row">
                    <div class="col-md-12 register-right">
                        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist"></ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <br>
                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="">
                                            <label for="inputfirstName">Primer Nombre</label>
                                            <input disabled id="inputfirstName" type="text" class="form-control  @error('name') is-invalid @enderror" name="p_nombre" autocomplete="name" placeholder="{{ $alum->p_nombre }}" autofocus required />
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class=" form-label-group">
                                            <label for="inputSecondName">Segundo Nombre</label>
                                            <input disabled id="inputSecondName" name="s_nombre" type="text" class="form-control" placeholder="{{ $alum->s_nombre }}" />
                                        </div>
                                        <div class=" form-label-group">
                                            <label for="inputAp">Apellido Paterno</label>
                                            <input disabled id="inputAp" name="a_paterno" type="text" class="form-control" placeholder="{{ $alum->a_paterno }}" />
                                        </div>
                                        <div class=" form-label-group">
                                            <label for="inputAm">Apellido Materno</label>
                                            <input disabled id="inputAm" name="a_materno" type="text" class="form-control" placeholder="{{ $alum->a_materno }}" />
                                        </div>

                                        <div class=" form-label-group">
                                            <label for="inputemail2">Segundo Correo</label>
                                            <input disabled id="inputemail2" name="s_correo" type="email" class="form-control" placeholder="{{ $alum->s_correo }}" />
                                        </div>
                                        <div class=" form-label-group">
                                            <label for="inputtel">Telefono de Casa</label>
                                            <input disabled id="inputtel" name="telefono" type="tel" class="form-control" placeholder="{{ $alum->telefono }}" />
                                        </div>
                                        <div class=" form-label-group">
                                            <label for="inputtel2">Celular</label>
                                            <input disabled id="inputtel2" name="celular" type="tel" minlength="10" maxlength="10" class="form-control" placeholder="{{ $alum->celular }}" />
                                        </div>
                                        <div class=" form-label-group">
                                            <label for="inputciudad">Municipio</label>
                                            <input disabled id="inputciudad" name="municipio" type="text" class="form-control" placeholder="{{ $alum->municipio }}" />
                                        </div>
                                        <div class=" form-label-group">
                                            <label for="inputcp">CP</label>
                                            <input disabled id="inputcp" name="cp" type="text" class="form-control" placeholder="{{ $alum->cp }}" />
                                        </div>
                                        <div class=" form-label-group">
                                            <label for="inputestado">Entidad Federativa</label>
                                            <input disabled id="inputestado" name="entidad_f" type="text" class="form-control" placeholder="{{ $alum->entidad_f }}" />
                                        </div>
                                        <div class=" form-label-group">
                                            <label for="inputNcontrol">Numero de Control</label>
                                            <input disabled id="inputNcontrol" name="n_control" type="text" class="form-control" placeholder="{{ $alum->n_control }}" />
                                        </div>
                                        <div class=" form-label-group">
                                            <label for="inputCarrera">Carrera</label>
                                            @foreach ($carreras as $carr)
                                            @if ($alum->id_carrera == $carr->id)
                                            <input disabled id="inputCarrera" name="carrera" type="text" class="form-control" placeholder="{{ $carr->nombre  }}" required />
                                            @endif
                                            @endforeach
                                        </div>
                                        <div class=" form-label-group">
                                            <label for="inputCarrera">Plan</label>
                                            @foreach ($planes as $plan)
                                            @if ($alum->id_plan == $plan->id)
                                            <input disabled id="inputCarrera" name="plan" type="text" class="form-control" placeholder="{{ $plan->nombre }}" required />
                                            @endif
                                            @endforeach
                                        </div>
                                        <br>
                                        <div class=" form-label-group">
                                            <label for="inputCarrera">Fecha de Ingreso</label>
                                            <input disabled id="inputCarrera" name="f_ingreso" type="text" class="form-control" placeholder="{{ $alum->f_ingreso }}" required />
                                        </div>
                                        <div class=" form-label-group">
                                            <label for="inputCarrera">Fecha de Egreso</label>
                                            <input disabled id="inputCarrera" name="f_egreso" type="text" class="form-control" placeholder="{{ $alum->f_egreso }}" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!------ DOCUMENTOS ----------------->
                                        @if (count($documentos_al)>0)
                                        <?php $contador_doc = 0; ?>
                                        @foreach ($documentos_al as $n_doc)
                                        @if ($n_doc->id_solicitud == $alum->id)
                                        <?php $contador_doc++; ?>
                                        @endif
                                        @endforeach
                                        <br><br>
                                        <div id="accordion_doc{{$alum->id}}">
                                            <div class="card">
                                                <div class="card-header centrar" id="headingOne_doc">

                                                    <h5 class="mb-0 ">
                                                        <h5 class="centrar">DOCUMENTOS ADJUNTOS</h5>
                                                        <a onclick="muestra('muestra_doc{{$alum->id}}','oculta_doc{{$alum->id}}')" id="muestra_doc{{$alum->id}}" data-toggle="collapse" data-target="#collapseOne_doc{{$alum->id}}" aria-expanded="true" class="btn btn-app img-close ">
                                                            <span class="badge bg-orange">{{$contador_doc}}</span>
                                                            <i class="fa fa-folder"></i>Documentos Adjuntos
                                                        </a>
                                                        <a onclick="oculta('muestra_doc{{$alum->id}}','oculta_doc{{$alum->id}}')" id="oculta_doc{{$alum->id}}" style="display: none" data-toggle="collapse" data-target="#collapseTwo_doc{{$alum->id}}" aria-expanded="false" aria-controls="collapseTwo_doc{{$alum->id}}" class="btn btn-app img-open ">
                                                            <span class="badge bg-orange">{{$contador_doc}}</span>
                                                            <i class="fa fa-folder-open"></i>Documentos Adjuntos
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id="collapseOne_doc{{$alum->id}}" class="collapse " aria-labelledby="headingOne_doc" data-parent="#accordion_doc{{$alum->id}}">
                                                    <div class="card-body">
                                                        <div class="x_content">
                                                            @foreach ($documentos_al as $doc)
                                                            @if ($doc->id_solicitud == $alum->id)
                                                            <label hidden for="inputCarrera">{{$doc->documento}}</label>
                                                            <a class="btn btn-app" href="{{ route('descargar_archivo',$doc->ruta)}}" download="{{$doc->documento}}_{{$alum->n_control}}.pdf" data-toggle="tooltip" data-placement="top" title="{{$doc->documento}}"><i class="fa fa-file-pdf-o"></i></a>
                                                            <input hidden disabled id="inputCarrera" name="f_egreso" type="text" class="form-control" placeholder="{{ $doc->ruta }}" required />
                                                            @endif
                                                            <?php $contador_doc = 0; ?>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="headingTwo_doc{{$alum->id}}">
                                                    <h5 class="mb-0">
                                                    </h5>
                                                </div>
                                                <div id="collapseTwo_doc{{$alum->id}}" class="collapse" aria-labelledby="headingTwo_doc{{$alum->id}}" data-parent="#accordion_doc{{$alum->id}}">
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <br>
                                        <!------ END DOCUMENTOS ----------------->
                                        <!------ OFICIOS ----------------->
                                        @if (count($oficios)>0)
                                        <?php $contador_of = 0; ?>
                                        @foreach ($oficios as $n_ofi)
                                        @if ($n_ofi->id_solicitud == $alum->id)
                                        <?php $contador_of++; ?>
                                        @endif
                                        @endforeach
                                        <br><br>
                                        <div id="accordion{{$alum->id}}">
                                            <div class="card">
                                                <div class="card-header centrar" id="headingOne">

                                                    <h5 class="mb-0 ">
                                                        <h5 class="centrar">OFICIOS ADJUNTOS</h5>
                                                        <a onclick="muestra('muestra{{$alum->id}}','oculta{{$alum->id}}')" id="muestra{{$alum->id}}" data-toggle="collapse" data-target="#collapseOne{{$alum->id}}" aria-expanded="true" class="btn btn-app img-close ">
                                                            <span class="badge bg-orange">{{$contador_of}}</span>
                                                            <i class="fa fa-folder"></i>Oficios Adjuntos
                                                        </a>
                                                        <a onclick="oculta('muestra{{$alum->id}}','oculta{{$alum->id}}')" id="oculta{{$alum->id}}" style="display: none" data-toggle="collapse" data-target="#collapseTwo{{$alum->id}}" aria-expanded="false" aria-controls="collapseTwo{{$alum->id}}" class="btn btn-app img-open ">
                                                            <span class="badge bg-orange">{{$contador_of}}</span>
                                                            <i class="fa fa-folder-open"></i>Oficios Adjuntos
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id="collapseOne{{$alum->id}}" class="collapse " aria-labelledby="headingOne" data-parent="#accordion{{$alum->id}}">
                                                    <div class="card-body">
                                                        <div class="x_content">
                                                            @foreach ($oficios as $ofi)
                                                            @if ($ofi->id_solicitud == $alum->id)
                                                            <label hidden for="inputCarrera">@foreach ($tipo_oficio as $t_of)
                                                                @if ($t_of->id==$ofi->id_tipo_oficio)
                                                                {{$t_of->nombre}}
                                                                @endif
                                                                @endforeach</label>
                                                            <a class="btn btn-app" href="{{ route('descargar_archivo', $ofi->url )}}" data-toggle="tooltip" data-placement="top" title="@foreach ($tipo_oficio as $t_of)
                                                                    @if ($t_of->id==$ofi->id_tipo_oficio)
                                                                    {{$t_of->nombre}}   
                                                                    @endif
                                                                @endforeach"><i class="fa fa-file-pdf-o"></i></a>
                                                            <input hidden disabled id="inputCarrera" name="f_egreso" type="text" class="form-control" placeholder="{{ $ofi->url }}" required />
                                                            @endif
                                                            <?php $contador_of = 0; ?>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="headingTwo{{$alum->id}}">
                                                    <h5 class="mb-0">
                                                    </h5>
                                                </div>
                                                <div id="collapseTwo{{$alum->id}}" class="collapse" aria-labelledby="headingTwo{{$alum->id}}" data-parent="#accordion{{$alum->id}}">
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <br>
                                        <!------ Oficios ----------------->
                                        @foreach ($op_titulaciones as $op_t)
                                        @if ($alum->id_optitulacion == $op_t->id)
                                        <div class=" form-label-group">
                                            <label for="inputCarrera">Opcion de titulacion</label>
                                            <input disabled id="inputCarrera" name="op_titulacion" type="text" class="form-control" placeholder="{{ $op_t->nombre }}" required />
                                        </div>
                                        @endif
                                        @endforeach
                                        @if ($alum->id_optitulacion != 4)
                                        <div class=" form-label-group">
                                            <label for="inputCarrera">Archivo del Proyecto</label>
                                            <a href="{{ route('descargar_archivo', $alum->proy_archivo) }}" download="proyecto_{{ $alum->n_control }}.pdf" class="btn btn-success pull-right form-control text-light" style="margin-right: 5px;"><i class="fa fa-cloud-download"></i>&nbsp;&nbsp;<i class="fa fa-file-pdf-o"></i>&nbsp;Descargar
                                                Archivo</a>
                                        </div>
                                        <div class=" form-label-group">
                                            <label for="inputCarrera">Asesor Interno</label>
                                            @foreach ($profesores as $prof)
                                            @if ($alum->id_asesor == $prof->id)
                                            <input disabled id="inputCarrera" name="carrera" type="text" class="form-control" placeholder="{{ $prof->p_nombre }}" required />
                                            @endif
                                            @endforeach
                                        </div>
                                        @endif
                                        @if ($alum->s_estatus == 4 or $alum->s_estatus == 18)
                                        <hr class="my-4">
                                        <h5 class="centrar">Documentos Requeridos: <a href="#" class="text-danger" data-toggle="tooltip" data-placement="top" title="Solo marca los documentos que esten correctos"><i class="fa fa-info-circle"></i></a></h5>
                                        <form class="" method="POST" enctype="multipart/form-data" action="{{ route('actualizar_documentacion') }}">
                                            @csrf
                                            <input hidden type="text" id="last-name" name="solicitud" value="{{ $alum->id }}" class="form-control">
                                            @if (!empty ($v_documentos))
                                            <label class="col-md-3 col-sm-3  control-label"></label>
                                            <div class="col-md-9 col-sm-9 ">
                                                @foreach ($v_documentos as $v_doc)
                                                <div class="checkbox">
                                                    <label class="">
                                                        <div class="icheckbox_flat-green checked" style="position: relative;">
                                                            <input type="checkbox" class="flat" @if ($v_doc->entregado_correcto==1) checked="checked" @endif style="position: absolute; opacity: 0;" name="{{$v_doc->id_documento_requerido}}">
                                                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                        </div>
                                                        @foreach ($documentos as $doc)
                                                        @if ($doc->id == $v_doc->id_documento_requerido)
                                                        <b>{{$doc->nombre}}</b>
                                                        <a href="#" class="text-danger" data-toggle="tooltip" data-placement="top" title="{{$doc->caracteristicas}}"><i class="fa fa-info-circle"></i></a>
                                                        @endif
                                                        @endforeach
                                                    </label>
                                                </div>
                                                @endforeach
                                                <br>
                                            </div>
                                            <br>
                                            <h5 class="centrar">Incluir el envio de oficio para asignacion de sinodales: <a href="#" class="text-danger" data-toggle="tooltip" data-placement="top" title="Solo enviarlo cuando todos los documentos esten correctos"><i class="fa fa-info-circle"></i></a></h5>
                                            <div id="content">
                                                <h5 class="centrar">Adjuntar Oficio:</h5>
                                                <div class=" form-label-group" hidden>
                                                    <label for="inputAp">URL del oficio</label>
                                                    <input id="inputAp" name="oficio_sol_sinodales" type="text" class="form-control" placeholder="" />
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group image-preview">
                                                        <span class="input-group-btn">
                                                            <div class="btn btn-default carga-archivo-input">
                                                                <span class="glyphicon glyphicon-folder-open"></span>
                                                                <span class="carga-archivo-input-title">Seleccionar archivo</span>
                                                                <input type="file" accept="application/pdf" name="oficio_sol_sinodales" />
                                                            </div>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-xs-6 col-centrada">
                                                    <button type="submit" class="btn btn-success btn-block">Confirmar</button>
                                                </div>
                                            </div>
                                            @else
                                            <label class="col-md-3 col-sm-3  control-label"></label>
                                            <div class="col-md-9 col-sm-9 ">
                                                @foreach ($documentos as $v_doc)
                                                <div class="checkbox">
                                                    <label class="">
                                                        <div class="icheckbox_flat-green checked" style="position: relative;">
                                                            <input type="checkbox" class="flat" style="position: absolute; opacity: 0;" name="{{$v_doc->id}}">
                                                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                        </div>
                                                        <b>{{$v_doc->nombre}}</b><small class="text-success">-<b>({{$v_doc->caracteristicas}})</small>
                                                    </label>
                                                </div>
                                                @endforeach
                                            </div>
                                            @endif
                                            @endif
                                            @if ($alum->s_estatus == 8)
                                            <br>
                                            <h5 class="centrar">Generar Ceremonia de Titulacion:</h5>
                                            <br>
                                            <form class="" method="POST" enctype="multipart/form-data" action="{{ route('ceremonia_nuevo') }}">
                                                @csrf
                                                <input hidden type="text" id="last-name" name="id_solicitud" value="{{ $alum->id }}" class="form-control">
                                                <input hidden type="text" id="last-name" name="nombre" value="Ceremonia de titulacion de :{{ $alum->p_nombre }} {{ $alum->s_nombre }} {{ $alum->a_paterno }} {{ $alum->a_materno }} Con numero de control: {{ $alum->n_control }}" class="form-control">
                                                <div class="item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Fecha <span class="required">*</span>
                                                    </label>
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
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Hora <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <div class="input-group ">
                                                            <input type="time" name="hora" class="form-control" required>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Sala</label>
                                                    <div class="col-md-6 col-sm-6">
                                                        <select class="form-control" name="id_sala" required>
                                                            <option class="hidden" selected disabled>Selecciona</option>
                                                            @foreach ($salas as $sal)
                                                            <option value="{{$sal->id}}">{{$sal->nombre}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-md-3 col-sm-3 ">Detalles de la ceremonia <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <textarea class="form-control" rows="3" placeholder="" name="descripcion"></textarea>
                                                    </div>
                                                </div>
                                                <hr class="my-4">
                                                <h5 class="centrar">Incluir el envio de oficio de Ceremonia:</h5>
                                                <div id="content">
                                                    <h5 class="centrar">Adjuntar Oficio:</h5>
                                                    <div class=" form-label-group" hidden>
                                                        <label for="inputAp">URL del oficio</label>
                                                        <input id="inputAp" name="oficio_ceremonia" type="text" class="form-control" placeholder="" />
                                                    </div>
                                                    <div class="form-group">
                                                        <br>
                                                        <div class="input-group image-preview">
                                                            <span class="input-group-btn">
                                                                <div class="btn btn-default carga-archivo-input">
                                                                    <span class="glyphicon glyphicon-folder-open"></span>
                                                                    <span class="carga-archivo-input-title">Seleccionar archivo</span>
                                                                    <input type="file" accept="application/pdf" name="oficio_ceremonia" />
                                                                </div>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-6 col-centrada">
                                                        <button type="submit" class="btn btn-success btn-block">Confirmar</button>
                                                    </div>
                                                </div>
                                                @endif
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div align="center">
                <h4>¿Este Registro no Existe? =C</h4>
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
        Titulacion SGE by <a href="">IT Morelia</a>
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->

@endsection