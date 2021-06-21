@extends('layouts.cabeceraCSE')
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
                        <i class="fa fa-dashboard"></i> Alumnos/<STRONG>Solicitudes</STRONG>
                    </li>
                </ol>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
            </div>
            @if (Session::has('message'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="card-body">
                <!-- table -->
                <div class="row">
                    <div class="col-md-12 register-right">
                        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist"></ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active table-responsive" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <br>
                                <table id="example" class="table table-striped jambo_table ">
                                    <thead>
                                        <tr>
                                            <th># Control</th>
                                            <th>Nombre</th>
                                            <th>Apellido Paterno</th>
                                            <th>Apellido Materno</th>
                                            <th>Carrera</th>
                                            <th>Plan&nbsp;&nbsp;&nbsp;</th>
                                            <th>Opcion de titulación</th>
                                            <th>Estatus</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($alumno as $alum)
                                            @if ($alum->id_optitulacion == 4)
                                                <tr class="centrar">
                                                    <td>{{ $alum->n_control }}</td>
                                                    <td>{{ $alum->p_nombre }} {{ $alum->s_nombre }}</td>
                                                    <td>{{ $alum->a_paterno }}</td>
                                                    <td>{{ $alum->a_materno }}</td>
                                                    @foreach ($carreras as $carr)
                                                        @if ($alum->id_carrera == $carr->id)
                                                            <td>{{ $carr->nombre }}</td>
                                                        @endif
                                                    @endforeach

                                                    @foreach ($planes as $plan)
                                                        @if ($alum->id_plan == $plan->id)
                                                            <td>{{ $plan->nombre }}</td>
                                                        @endif
                                                    @endforeach
                                                    @foreach ($titulacion as $op_t)
                                                        @if ($alum->id_optitulacion == $op_t->id)
                                                            <td>{{ $op_t->nombre }}</td>
                                                        @endif
                                                    @endforeach
                                                    @foreach ($estatus as $est)
                                                        @if ($alum->s_estatus == $est->id)
                                                            <td>{{ $est->nombre }}</td>
                                                        @endif
                                                    @endforeach
                                                    <td style="white-space:nowrap !important;">
                                                        <a href="#" class="btn btn-lg btn-success btn-sm"
                                                            data-toggle="modal" data-target="#M{{ $alum->id }}"
                                                            title="Ver" style="display: inline-block !important; "><i
                                                                class="fa fa-eye" aria-hidden="true"></i></a>

                                                        @if ($alum->s_estatus == 9)
                                                            <a href="{{ route('solicitudDetalleCSE', $alum->id) }}"
                                                                class="btn btn-lg btn-success btn-sm"
                                                                title="Dar seguimiento a solicitud"
                                                                style="display: inline-block !important;"><i
                                                                    class="fa fa-exclamation" aria-hidden="true"></i></a>
                                                        @endif

                                                    </td>
                                                </tr>
                                            @else
                                                @if ($alum->s_estatus != 2)
                                                    <tr class="centrar">
                                                        <td>{{ $alum->n_control }}</td>
                                                        <td>{{ $alum->p_nombre }} {{ $alum->s_nombre }}</td>
                                                        <td>{{ $alum->a_paterno }}</td>
                                                        <td>{{ $alum->a_materno }}</td>
                                                        @foreach ($carreras as $carr)
                                                            @if ($alum->id_carrera == $carr->id)
                                                                <td>{{ $carr->nombre }}</td>
                                                            @endif
                                                        @endforeach

                                                        @foreach ($planes as $plan)
                                                            @if ($alum->id_plan == $plan->id)
                                                                <td>{{ $plan->nombre }}</td>
                                                            @endif
                                                        @endforeach
                                                        @foreach ($titulacion as $op_t)
                                                            @if ($alum->id_optitulacion == $op_t->id)
                                                                <td>{{ $op_t->nombre }}</td>
                                                            @endif
                                                        @endforeach
                                                        @foreach ($estatus as $est)
                                                            @if ($alum->s_estatus == $est->id)
                                                                <td>{{ $est->nombre }}</td>
                                                            @endif
                                                        @endforeach
                                                        <td style="white-space:nowrap !important;">
                                                            <a href="#" class="btn btn-lg btn-success btn-sm"
                                                                data-toggle="modal" data-target="#M{{ $alum->id }}"
                                                                title="Ver" style="display: inline-block !important; "><i
                                                                    class="fa fa-eye" aria-hidden="true"></i></a>

                                                            @if ($alum->s_estatus == 9)
                                                                <a href="{{ route('solicitudDetalleCSE', $alum->id) }}"
                                                                    class="btn btn-lg btn-success btn-sm"
                                                                    title="Dar seguimiento a solicitud"
                                                                    style="display: inline-block !important;"><i
                                                                        class="fa fa-exclamation"
                                                                        aria-hidden="true"></i></a>
                                                            @endif

                                                        </td>
                                                    </tr>

                                                @endif
                                            @endif

                                        @endforeach
                                    </tbody>
                                </table>
                                @foreach ($alumno as $alum)
                                    <!-- basic modal -->
                                    <div class="modal fade " id="M{{ $alum->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="M{{ $alum->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Solicitud Alumno</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container register">
                                                        <div class="row">
                                                            <div class="col-md-12 register-right">
                                                                <div class="tab-content" id="myTabContent">
                                                                    <div class="tab-pane fade show active" id="home"
                                                                        role="tabpanel" aria-labelledby="home-tab">
                                                                        <div class="row ">
                                                                            <div class="col-md-6">
                                                                                <div class="">
                                                                                    <label for="inputfirstName">Primer
                                                                                        Nombre</label>
                                                                                    <input disabled id="inputfirstName"
                                                                                        type="text"
                                                                                        class="form-control  @error('name') is-invalid @enderror"
                                                                                        name="p_name"
                                                                                        value="{{ $alum->p_nombre }}"
                                                                                        autocomplete="name"
                                                                                        placeholder="{{ $alum->p_nombre }}"
                                                                                        required autofocus />
                                                                                </div>
                                                                                <div class=" form-label-group">
                                                                                    <label for="inputSecondName">Segundo
                                                                                        Nombre</label>
                                                                                    <input disabled id="inputSecondName"
                                                                                        name="s_name" type="text"
                                                                                        class="form-control"
                                                                                        placeholder="{{ $alum->s_nombre }}" />
                                                                                </div>
                                                                                <div class=" form-label-group">
                                                                                    <label for="inputAp">Apellido
                                                                                        Paterno</label>
                                                                                    <input disabled id="inputAp"
                                                                                        name="ap_paterno" type="text"
                                                                                        class="form-control"
                                                                                        placeholder="{{ $alum->a_paterno }}"
                                                                                        required />
                                                                                </div>
                                                                                <div class=" form-label-group">
                                                                                    <label for="inputAm">Apellido
                                                                                        Materno</label>
                                                                                    <input disabled id="inputAm"
                                                                                        name="ap_materno" type="text"
                                                                                        class="form-control"
                                                                                        placeholder="{{ $alum->a_materno }}"
                                                                                        required />
                                                                                </div>
                                                                                <div class=" form-label-group">
                                                                                    <label for="inputemail2">Segundo
                                                                                        Correo</label>
                                                                                    <input disabled id="inputemail2"
                                                                                        name="email2" type="email"
                                                                                        class="form-control"
                                                                                        placeholder="{{ $alum->s_correo }}" />
                                                                                </div>
                                                                                <div class=" form-label-group">
                                                                                    <label for="inputtel">Telefono de
                                                                                        Casa</label>
                                                                                    <input disabled id="inputtel" name="tel"
                                                                                        type="tel" class="form-control"
                                                                                        placeholder="{{ $alum->telefono }}" />
                                                                                </div>
                                                                                <div class=" form-label-group">
                                                                                    <label for="inputtel2">Celular</label>
                                                                                    <input disabled id="inputtel2"
                                                                                        name="cel" type="tel" minlength="10"
                                                                                        maxlength="10" class="form-control"
                                                                                        placeholder="{{ $alum->celular }}"
                                                                                        required />
                                                                                </div>
                                                                                <div class=" form-label-group">
                                                                                    <label
                                                                                        for="inputciudad">Municipio</label>
                                                                                    <input disabled id="inputciudad"
                                                                                        name="municipio" type="text"
                                                                                        class="form-control"
                                                                                        placeholder="{{ $alum->municipio }}"
                                                                                        required />
                                                                                </div>
                                                                                <div class=" form-label-group">
                                                                                    <label for="inputcp">CP</label>
                                                                                    <input disabled id="inputcp" name="cp"
                                                                                        type="text" class="form-control"
                                                                                        placeholder="{{ $alum->cp }}"
                                                                                        required required />
                                                                                </div>
                                                                                <div class=" form-label-group">
                                                                                    <label for="inputestado">Entidad
                                                                                        Federativa</label>
                                                                                    <input disabled id="inputestado"
                                                                                        name="entidad" type="text"
                                                                                        class="form-control"
                                                                                        placeholder="{{ $alum->entidad_f }}"
                                                                                        required />
                                                                                </div>
                                                                                <div class=" form-label-group">
                                                                                    <label for="inputNcontrol">Numero
                                                                                        de Control</label>
                                                                                    <input disabled id="inputNcontrol"
                                                                                        name="n_control" type="text"
                                                                                        class="form-control"
                                                                                        placeholder="{{ $alum->n_control }}"
                                                                                        required />
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class=" form-label-group">
                                                                                    <label
                                                                                        for="inputCarrera">Carrera</label>
                                                                                    @foreach ($carreras as $carr)
                                                                                        @if ($alum->id_carrera == $carr->id)
                                                                                            <input disabled
                                                                                                id="inputCarrera"
                                                                                                name="carrera" type="text"
                                                                                                class="form-control"
                                                                                                placeholder="{{ $carr->nombre }}"
                                                                                                required />
                                                                                        @endif
                                                                                    @endforeach
                                                                                </div>
                                                                                <div class=" form-label-group">
                                                                                    <label for="inputCarrera">Plan</label>
                                                                                    @foreach ($planes as $plan)
                                                                                        @if ($alum->id_plan == $plan->id)
                                                                                            <input disabled
                                                                                                id="inputCarrera"
                                                                                                name="plan" type="text"
                                                                                                class="form-control"
                                                                                                placeholder="{{ $plan->nombre }}"
                                                                                                required />
                                                                                        @endif
                                                                                    @endforeach
                                                                                </div>
                                                                                <div class=" form-label-group">
                                                                                    <label for="inputCarrera">Fecha de
                                                                                        Ingreso</label>
                                                                                    <input disabled id="inputCarrera"
                                                                                        name="f_ingreso" type="text"
                                                                                        class="form-control"
                                                                                        placeholder="{{ $alum->f_ingreso }}"
                                                                                        required />
                                                                                </div>
                                                                                <div class=" form-label-group">
                                                                                    <label for="inputCarrera">Fecha de
                                                                                        Egreso</label>
                                                                                    <input disabled id="inputCarrera"
                                                                                        name="f_egreso" type="text"
                                                                                        class="form-control"
                                                                                        placeholder="{{ $alum->f_egreso }}"
                                                                                        required />
                                                                                </div>
                                                                                <div class=" form-label-group">
                                                                                    <label for="inputCarrera">Opcion
                                                                                        de titulacion</label>
                                                                                    @foreach ($titulacion as $op_t)
                                                                                        @if ($alum->id_optitulacion == $op_t->id)
                                                                                            <input disabled
                                                                                                id="inputCarrera"
                                                                                                name="op_titulacion"
                                                                                                type="text"
                                                                                                class="form-control"
                                                                                                placeholder="{{ $op_t->nombre }}"
                                                                                                required />
                                                                                        @endif
                                                                                    @endforeach
                                                                                </div>
                                                                                <div class=" form-label-group">
                                                                                    <label for="inputCarrera">Repositorio de
                                                                                        archivos</label>
                                                                                    <input readonly id="inputCarrera"
                                                                                        name="f_egreso" type="text"
                                                                                        class="form-control"
                                                                                        placeholder="{{ $alum->repositorio_documentos }}"
                                                                                        required
                                                                                        value="{{ $alum->repositorio_documentos }}" />

                                                                                </div>
                                                                                @if ($alum->id_optitulacion != 4)
                                                                                    <div class=" form-label-group"><label
                                                                                            for="inputCarrera">Archivo</label>
                                                                                        <a href="{{ route('descargar_archivo', $alum->proy_archivo) }}"
                                                                                            download="proyecto_{{ $alum->n_control }}.pdf"><button
                                                                                                class="btn btn-success pull-right form-control"
                                                                                                style="margin-right: 5px;"><i
                                                                                                    class="fa fa-cloud-download"></i>&nbsp;&nbsp;<i
                                                                                                    class="fa fa-file-pdf-o"></i>&nbsp;Descargar
                                                                                                Archivo</button></a>
                                                                                    </div>
                                                                                    <div class=" form-label-group">
                                                                                        <label for="inputCarrera">Asesor
                                                                                            Interno</label>
                                                                                        @foreach ($profesores as $prof)
                                                                                            @if ($alum->id_asesor == $prof->id)
                                                                                                <input disabled
                                                                                                    id="inputCarrera"
                                                                                                    name="carrera"
                                                                                                    type="text"
                                                                                                    class="form-control"
                                                                                                    placeholder="{{ $prof->p_nombre }}"
                                                                                                    required />
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </div>
                                                                                @endif
                                                                                <!-- validados la solicitud para asignar rev-->
                                                                                @if ($alum->id_optitulacion != 4)

                                                                                @else
                                                                                    @if ($alum->s_estatus > 8)
                                                                                        <br>
                                                                                        <h5 class="centrar">Sinodales</h5>
                                                                                        <br>
                                                                                        <!----------- Presidente -------------->

                                                                                        @foreach ($sinodales as $sino)
                                                                                            @if ($sino->id_solicitud == $alum->id and $sino->id_tipo == 1)
                                                                                                <div
                                                                                                    class=" form-label-group">
                                                                                                    @foreach ($profesores as $prof)
                                                                                                        @if ($prof->id == $sino->id_profesor)
                                                                                                            <label
                                                                                                                for="inputCarrera">Presidente </label>
                                                                                                            <input disabled
                                                                                                                id="inputCarrera"
                                                                                                                name="f_ingreso"
                                                                                                                type="text"
                                                                                                                class="form-control"
                                                                                                                placeholder="{{ $prof->p_nombre }}"
                                                                                                                required />
                                                                                                            @foreach ($estatus2 as $est)
                                                                                                                @if ($sino->id_estatus == $est->id)
                                                                                                                    <small
                                                                                                                        class="text-danger">*Estatus:
                                                                                                                        {{ $est->nombre }}
                                                                                                                    </small>
                                                                                                                @endif
                                                                                                            @endforeach
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                </div>
                                                                                            @endif
                                                                                        @endforeach

                                                                                        <!----------- Fin Presidente -------------->
                                                                                        <!----------- Secretario -------------->
                                                                                        @foreach ($sinodales as $sino)
                                                                                            @if ($sino->id_solicitud == $alum->id and $sino->id_tipo == 2)
                                                                                                <div
                                                                                                    class=" form-label-group">
                                                                                                    @foreach ($profesores as $prof)
                                                                                                        @if ($prof->id == $sino->id_profesor)
                                                                                                            <label
                                                                                                                for="inputCarrera">Secretario</label>
                                                                                                            <input disabled
                                                                                                                id="inputCarrera"
                                                                                                                name="f_ingreso"
                                                                                                                type="text"
                                                                                                                class="form-control"
                                                                                                                placeholder="{{ $prof->p_nombre }}"
                                                                                                                required />
                                                                                                            @foreach ($estatus2 as $est)
                                                                                                                @if ($sino->id_estatus == $est->id)
                                                                                                                    <small
                                                                                                                        class="text-danger">*Estatus:
                                                                                                                        {{ $est->nombre }}
                                                                                                                    </small>
                                                                                                                @endif
                                                                                                            @endforeach
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                </div>
                                                                                            @endif
                                                                                        @endforeach
                                                                                        <!----------- Fin Secretario -------------->
                                                                                        <!----------- Vocal Propietario -------------->
                                                                                        @foreach ($sinodales as $sino)
                                                                                            @if ($sino->id_solicitud == $alum->id and $sino->id_tipo == 3)
                                                                                                <div
                                                                                                    class=" form-label-group">
                                                                                                    @foreach ($profesores as $prof)
                                                                                                        @if ($prof->id == $sino->id_profesor)
                                                                                                            <label
                                                                                                                for="inputCarrera">Vocal
                                                                                                                Propietario</label>
                                                                                                            <input disabled
                                                                                                                id="inputCarrera"
                                                                                                                name="f_ingreso"
                                                                                                                type="text"
                                                                                                                class="form-control"
                                                                                                                placeholder="{{ $prof->p_nombre }}"
                                                                                                                required />
                                                                                                            @foreach ($estatus2 as $est)
                                                                                                                @if ($sino->id_estatus == $est->id)
                                                                                                                    <small
                                                                                                                        class="text-danger">*Estatus:
                                                                                                                        {{ $est->nombre }}
                                                                                                                    </small>
                                                                                                                @endif
                                                                                                            @endforeach
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                </div>
                                                                                            @endif
                                                                                        @endforeach
                                                                                        <!----------- Fin Vocal Propietario -------------->
                                                                                        <!----------- Vocal Suplente -------------->
                                                                                        @foreach ($sinodales as $sino)
                                                                                            @if ($sino->id_solicitud == $alum->id and $sino->id_tipo == 4)
                                                                                                <div
                                                                                                    class=" form-label-group">
                                                                                                    @foreach ($profesores as $prof)
                                                                                                        @if ($prof->id == $sino->id_profesor)
                                                                                                            <label
                                                                                                                for="inputCarrera">Vocal
                                                                                                                Suplente</label>
                                                                                                            <input disabled
                                                                                                                id="inputCarrera"
                                                                                                                name="f_ingreso"
                                                                                                                type="text"
                                                                                                                class="form-control"
                                                                                                                placeholder="{{ $prof->p_nombre }}"
                                                                                                                required />
                                                                                                            @foreach ($estatus2 as $est)
                                                                                                                @if ($sino->id_estatus == $est->id)
                                                                                                                    <small
                                                                                                                        class="text-danger">*Estatus:
                                                                                                                        {{ $est->nombre }}
                                                                                                                    </small>
                                                                                                                @endif
                                                                                                            @endforeach
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                </div>
                                                                                            @endif
                                                                                        @endforeach
                                                                                        <!----------- Fin Vocal Propietario -------------->

                                                                                    @endif



                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <!-- basic modal END-->
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
