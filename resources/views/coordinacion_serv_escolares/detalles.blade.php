@extends('layouts.cabeceraCSE')


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
                        <div class="container register">
                            <div class="row">
                                <div class="col-md-12 register-right">
                                    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist"></ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                                            aria-labelledby="home-tab">
                                            <br>

                                            <form class="" method="POST" enctype="multipart/form-data"
                                                action="{{ route('/coordinacion/servicios_es/alumnos/solicitudes/actualizar') }}">
                                                @csrf
                                                <input hidden type="text" id="last-name" name="solicitud"
                                                    value="{{ $alum->id }}" class="form-control">
                                                <div class="row ">
                                                    <div class="col-md-6">
                                                        <div class="">
                                                            <label for="inputfirstName">Primer Nombre</label>
                                                            <input disabled id="inputfirstName" type="text"
                                                                class="form-control  @error('name') is-invalid @enderror"
                                                                name="p_nombre" autocomplete="name"
                                                                placeholder="{{ $alum->p_nombre }}" autofocus required />
                                                            @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class=" form-label-group">
                                                            <label for="inputSecondName">Segundo Nombre</label>
                                                            <input disabled id="inputSecondName" name="s_nombre" type="text"
                                                                class="form-control"
                                                                placeholder="{{ $alum->s_nombre }}" />
                                                        </div>
                                                        <div class=" form-label-group">
                                                            <label for="inputAp">Apellido Paterno</label>
                                                            <input disabled id="inputAp" name="a_paterno" type="text"
                                                                class="form-control"
                                                                placeholder="{{ $alum->a_paterno }}" />
                                                        </div>
                                                        <div class=" form-label-group">
                                                            <label for="inputAm">Apellido Materno</label>
                                                            <input disabled id="inputAm" name="a_materno" type="text"
                                                                class="form-control"
                                                                placeholder="{{ $alum->a_materno }}" />
                                                        </div>
                                                        <div class=" form-label-group">
                                                            <label for="inputemail2">Segundo Correo</label>
                                                            <input disabled id="inputemail2" name="s_correo" type="email"
                                                                class="form-control"
                                                                placeholder="{{ $alum->s_correo }}" />
                                                        </div>
                                                        <div class=" form-label-group">
                                                            <label for="inputtel">Telefono de Casa</label>
                                                            <input disabled id="inputtel" name="telefono" type="tel"
                                                                class="form-control"
                                                                placeholder="{{ $alum->telefono }}" />
                                                        </div>
                                                        <div class=" form-label-group">
                                                            <label for="inputtel2">Celular</label>
                                                            <input disabled id="inputtel2" name="celular" type="tel"
                                                                minlength="10" maxlength="10" class="form-control"
                                                                placeholder="{{ $alum->celular }}" />
                                                        </div>
                                                        <div class=" form-label-group">
                                                            <label for="inputciudad">Municipio</label>
                                                            <input disabled id="inputciudad" name="municipio" type="text"
                                                                class="form-control"
                                                                placeholder="{{ $alum->municipio }}" />
                                                        </div>
                                                        <div class=" form-label-group">
                                                            <label for="inputcp">CP</label>
                                                            <input disabled id="inputcp" name="cp" type="text"
                                                                class="form-control" placeholder="{{ $alum->cp }}" />
                                                        </div>
                                                        <div class=" form-label-group">
                                                            <label for="inputestado">Entidad Federativa</label>
                                                            <input disabled id="inputestado" name="entidad_f" type="text"
                                                                class="form-control"
                                                                placeholder="{{ $alum->entidad_f }}" />
                                                        </div>
                                                        <div class=" form-label-group">
                                                            <label for="inputNcontrol">Numero de Control</label>
                                                            <input disabled id="inputNcontrol" name="n_control" type="text"
                                                                class="form-control"
                                                                placeholder="{{ $alum->n_control }}" />
                                                        </div>
                                                        <div class=" form-label-group">
                                                            <label for="inputCarrera">Carrera</label>
                                                            @foreach ($carreras as $carr)
                                                                @if ($alum->id_carrera == $carr->id)
                                                                    <input disabled id="inputCarrera" name="carrera"
                                                                        type="text" class="form-control"
                                                                        placeholder="{{ $carr->nombre }}" required />
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                        <div class=" form-label-group">
                                                            <label for="inputCarrera">Plan</label>
                                                            @foreach ($planes as $plan)
                                                                @if ($alum->id_plan == $plan->id)
                                                                    <input disabled id="inputCarrera" name="plan"
                                                                        type="text" class="form-control"
                                                                        placeholder="{{ $plan->nombre }}" required />
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                        <br>
                                                        <div class=" form-label-group">
                                                            <label for="inputCarrera">Fecha de Ingreso</label>
                                                            <input disabled id="inputCarrera" name="f_ingreso" type="text"
                                                                class="form-control" placeholder="{{ $alum->f_ingreso }}"
                                                                required />
                                                        </div>
                                                        <div class=" form-label-group">
                                                            <label for="inputCarrera">Fecha de Egreso</label>
                                                            <input disabled id="inputCarrera" name="f_egreso" type="text"
                                                                class="form-control" placeholder="{{ $alum->f_egreso }}"
                                                                required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">

                                                        <div class=" form-label-group">
                                                            <label for="inputCarrera">Repositorio de archivos</label>
                                                            <input readonly id="inputCarrera" name="repo" type="text"
                                                                class="form-control"
                                                                placeholder="{{ $alum->repositorio_documentos }} "
                                                                required value="{{ $alum->repositorio_documentos }}" />
                                                            <br>
                                                            <a hiden
                                                                onclick="location.href='http://{{ $alum->repositorio_documentos }}';"
                                                                class="btn btn-success pull-right form-control text-light"
                                                                title="{{ $alum->repositorio_documentos }}"
                                                                style="display: inline-block !important;"> <i
                                                                    class="fa fa-eye " aria-hidden="true"></i> Ver
                                                                repositorio </a>

                                                        </div>

                                                        <!------ DOCUMENTOS ----------------->
                                                        @if (count($documentos) > 0)
                                                            <?php $contador_doc = 0; ?>
                                                            @foreach ($documentos as $n_doc)
                                                                @if ($n_doc->id_solicitud == $alum->id)
                                                                    <?php $contador_doc++; ?>
                                                                @endif
                                                            @endforeach
                                                            <br><br>
                                                            <div id="accordion_doc{{ $alum->id }}">
                                                                <div class="card">
                                                                    <div class="card-header centrar" id="headingOne_doc">

                                                                        <h5 class="mb-0 ">
                                                                            <h5 class="centrar">DOCUMENTOS ADJUNTOS</h5>
                                                                            <a onclick="muestra('muestra_doc{{ $alum->id }}','oculta_doc{{ $alum->id }}')"
                                                                                id="muestra_doc{{ $alum->id }}"
                                                                                data-toggle="collapse"
                                                                                data-target="#collapseOne_doc{{ $alum->id }}"
                                                                                aria-expanded="true"
                                                                                class="btn btn-app img-close ">
                                                                                <span
                                                                                    class="badge bg-orange">{{ $contador_doc }}</span>
                                                                                <i class="fa fa-folder"></i>Documentos
                                                                                Adjuntos
                                                                            </a>

                                                                            <a onclick="oculta('muestra_doc{{ $alum->id }}','oculta_doc{{ $alum->id }}')"
                                                                                id="oculta_doc{{ $alum->id }}"
                                                                                style="display: none" data-toggle="collapse"
                                                                                data-target="#collapseTwo_doc{{ $alum->id }}"
                                                                                aria-expanded="false"
                                                                                aria-controls="collapseTwo_doc{{ $alum->id }}"
                                                                                class="btn btn-app img-open ">
                                                                                <span
                                                                                    class="badge bg-orange">{{ $contador_doc }}</span>
                                                                                <i class="fa fa-folder-open"></i>Documentos
                                                                                Adjuntos
                                                                            </a>

                                                                        </h5>
                                                                    </div>

                                                                    <div id="collapseOne_doc{{ $alum->id }}"
                                                                        class="collapse " aria-labelledby="headingOne_doc"
                                                                        data-parent="#accordion_doc{{ $alum->id }}">
                                                                        <div class="card-body">

                                                                            <div class="x_content">

                                                                                @foreach ($documentos as $doc)
                                                                                    @if ($doc->id_solicitud == $alum->id)

                                                                                        <label hidden
                                                                                            for="inputCarrera">{{ $doc->documento }}</label>
                                                                                        <a class="btn btn-app"
                                                                                            href="{{ route('descargar_archivo', $doc->ruta) }}"
                                                                                            download="{{ $doc->documento }}_{{ $alum->n_control }}.pdf"
                                                                                            data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="{{ $doc->documento }}"><i
                                                                                                class="fa fa-file-pdf-o"></i></a>
                                                                                        <input hidden disabled
                                                                                            id="inputCarrera"
                                                                                            name="f_egreso" type="text"
                                                                                            class="form-control"
                                                                                            placeholder="{{ $doc->ruta }}"
                                                                                            required />

                                                                                    @endif
                                                                                    <?php $contador_doc = 0;
                                                                                    ?>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card">
                                                                    <div class="card-header"
                                                                        id="headingTwo_doc{{ $alum->id }}">
                                                                        <h5 class="mb-0">

                                                                        </h5>
                                                                    </div>
                                                                    <div id="collapseTwo_doc{{ $alum->id }}"
                                                                        class="collapse"
                                                                        aria-labelledby="headingTwo_doc{{ $alum->id }}"
                                                                        data-parent="#accordion_doc{{ $alum->id }}">

                                                                    </div>
                                                                </div>
                                                            </div>

                                                        @endif
                                                        <br>
                                                        <!------ END DOCUMENTOS ----------------->





                                                        @foreach ($op_titulaciones as $op_t)
                                                            @if ($alum->id_optitulacion == $op_t->id)
                                                                <div class=" form-label-group">
                                                                    <label for="inputCarrera">Opcion de titulacion</label>
                                                                    <input disabled id="inputCarrera" name="op_titulacion"
                                                                        type="text" class="form-control"
                                                                        placeholder="{{ $op_t->nombre }}" required />
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                        @if ($alum->id_optitulacion != 4)
                                                            <div class=" form-label-group">
                                                                <label for="inputCarrera">Archivo del Proyecto</label>
                                                                <a href="{{ route('descargar_archivo', $alum->proy_archivo) }}"
                                                                    download="proyecto_{{ $alum->n_control }}.pdf"
                                                                    class="btn btn-success pull-right form-control text-light"
                                                                    style="margin-right: 5px;"><i
                                                                        class="fa fa-cloud-download"></i>&nbsp;&nbsp;<i
                                                                        class="fa fa-file-pdf-o"></i>&nbsp;Descargar
                                                                    Archivo</a>
                                                            </div>
                                                            <div class=" form-label-group">
                                                                <label for="inputCarrera">Asesor Interno</label>
                                                                @foreach ($profesores as $prof)
                                                                    @if ($alum->id_asesor == $prof->id)
                                                                        <input disabled id="inputCarrera" name="carrera"
                                                                            type="text" class="form-control"
                                                                            placeholder="{{ $prof->p_nombre }}"
                                                                            required />
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                        <!---------------Asignacion de Sinodales --------------->
                                                        @if ($alum->s_estatus > 8)
                                                            <br>
                                                            <h5 class="centrar">Sinodales</h5>
                                                            <br>
                                                            <!----------- Presidente -------------->
                                                            @foreach ($sinodales as $sino)
                                                                @if ($sino->id_solicitud == $alum->id and $sino->id_tipo == 1)
                                                                    <div class=" form-label-group">
                                                                        @foreach ($profesores as $prof)
                                                                            @if ($prof->id == $sino->id_profesor)
                                                                                <label for="inputCarrera">Presidente</label>
                                                                                <input disabled id="inputCarrera"
                                                                                    name="f_ingreso" type="text"
                                                                                    class="form-control"
                                                                                    placeholder="{{ $prof->p_nombre }}"
                                                                                    required />

                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                            <!----------- Fin Presidente -------------->
                                                            <!----------- Secretario -------------->
                                                            @foreach ($sinodales as $sino)
                                                                @if ($sino->id_solicitud == $alum->id and $sino->id_tipo == 2)
                                                                    <div class=" form-label-group">
                                                                        @foreach ($profesores as $prof)
                                                                            @if ($prof->id == $sino->id_profesor)
                                                                                <label for="inputCarrera">Secretario</label>
                                                                                <input disabled id="inputCarrera"
                                                                                    name="f_ingreso" type="text"
                                                                                    class="form-control"
                                                                                    placeholder="{{ $prof->p_nombre }}"
                                                                                    required />

                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                            <!----------- Fin Secretario -------------->
                                                            <!----------- Vocal Propietario -------------->
                                                            @foreach ($sinodales as $sino)
                                                                @if ($sino->id_solicitud == $alum->id and $sino->id_tipo == 3)
                                                                    <div class=" form-label-group">
                                                                        @foreach ($profesores as $prof)
                                                                            @if ($prof->id == $sino->id_profesor)
                                                                                <label for="inputCarrera">Vocal
                                                                                    Propietario</label>
                                                                                <input disabled id="inputCarrera"
                                                                                    name="f_ingreso" type="text"
                                                                                    class="form-control"
                                                                                    placeholder="{{ $prof->p_nombre }}"
                                                                                    required />

                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                            <!----------- Fin Vocal Propietario -------------->
                                                            <!----------- Vocal Suplente -------------->
                                                            @foreach ($sinodales as $sino)
                                                                @if ($sino->id_solicitud == $alum->id and $sino->id_tipo == 4)
                                                                    <div class=" form-label-group">
                                                                        @foreach ($profesores as $prof)
                                                                            @if ($prof->id == $sino->id_profesor)
                                                                                <label for="inputCarrera">Vocal
                                                                                    Suplente</label>
                                                                                <input disabled id="inputCarrera"
                                                                                    name="f_ingreso" type="text"
                                                                                    class="form-control"
                                                                                    placeholder="{{ $prof->p_nombre }}"
                                                                                    required />

                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                            <!----------- Fin Vocal Propietario -------------->
                                                        @endif
                                                        <!---------------END Asignacion de sinodales --------------->
                                                        <hr class="my-4">

                                                        <!--- Formulario para enviar peticion --->
                                                        @if ($alum->s_estatus == 9)

                                                        <div id="content">
                                                            <h5 class="centrar">Adjuntar Oficio Alumno Titulado:
                                                            </h5>
                                                            <div class=" form-label-group" hidden>
                                                                <label for="inputAp">URL del oficio</label>
                                                                <input id="inputAp" name="oficio_liberacion_proyecto"
                                                                    type="text" class="form-control" placeholder="" />
                                                                <input hidden type="text" id="last-name"
                                                                    name="alumno_titulado" value="si"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="input-group image-preview">
                                                                    <span class="input-group-btn">
                                                                        <div
                                                                            class="btn btn-default carga-archivo-input">
                                                                            <span
                                                                                class="glyphicon glyphicon-folder-open"></span>
                                                                            <span
                                                                                class="carga-archivo-input-title">Seleccionar
                                                                                archivo</span>
                                                                            <input type="file" accept="application/pdf"
                                                                                name="oficio_titulado" />
                                                                        </div>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br><br>
                                                        <div class="row">
                                                            <div class="col-xs-6 col-centrada">
                                                                <button type="submit"
                                                                    class="btn btn-success btn-block">Enviar</button>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                @if ($alum->s_estatus == 12 or $alum->s_estatus == 10)
                                                    <div class="row cent" hidden>
                                                        <div class="col-xs-6 col-centrada">
                                                            <h2 class="">¿Concluir tramite ?</h2>
                                                            <br>
                                                            <button type="button" class="btn btn-success btn-block"
                                                                data-toggle="modal"
                                                                data-target="#basicAcept{{ $alum->id }}">Enviar</button>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade" id="basicAcept{{ $alum->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="basicCancel"
                                                        aria-hidden="true" hidden>
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h4>¿Concluir tramite?</h4>
                                                                    <input hidden type="text" id="last-name"
                                                                        name="concluye_tramite" value="si"
                                                                        class="form-control">
                                                                    <input hidden type="text" id="last-name"
                                                                        name="solicitud" value="{{ $alum->id }}"
                                                                        class="form-control">
                                                                    <div class="form-group">
                                                                        <h4>Adjuntar archivo</h4>
                                                                        <div class="input-group image-preview">
                                                                            <span class="input-group-btn">
                                                                                <div
                                                                                    class="btn btn-default carga-archivo-input">
                                                                                    <span
                                                                                        class="glyphicon glyphicon-folder-open"></span>
                                                                                    <span
                                                                                        class="carga-archivo-input-title">Seleccionar
                                                                                        archivo</span>
                                                                                    <input type="file"
                                                                                        accept="application/pdf"
                                                                                        name="input_file" />
                                                                                </div>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <button type="submit"
                                                                        class="btn btn-success btn-block">Confirmar</button>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default"
                                                                        data-dismiss="modal">Cerrar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
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
