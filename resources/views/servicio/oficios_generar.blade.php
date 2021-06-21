@extends('layouts.cabeceraSS')

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
                        <i class="fa fa-dashboard"></i> Docencia/Oficios<STRONG>/Agregar</STRONG>
                    </li>
                </ol>
            </div>
        </div>
        <div class="card">

            <div class="card-header">
                <!---- FORM ----->
                <div class="x_content">
                    <br>
                    <form id="demo-form2" class="form-horizontal form-label-left" method="POST"
                        action="{{ route('/servicio/oficios/imprimir') }}">
                        @csrf

                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3 ">Oficio</label>
                            <div class="col-md-9 col-sm-9 ">
                                <select id="status" class="form-control" name="tipo_oficio"
                                    onChange="mostrar_oficio(this.value);" required>
                                    <option value="" selected disabled>Oficio</option>
                                    @foreach ($oficios as $oficio)
                                        <option value="{{ $oficio->id }}">{{ $oficio->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!---------------------- Oficio 1 ------------------------------------------------->
                        <div id="of1" style="display: none;">

                          <div class="form-group row" id="id_alum">
                            <label class="control-label col-md-3 col-sm-3 ">Alumno</label>
                            <div class="col-md-9 col-sm-9 ">
                                <select class="form-control"  name="id_alumno" required>
                                    <option value="" selected disabled>Selecciona alumno</option>
                                    @foreach ($alumnos as $alum)
                                        <option value="{{ $alum->id }}">{{ $alum->p_nombre }}
                                            {{ $alum->s_nombre }}
                                            {{ $alum->a_paterno }} {{ $alum->a_materno }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>                  
<!--
                            <div class="form-group row" id="id_num_of">
                                <label class="control-label col-md-3 col-sm-3 " for="first-name">Numero de oficio:<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" id="first-name" name="num_oficio" class="form-control ">
                                </div>
                            </div>


                            <div class="form-group row" id="id_dirigido">
                                <label class="control-label col-md-3 col-sm-3 " for="first-name">Dirigido a:<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" id="first-name" name="dirigido" class="form-control ">
                                </div>
                            </div>
                            <div class="form-group row" id="id_puesto">
                                <label class="control-label col-md-3 col-sm-3 " for="first-name">Puesto<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" id="first-name" name="puesto" class="form-control ">
                                </div>
                            </div>
                            

                            <div class="form-group row" id="id_jef_dep">
                                <label class="control-label col-md-3 col-sm-3 " for="first-name">Jeje del departamento
                                    :<span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" id="first-name" name="genero" class="form-control ">
                                </div>
                            </div>

                            <div class="form-group row" id="id_jef_dep_depp">
                                <label class="control-label col-md-3 col-sm-3 " for="first-name">Departamento<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" id="first-name" name="departamento" class="form-control ">
                                </div>
                            </div>

                            <div class="form-group row" id="id_pres_aca">
                                <label class="control-label col-md-3 col-sm-3 " for="first-name">Presidente de la
                                    Academia<span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" id="first-name" name="n_presid_academia" class="form-control ">
                                </div>
                            </div>

                            <div class="form-group row" id="id_pres_aca_area">
                                <label class="control-label col-md-3 col-sm-3 " for="first-name">Area<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" id="first-name" name="n_area" class="form-control ">
                                </div>
                            </div>

                            <div class="form-group row" id="id_ccp_01">
                                <label class="control-label col-md-3 col-sm-3 " for="first-name">C.c.p/<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" id="first-name" name="ccp" class="form-control ">
                                </div>
                            </div>

                            <div class="form-group row" id="id_ccp_02">
                                <label class="control-label col-md-3 col-sm-3 " for="first-name">C.c.p/<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" id="first-name" name="ccp2" class="form-control ">
                                </div>
                            </div>

                            <div class="form-group row" id="id_aacr">
                                <label class="control-label col-md-3 col-sm-3 " for="first-name">AACR/<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" id="first-name" name="aacr" class="form-control ">
                                </div>
                            </div>
                          -->

                        </div>
                        <!---------------------- Oficio 1 ------------------------------------------------->
                        <!---------------------- Oficio 2 ------------------------------------------------->
                        <div id="of2">
                        </div>
                        <!---------------------- Oficio 2 ------------------------------------------------->
                        <!---------------------- Oficio 3 ------------------------------------------------->
                        <div id="of3" >
                        </div>
                        <!---------------------- Oficio 3 ------------------------------------------------->
                        <!---------------------- Oficio 4 ------------------------------------------------->
                        <div id="of4">
                        </div>
                        <!---------------------- Oficio 4 ------------------------------------------------->
                        <!---------------------- Oficio 5 ------------------------------------------------->
                        <div id="of5" >
                        </div>
                        <!---------------------- Oficio 5 ------------------------------------------------->
                        <!---------------------- Oficio 6 ------------------------------------------------->
                        <div id="of6" >
                        </div>
                        <!---------------------- Oficio 6 ------------------------------------------------->
                        <!---------------------- Oficio 7 ------------------------------------------------->
                        <div id="of7" >
                        </div>
                        <!---------------------- Oficio 7 ------------------------------------------------->
                        <!---------------------- Oficio 8 ------------------------------------------------->
                        <div id="of8" >
                        </div>
                        <!---------------------- Oficio 8 ------------------------------------------------->
                        <!---------------------- Oficio 10 ------------------------------------------------->
                        <div id="of10" >
                        </div>
                        <!---------------------- Oficio 10 ------------------------------------------------->
                        <!---------------------- Oficio 11 ------------------------------------------------->
                        <!---------------------- Oficio 11 ------------------------------------------------->

                        <!---------------------- Oficio 12 ------------------------------------------------->
                        <!---------------------- Oficio 12 ------------------------------------------------->

                        <!---------------------- Oficio 13 ------------------------------------------------->
                        <!---------------------- Oficio 13 ------------------------------------------------->

                        <!---------------------- Oficio 14 ------------------------------------------------->
                        <!---------------------- Oficio 14 ------------------------------------------------->

                        <!---------------------- Oficio 15 ------------------------------------------------->
                        <!---------------------- Oficio 15 ------------------------------------------------->

                        <!---------------------- Oficio 16 ------------------------------------------------->
                        <!---------------------- Oficio 16 ------------------------------------------------->

                        <!---------------------- Oficio 17 ------------------------------------------------->
                        <!---------------------- Oficio 17 ------------------------------------------------->

                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <button type="submit" class="btn btn-success">Generar</button>
                            </div>
                        </div>

                    </form>
                </div>
                <!---- END FORM ----->

            </div>
            @if (Session::has('message'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="card-body">
                <div class="row">

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
