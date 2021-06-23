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
          <i class="fa fa-dashboard"></i> Coordinacion de titulaciones/Bandeja/<STRONG></STRONG>
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
      <div class="email-app mb-4">
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
        <main class="message">
          <div class="toolbar">
            <div class="btn-group">
              <button type="button" class="btn btn-light">
                <span class="fa fa-star"></span>
              </button>
              <button type="button" class="btn btn-light">
                <span class="fa fa-star-o"></span>
              </button>
              <button type="button" class="btn btn-light">
                <span class="fa fa-bookmark-o"></span>
              </button>
            </div>
          </div>
          <!-- MENSAJES ----->
          @foreach ($mensaje as $mensj)
          @if (count($mensaje)>0)

          <div class="details">
            <div class="title">Asunto: {{$mensj->asunto}}</div>
            <div class="header">
              <img class="avatar" src="https://bootdey.com/img/Content/avatar/avatar1.png">
              <div class="from">
                <span>{{$mensj->usuario_envio}}</span>
                {{$mensj->correo}}
              </div>
              <div class="date"><span class="date"><span class="fa fa-calendar"></span> {{date_format (new DateTime($mensj->fecha), 'd/m/Y H:i:s A')}}</span> <b></b></div>
            </div>
            <div class="content">
              <p>
                {{$mensj->mensaje}}
              </p>
              <blockquote>
              </blockquote>
            </div>
            <hr>
            <br>
            <div hidden class="attachments">
              <div class="attachment">
                <span class="badge badge-danger">zip</span> <b>bootstrap.zip</b> <i>(2,5MB)</i>
                <span class="menu">
                  <a href="#" class="fa fa-search"></a>
                  <a href="#" class="fa fa-share"></a>
                  <a href="#" class="fa fa-cloud-download"></a>
                </span>
              </div>
              <div class="attachment">
                <span class="badge badge-info">txt</span> <b>readme.txt</b> <i>(7KB)</i>
                <span class="menu">
                  <a href="#" class="fa fa-search"></a>
                  <a href="#" class="fa fa-share"></a>
                  <a href="#" class="fa fa-cloud-download"></a>
                </span>
              </div>
              <div class="attachment">
                <span class="badge badge-success">xls</span> <b>spreadsheet.xls</b> <i>(984KB)</i>
                <span class="menu">
                  <a href="#" class="fa fa-search"></a>
                  <a href="#" class="fa fa-share"></a>
                  <a href="#" class="fa fa-cloud-download"></a>
                </span>
              </div>
            </div>
            @if ($mensj->correo !=Auth::user()->email )
            <form class="" method="POST" enctype="multipart/form-data" action="{{ route('coordinacion/titulaciones/correo/mensajes/nuevo/enviar') }}">
              @csrf
              <h4 class="centrar"><span> Reponder</span></h4>
              <input style="display:none;" type="text" name="usuario" value="{{$id_receptor}}" class="form-control" id="" placeholder="Type email">
              <input style="display:none;" type="text" name="asunto" value="Respuesta" class="form-control" id="" placeholder="Type email">
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
                <button tabindex="3" type="submit" class="btn btn-success">Enviar mensaje</button>
              </div>
            </form>
            @endif
          </div>
          @endif
          @endforeach
          <!-- MENSAJES ----->
        </main>
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