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
        <h4>Agregar nueva Sala</h4>
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
                    <form id="demo-form2"  method="POST" action="{{ route('/docencia/documentos/salas/nuevo') }}" class="form-horizontal form-label-left" >
                      @csrf
                      

                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" id="first-name" name="nombre" required class="form-control ">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Disponible<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <div class="radio">
                            <label class="">
                              <div class="iradio_flat-green" style="position: relative;"><input type="radio" class="flat" name="disponible" value="1" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> SI
                            </label>
                          </div>
                          <div class="radio">
                            <label class="">
                              <div class="iradio_flat-green" style="position: relative;"><input type="radio" class="flat" name="disponible" value="0" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> NO
                            </label>
                          </div>
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
