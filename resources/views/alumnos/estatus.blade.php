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
                        <i class="fa fa-dashboard"></i> Alumno/Solicitud/<STRONG>Estatus</STRONG>
                    </li>
                </ol>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>Estatus de la Solicitud</h5>
            </div>
            <div class="card-body">
                @if (count($estatus) > 0)
                    <div class="x_content">
                        <ul class="list-unstyled timeline">
                            @foreach ($estatus as $estat)
                                <li>
                                    <div class="block">
                                        <div class="tags">
                                            <a href="" class="tag ">
                                                <span data-toggle="tooltip" data-placement="top" title=""
                                                    data-original-title="{{ $estat->nombre }}">{{ $estat->nombre }}</span>
                                            </a>
                                        </div>
                                        <div class="block_content">
                                            <h2 class="title">
                                                <a>{{ $estat->descripcion }}&nbsp;</a>
                                            </h2>
                                            <div class="byline">

                                            </div>
                                            <p class="excerpt">{{ $estat->descripcion }}
                                                <a>&nbsp;</a></br>
                                                <br>
                                                @if ($estat->id_estatus == 17)
                                                    <a class="btn btn-app" data-toggle="modal"
                                                        data-target=".bs-example-modal-sm">
                                                        <i class="fa fa-calendar"></i> Ver Detalle
                                                        <span class="badge bg-orange">Nuevo!</span>
                                                    </a>

                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                    <!------------------------------- Modal --------------------------------------------->
                    @if (count($ceremonia) > 0)
                        @foreach ($ceremonia as $cer)
                            <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true"
                                style="display: none;">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-calendar"></i>
                                                Detalles de la Ceremonia</h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <h5 class="centrar"><b><i class="fa fa-mortar-board"></i> Evento de
                                                    Titulacion</b></h5>
                                            <ul class="list-unstyled project_files">
                                                <li>
                                                    <h6><b> <i class="fa fa-institution"></i> Sala:</b> {{ $cer->nombre }}
                                                    </h6>
                                                </li>
                                                <li>
                                                    <h6><b><i class="fa fa-calendar-o"></i> Fecha:</b>
                                                        {{ date_format(new DateTime($cer->fecha), 'd/m/Y') }}</h6>
                                                </li>
                                                <li>
                                                    <h6><b><i class="fa fa-clock-o"></i> Hora:</b>
                                                        {{ date_format(new DateTime($cer->hora), 'H:i:s A') }}</h6>
                                                </li>
                                                <li>
                                                    <h6><b><i class="fa fa-warning"></i> Detalles:</b>
                                                        {{ $cer->descripcion }}</h6>
                                                </li>

                                            </ul>
                                            <hr>
                                            <h5 class="centrar"><b><i class="fa fa-group"></i> Sinodales</b></h5>
                                            @foreach ($sinodales as $sino)
                                                @if ($sino->id_tipo == 1)
                                                    <h6><b>Presidente:</b> {{ $sino->p_nombre }} {{ $sino->s_nombre }}
                                                        {{ $sino->a_paterno }} {{ $sino->a_materno }}</h6>
                                                @endif
                                                @if ($sino->id_tipo == 2)
                                                    <h6><b>Secretario:</b> {{ $sino->p_nombre }} {{ $sino->s_nombre }}
                                                        {{ $sino->a_paterno }} {{ $sino->a_materno }}</h6>
                                                @endif
                                                @if ($sino->id_tipo == 3)
                                                    <h6><b>Vocal:</b> {{ $sino->p_nombre }} {{ $sino->s_nombre }}
                                                        {{ $sino->a_paterno }} {{ $sino->a_materno }}</h6>
                                                @endif
                                                @if ($sino->id_tipo == 4)
                                                    <h6><b>Vocal Suplente:</b> {{ $sino->p_nombre }} {{ $sino->s_nombre }}
                                                        {{ $sino->a_paterno }} {{ $sino->a_materno }}</h6>
                                                @endif

                                            @endforeach


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cerrar</button>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach

                    @endif
                    <!------------------------------- Modal --------------------------------------------->
                @else
                    <div align="center">
                        <h4>¿Deseas generar tu solicitud?</h4>
                        <a href="{{ route('/alumnos/solicitud/generar') }}">
                            <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i
                                    class="fa fa-download"></i> Generar</button>
                        </a>
                    </div>
                @endif
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
