@extends('layouts.cabeceraPr')

@section('content')
<div class="right_col" role="main">
  <div class="col-lg-12">
    <h1 class="page-header">
      Panel <small>Proyecto Docencia</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active">
        <i class="fa fa-dashboard"></i> Profesor/<STRONG>Perfil</STRONG>
      </li>
    </ol>
  </div>
  <div class="">
    <div class="">
      <div class="card">
        <div class="card-header ">

          <h4>Ver Perfil</h4>

        </div>

        <div class="card-body">
          <div class="row justify-content-center">
           <img class="img-thumbnail img-circle " width="125" height="125" src="{{asset('/res/imagen/default.png') }}">

         </div>

         <div class="row justify-content-center">

          <a class="btn btn-sm btn-default fa fa-envelope-square fa-3x" href='mailto:"{{ Auth::user()->email }}"'></a>
        </div>



        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped ">
            <thead>

            </thead>
            <tbody >
              <tr class="centrar">
                <th>Nombre</td>
                  <td>{{ Auth::user()->name }}</td>
                </tr>
                <tr class="centrar">
                  <th>Correo</th>
                  <td>{{ Auth::user()->email }}</td>
                </tr>
                <tr class="centrar">
                  <th>Telefono</th>
                  <td>01-800</td>
                </tr>
                
                <tr class="centrar">
                  <th>Se creo</th>
                  <td>{{ Auth::user()->created_at }}</td>
                </tr>

                <tr class="centrar">
                  <th >Opciones</th>
                  <td><a href="#" class="btn btn-success " data-toggle="modal" data-target="#basicModal2"> <i class="fa fa-wrench"></i>  Editar</a>

                  </td>
                </tr>

              </tbody>
            </table>
          </div>

        </div>
        <!-- Añadir personal -->
        <div class="modal fade" id="basicModal2" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <h4>Actualizar Perfil</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body">
                <form>
                  <div class="form-group">
                    <label for="formGroupExampleInput">Nombre</label>
                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Nombre">
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlInput1">Correo</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Contraseña</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña">
                  </div>
                  <div class="form-group">
                    <label for="formGroupExampleInput">Teléfono</label>
                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Teléfono">
                  </div>

                  <hr>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Actualizar</button>
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                </div>
              </form>
            </div>

          </div>
        </div>

      </div>
    </div>

  </div>
</div>
<!-- footer content -->
<footer>
  <div class="pull-right">
    Titulacion SGE  by <a href="">IT Morelia</a>
  </div>
  <div class="clearfix"></div>
</footer>
<!-- /footer content -->




@endsection