@extends('layouts.cabeceraPr')

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
                    <i class="fa fa-dashboard"></i> Profesor/Bandeja/<STRONG></STRONG>
                </li>
            </ol>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5>Solicitud Titulación</h5>
        </div>
        @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{Session::get('message')}}
        </div>
        @endif
        <div class="card-body">
            <div class="container bootdey">
                <div class="email-app mb-4">
                    <nav>
                        <a href="{{ route('profesor/correo/mensajes/nuevo/crear') }}" class="btn btn-success btn-block">Correo nuevo</a>
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('profesor/correo/mensajes','inbox') }}"><i class="fa fa-inbox"></i>Bandeja<span class="badge badge-danger">{{ count($m_nuevos)}}</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('profesor/correo/mensajes','enviados') }}"><i class="fa fa-rocket"></i> Enviados</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('profesor/correo/mensajes','importantes') }}"><i class="fa fa-bookmark"></i> Importantes</a>
                            </li>
                        </ul>
                    </nav>
                    <main class="inbox">
                        <div class="toolbar">
                            <div class="btn-group">
                                <button type="button" class="btn btn-light">
                                    <a href="{{ route('profesor/correo/mensajes/nuevo/crear') }}"> <span class="fa fa-envelope"></span> </a>
                                </button>
                                <button type="button" class="btn btn-light">
                                    <span class="fa fa-star"></span>
                                </button>
                                <button type="button" class="btn btn-light">
                                    <span class="fa fa-star-o"></span>
                                </button>
                                <button type="button" class="btn btn-light">
                                    <a href="{{ route('profesor/correo/mensajes','importantes') }}"> <span class="fa fa-bookmark-o"></span> </a>
                                </button>
                            </div>
                            <div class="btn-group float-right">
                                @if (count($recibidos)>0)
                                {{ $recibidos->links() }}
                                @endif
                            </div>
                        </div>
                        <!-- MENSAJES ----->
                        <ul class="messages">
                            @if (count($recibidos)>0)
                            @foreach ($recibidos as $rec)
                            @if ($rec->estatus==1)
                            <li class="message unread">
                                <a href="{{ route('profesor/mensajeSe_Detalle', $rec->id) }}">
                                    <div class="actions">
                                        <span class="action"><i class="fa fa-square-o"></i></span>
                                        <span class="action"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="header">
                                        <span class="from"><b>De:</b> {{$rec->correo}}</span>
                                        <span class="date">
                                            <span class="fa fa-calendar"></span> {{date_format (new DateTime($rec->created_at), 'd/m/Y H:i:s A')}}</span>
                                    </div>
                                    <div class="title"><b>Asunto:</b> {{$rec->asunto}}</div>
                                    <div class="description">{{ str_limit($rec->mensaje, $limit = 150, $end = '...')  }}</div>
                                </a>
                            </li>
                            @endif
                            @if ($rec->estatus==2)
                            <li class="message">
                                <a href="{{ route('profesor/mensajeSe_Detalle', $rec->id) }}">
                                    <div class="actions">
                                        <span class="action"><i class="fa fa-check-square-o"></i></span>
                                        <span class="action"><i class="fa fa-star-o"></i></span>
                                    </div>
                                    <div class="header">
                                        <span class="from"><b>De:</b> {{$rec->correo}}</span>
                                        <span class="date">
                                            <span class=" fa fa-calendar"></span> {{date_format (new DateTime($rec->created_at), 'd/m/Y H:i:s A')}}</span>
                                    </div>
                                    <div class="title"><b>Asunto:</b> {{$rec->asunto}}</div>
                                    <div class="description">{{ str_limit($rec->mensaje, $limit = 150, $end = '...')  }}</div>
                                </a>
                            </li>
                            @endif
                            @endforeach
                            @else
                            <li class="message">
                                <a href="#">
                                    <div class="actions">
                                        <span class="action"><i class="fa fa-square-o"></i></span>
                                    </div>
                                    <div class="header">
                                        <span class="from">Sin mensajes</span>
                                        <span class="date"><span class="date fa fa-calendar"></span> {{ date('d/m/Y H:i:s A') }}</span>
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