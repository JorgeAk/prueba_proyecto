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
                <div class="container bootdey">
                    <div class="email-app mb-4">
                        <nav>
                            <a href="{{ route('/coordinacion/servicios_es/correo/mensajes/nuevo/crear') }}"
                                class="btn btn-success btn-block">Correo nuevo</a>
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('/coordinacion/servicios_es/correo/mensajes', 'inbox') }}"><i
                                            class="fa fa-inbox"></i>Bandeja<span
                                            class="badge badge-danger">{{ count($m_nuevos) }}</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('/coordinacion/servicios_es/correo/mensajes', 'enviados') }}"><i
                                            class="fa fa-rocket"></i> Enviados</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('/coordinacion/servicios_es/correo/mensajes', 'importantes') }}"><i
                                            class="fa fa-bookmark"></i> Importantes</a>
                                </li>
                            </ul>
                        </nav>
                        <main class="inbox">
                            <div class="toolbar">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-light">
                                        <a href="{{ route('/coordinacion/servicios_es/correo/mensajes/nuevo/crear') }}">
                                            <span class="fa fa-envelope"></span> </a>
                                    </button>
                                    <button type="button" class="btn btn-light">
                                        <span class="fa fa-star"></span>
                                    </button>
                                    <button type="button" class="btn btn-light">
                                        <span class="fa fa-star-o"></span>
                                    </button>
                                    <button type="button" class="btn btn-light">
                                        <a
                                            href="{{ route('/coordinacion/servicios_es/correo/mensajes', 'importantes') }}">
                                            <span class="fa fa-bookmark-o"></span> </a>
                                    </button>
                                </div>
                                <div class="btn-group float-right">
                                    @if (count($enviados) > 0)
                                        {{ $enviados->links() }}
                                    @endif
                                </div>
                            </div>
                            <!-- MENSAJES ----->
                            <ul class="messages">
                                @if (count($enviados) > 0)
                                    @foreach ($enviados as $rec)
                                        <li class="message">
                                            <a
                                                href="{{ route('/coordinacion/servicios_es/mensajeSe_Detalle_r2', $rec->id) }}">
                                                <div class="actions">
                                                    <span class="action"><i class="fa fa-check-square-o"></i></span>
                                                    <span class="action"><i class="fa fa-star"></i></span>
                                                </div>
                                                <div class="header">
                                                    <span class="from"><b>Para:</b> {{ $rec->receptor }}</span>

                                                    <span class="date">
                                                        <span class="fa fa-calendar"></span>
                                                        {{ date_format(new DateTime($rec->created_at), 'd/m/Y H:i:s A') }}</span>
                                                </div>
                                                <div class="title"><b>Asunto:</b> {{ $rec->asunto }}</div>
                                                <div class="description">
                                                    {{ str_limit($rec->mensaje, $limit = 150, $end = '...') }}</div>
                                            </a>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="message">
                                        <a href="#">
                                            <div class="actions">
                                                <span class="action"><i class="fa fa-square-o"></i></span>
                                            </div>
                                            <div class="header">
                                                <span class="from">Sin mensajes</span>
                                                <span class="date"><span class="fa fa-calendar"></span>
                                                    {{ date('d/m/Y H:i:s A') }}</span>
                                            </div>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                            <!-- MENSAJES ----->
                        </main>
                    </div>
                </div>
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
