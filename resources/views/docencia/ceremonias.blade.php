@extends('layouts.cabeceraDc')

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
                    <i class="fa fa-dashboard"></i> Docencia/Ceremonias<STRONG>/Modificar</STRONG>
                </li>
            </ol>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
        </div>
        @if (Session::has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ Session::get('message') }}
        </div>
        @endif
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 register-right">
                    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist"></ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active table-responsive" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <br>
                            <table id="example" class="table table-striped jambo_table ">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Ceremonia del alumno</th>
                                        <th scope="col">Descripcion</th>
                                        <th scope="col">Sala</th>
                                        <th scope="col">Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $t = 0; ?>
                                    @foreach ($ceremonias as $doc)
                                    <tr class="centrar">
                                        <td>{{ $t+1 }}</td>
                                        @foreach ($alumnos as $alum)
                                        @if ($doc->id_solicitud == $alum->id)
                                        <td>{{ $alum->p_nombre }} {{ $alum->s_nombre }}
                                            {{ $alum->a_paterno }} {{ $alum->a_materno }}
                                        </td>
                                        @endif
                                        @endforeach
                                        <td>{{ $doc->descripcion }}</td>
                                        @foreach ($salas as $sal)
                                        @if ($doc->id_sala == $sal->id)
                                        <td>{{ $sal->nombre }} </td>
                                        @endif
                                        @endforeach
                                        <td>{{ $doc->fecha }} {{ $doc->hora }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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