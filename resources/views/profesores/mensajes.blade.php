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
                        <i class="fa fa-dashboard"></i> Profesor/<STRONG>Home</STRONG>
                    </li>
                </ol>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>Solicitud Titulación</h5>
            </div>
            @if (Session::has('message'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="card-body">

                @if (!empty($solicitud))

                    <table id="example" class="table table-striped jambo_table ">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Alumno</th>
                                <th scope="col">Disponibilidad</th>
                                <th scope="col">Mensaje</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 1; ?>
                            @foreach ($revisores as $revisor)
                                @foreach ($solicitud as $sol)

                                    @if ($sol->id == $revisor->id_solicitud and $revisor->id_estatus == 5)
                                        <tr class="">
                                            <td scope="row">{{ $total }}</td>
                                            <td>{{ $sol->p_nombre }} {{ $sol->s_nombre }} {{ $sol->a_paterno }}
                                                {{ $sol->a_materno }}</td>
                                            <td>Disponible</td>
                                            <td>
                                                <a type="button"
                                                    class="btn btn-info btn-xs btn-labeled fa fa-location-arrow"
                                                    data-original-title="Ver mensajes" data-toggle="modal"
                                                    onclick="actualiza('{{ $revisor->id }}')"
                                                    data-target="#mi_modal{{ $revisor->id }}">
                                                    Ver Mensaje </a>
                                            </td>
                                        </tr>
                                        <?php $total++; ?>
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    @foreach ($revisores as $revisor)
                        <!-- Modal -->
                        <div class="modal fade" id="mi_modal{{ $revisor->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="panel-heading ">
                                            <div class="col-md-12 col-xs-12">
                                                @foreach ($solicitud as $sol)
                                                    @if ($sol->id == $revisor->id_solicitud)
                                                        <h4 class="panel-title"><span
                                                                class="glyphicon glyphicon-comment"></span> Chat -
                                                            {{ $sol->p_nombre }} {{ $sol->s_nombre }}
                                                            {{ $sol->a_paterno }} {{ $sol->a_materno }}</h4>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <button type="button" class="close btn btn-default btn-xs" data-dismiss="modal">
                                            <span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- contenedor -->
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="panel panel-primary">

                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="chatbody">
                                                        <div class="panel panel-primary">
                                                            <div class="panel-body msg_container_base">
                                                                @foreach ($mensajes as $mensaje)
                                                                    @if ($mensaje->usuario_envio == Auth::user()->username and $revisor->id == $mensaje->id_revisor)
                                                                        <div class="row msg_container base_sent">
                                                                            <div class="col-md-10 col-xs-10">

                                                                                <div class="messages msg_sent ">
                                                                                    <p>{{ $mensaje->mensaje }}</p>
                                                                                    <time
                                                                                        datetime="{{ $mensaje->fecha }}">
                                                                                        @foreach ($profesores as $prof)
                                                                                            @if ($prof->id == $revisor->id_profesor)
                                                                                                {{ $prof->p_nombre }}
                                                                                            @endif
                                                                                        @endforeach
                                                                                        • {{ $mensaje->fecha }}
                                                                                    </time>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-2 col-xs-2 avatar">

                                                                                <img src="{{ asset('/res/imagen/default.png') }}"
                                                                                    class=" img-responsive"
                                                                                    data-toggle="tooltip"
                                                                                    data-original-title="Yo"
                                                                                    data-container="body">
                                                                            </div>
                                                                        </div>

                                                                    @else
                                                                        @if ($mensaje->receptor == Auth::user()->username and $revisor->id == $mensaje->id_revisor)
                                                                            <div class="row msg_container base_receive">
                                                                                <div class="col-md-2 col-xs-2 avatar">
                                                                                    <img src="{{ asset('/res/imagen/default.png') }}"
                                                                                        class=" img-responsive ">
                                                                                </div>
                                                                                <div class="col-md-10 col-xs-10">
                                                                                    <div class="messages msg_receive">
                                                                                        <p>{{ $mensaje->mensaje }}</p>
                                                                                        <time
                                                                                            datetime="{{ $mensaje->fecha }}">
                                                                                            @foreach ($solicitud as $sol)
                                                                                                @if ($mensaje->id_solicitud == $sol->id)
                                                                                                    {{ $sol->p_nombre }}
                                                                                                @endif
                                                                                            @endforeach
                                                                                            • {{ $mensaje->fecha }}
                                                                                        </time>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                            <form method="POST" enctype="multipart/form-data"
                                                                action="{{ route('/profesor/mensajes/nuevo') }}">
                                                                @csrf
                                                                <div class="panel-footer">
                                                                    <div class="input-group">
                                                                        <input hidden type="text" id="last-name"
                                                                            name="revisor" value="{{ $revisor->id }}"
                                                                            class="form-control">
                                                                        <input hidden type="text" id="last-name"
                                                                            name="solicitud"
                                                                            value="{{ $revisor->id_solicitud }}"
                                                                            class="form-control">
                                                                        <input id="btn-input" type="text"
                                                                            class="form-control input-sm chat_input"
                                                                            name="mensaje"
                                                                            placeholder="Escribe tu mensaje..." />
                                                                        <span class="input-group-btn">
                                                                            <button class="btn btn-primary btn-sm"
                                                                                id="btn-chat"><i class="fa fa-send fa-1x"
                                                                                    aria-hidden="true"></i></button>
                                                                        </span>

                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- contenedor -->
                                        </div>
                                        <div class="modal-footer">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                    @endforeach
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
