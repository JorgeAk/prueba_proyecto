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
            <i class="fa fa-dashboard"></i> Servicio/Profesores<STRONG>/Agregar</STRONG>
          </li>
        </ol>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <h4>Agregar nuevo profesor</h4>
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
          <form id="demo-form2" method="POST" action="{{ route('/servicio/profesores/agregar/nuevo') }}" class="form-horizontal form-label-left">
            @csrf
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="first-name" name="p_nombre" required class="form-control " required autofocus>
              </div>
            </div>
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Segundo Nombre<span class="required"></span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="first-name" name="s_nombre" class="form-control ">
              </div>
            </div>
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Apellido Paterno <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="last-name" name="a_paterno" required class="form-control">
              </div>
            </div>
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Apellido Materno <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="last-name" name="a_materno" required class="form-control">
              </div>
            </div>
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">RFC <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="last-name" name="rfc" required class="form-control">
              </div>
            </div>
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Correo <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="email" id="last-name" name="correo" required class="form-control">
              </div>
            </div>
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Celular <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="tel" id="last-name" name="celular" required class="form-control">
              </div>
            </div>
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Departamento <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="last-name" name="departamento" required class="form-control">
              </div>
            </div>
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Contraseña <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="password" id="last-name" name="password" required class="form-control">
              </div>
            </div>
            <div class="item form-group radio">
              <label class="col-form-label col-md-3 col-sm-3 label-align">
                Estatus <span class="required">*</span>
              </label>
              <label class="col-form-label col-md-3  ">
                <input type="radio" checked="" value="1" id="estatus" name="estatus"> ACTIVO
                <br>
                <input type="radio" value="0" id="estatus" name="estatus"> INACTIVO
              </label>
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
      Titulacion SGE by <a href="">IT Morelia</a>
    </div>
    <div class="clearfix"></div>
  </footer>
  <!-- /footer content -->

  @endsection