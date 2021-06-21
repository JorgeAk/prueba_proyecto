@extends('layouts.cabeceraCT')

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
            <i class="fa fa-dashboard"></i> Docencia/Carreras<STRONG>/Agregar</STRONG>
          </li>
        </ol>
      </div>
    </div>
    <div class="card">

      <div class="card-header">
        <h4>Agregar nuevo Documento</h4>
      </div>
      @if(Session::has('message'))
      <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{Session::get('message')}}
      </div>
      @endif
      <div class="card-body">
        <div class="x_content">
                    <br>
                    <form id="demo-form2"  method="POST" action="{{ route('/docencia/documentos/agregar/nuevo') }}" class="form-horizontal form-label-left" >
                      @csrf
                      

                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" id="first-name" name="nombre" required class="form-control ">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Caracteristicas<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" id="first-name" name="caracteristicas" required class="form-control ">
                        </div>
                      </div>
                     
                      
                      <div class="ln_solid"></div>
                      <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-5">
                          <button type="submit" class="btn btn-success">Agregar</button>
                        </div>
                      </div>

                    </form>
                  </div>

      </div>
    </div>

  </div>
  <!-- /page content -->
  <!-- footer content -->
  <footer>
    <div class="pull-right">
      Titulacion SGE  by <a href="">IT Morelia</a>
    </div>
    <div class="clearfix"></div>
  </footer>
  <!-- /footer content -->

  @endsection
