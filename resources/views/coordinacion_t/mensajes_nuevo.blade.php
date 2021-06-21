@extends('layouts.cabeceraCT')

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
    @if(Session::has('message'))
    <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      {{Session::get('message')}}
    </div>
    @endif
    <div class="card-body">

        
        <br>
        <br>
        <div class="container bootdey">
        <div class="email-app">
            <nav>
                <a href="{{ route('coordinacion/titulaciones/correo/mensajes/nuevo/crear') }}" class="btn btn-success btn-block">Correo nuevo</a>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('coordinacion/titulaciones/correo/mensajes','inbox') }}"><i class="fa fa-inbox"></i>Bandeja<span class="badge badge-danger">{{ count($m_nuevos)}}</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('coordinacion/titulaciones/correo/mensajes','enviados') }}"><i class="fa fa-rocket"></i> Enviados</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('coordinacion/titulaciones/correo/mensajes','importantes') }}"><i class="fa fa-bookmark"></i> Importantes</a>
                    </li>
                    
                </ul>
            </nav>
            <main>
                <h6 class="text-center"><b>NUEVO MENSAJE</b></h6>
                <form class="" method="POST" enctype="multipart/form-data"  action="{{ route('coordinacion/titulaciones/correo/mensajes/nuevo/enviar') }}">
                    @csrf
                    <div class="form-row mb-3">
                        <label for="to" class="col-2 col-sm-1 col-form-label">Para:</label>
                       
                        <div class="col-10 col-sm-11">
                            <select class="form-control" name="usuario" required >
                                <option class="" value=""  selected disabled>Usuario</option>
                                @foreach ($usuarios as $user)
                                <option class="form-control" value="{{$user->user_id}}">{{$user->email}}/{{$user->description}}</option>
                                @endforeach
                              </select>
                        </div>
                    </div>
                    <div hidden class="form-row mb-3">
                        <label for="cc" class="col-2 col-sm-1 col-form-label">CC:</label>
                        <div class="col-10 col-sm-11">
                            <input type="email" class="form-control" id="cc" placeholder="Type email">
                        </div>
                    </div>
                    <div  class="form-row mb-3">
                        <label for="bcc" class="col-2 col-sm-1 col-form-label">Asunto:</label>
                        <div class="col-10 col-sm-11">
                            <input type="text" class="form-control" name="asunto" id="bcc" placeholder="Titulo" required>
                        </div>
                    </div>
                
                <div class="row">
                    <div class="col-sm-11 ml-auto">
                        <div class="toolbar" role="toolbar">
                            
                        </div>

                        <!--------------------------------------- text area -------------------------->
                        <div class="x_content">
                            <div id="alerts"></div>
                            <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor-one">
                                <div hidden class="btn-group">
                                    <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                    </ul>
                                </div>

                                <div class="btn-group">
                                    <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a data-edit="fontSize 5">
                                                <p style="font-size:17px">Huge</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a data-edit="fontSize 3">
                                                <p style="font-size:14px">Normal</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a data-edit="fontSize 1">
                                                <p style="font-size:11px">Small</p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="btn-group">
                                    <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                                    <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                                    <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                                    <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                                </div>

                                <div class="btn-group">
                                    <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
                                    <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
                                    <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                                    <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                                </div>

                                <div class="btn-group">
                                    <a class="btn btn-info" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                                    <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                                    <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                                    <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                                </div>

                                <div class="btn-group">
                                    <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
                                    <div class="dropdown-menu input-append">
                                        <input class="span2" placeholder="URL" type="text" data-edit="createLink">
                                        <button class="btn" type="button">Add</button>
                                    </div>
                                    <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                                </div>

                                <div hidden class="btn-group">
                                    <a class="btn" title="Insert picture (or just drag &amp; drop)" id="pictureBtn"><i class="fa fa-picture-o"></i></a>
                                    <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage">
                                </div>

                                <div class="btn-group">
                                    <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                                    <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                                </div>
                            </div>

                            <div id="editor-one" class="editor-wrapper placeholderText" contenteditable="true" oninput="document.querySelector('#description').textContent = this.innerText"></div>

                            <textarea name="descr" id="description" id="descripcion" style="display:none;"></textarea>

                            <br>

                            <div class="ln_solid"></div>


                            
                        </div>
                        <!--------------------------------------END TEXT AREA ------------------------>
                        


                        <div class="form-group centrar">
                            <button type="submit" class="btn btn-success">Enviar</button>
                            <a href="{{ route('coordinacion/titulaciones/correo/mensajes') }}" class="btn btn-danger">Descartar</a>
                        </div>
                    </form>
                    </div>
                </div>
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
    Titulacion SGE  by <a href="">IT Morelia</a>
  </div>
  <div class="clearfix"></div>
</footer>
<!-- /footer content -->

@endsection
