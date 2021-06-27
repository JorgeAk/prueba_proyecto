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
                          <i class="fa fa-dashboard"></i> Docencia/Alumnos/<STRONG>Solicitudes</STRONG>
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
                  <!-- table -->
                  <div class="row">
                      <div class="col-md-12 register-right">
                          <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist"></ul>
                          <div class="tab-content" id="myTabContent">
                              <div class="tab-pane fade show active table-responsive" id="home" role="tabpanel" aria-labelledby="home-tab">
                                  <br>
                                  <table id="example" class="table table-striped jambo_table ">
                                      <thead>
                                          <tr>
                                              <th>Fecha</th>
                                              <th>#Control</th>
                                              <th>Nombre</th>
                                              <th>Apellido Paterno</th>
                                              <th>Apellido Materno</th>
                                              <th>Carrera</th>
                                              <th>Plan&nbsp;&nbsp;&nbsp;</th>
                                              <th>Opcion de titulación</th>
                                              <th>Estatus</th>
                                              <th>Acciones</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @foreach ($alumno as $alum)
                                          @if ($alum->s_estatus== 2 and $alum->id_optitulacion==1 or $alum->id_optitulacion==2 or $alum->id_optitulacion==3 )
                                          <tr class="centrar">
                                              <td>{{date_format (new DateTime($alum->created_at), 'd/m/Y H:i:s A')  }}</td>
                                              <td>{{ $alum->n_control }}</td>
                                              <td>{{ $alum->p_nombre }} {{ $alum->s_nombre }}</td>
                                              <td>{{ $alum->a_paterno }}</td>
                                              <td>{{ $alum->a_materno }}</td>
                                              @foreach ($carreras as $carr)
                                              @if ($alum->id_carrera == $carr->id)
                                              <td>{{ $carr->nombre }}</td>
                                              @endif
                                              @endforeach

                                              @foreach ($planes as $plan)
                                              @if ($alum->id_plan == $plan->id)
                                              <td>{{ $plan->nombre }}</td>
                                              @endif
                                              @endforeach
                                              @foreach ($titulacion as $op_t)
                                              @if ($alum->id_optitulacion == $op_t->id)
                                              <td>{{ $op_t->nombre }}</td>
                                              @endif
                                              @endforeach
                                              @foreach ($estatus as $est)
                                              @if ($alum->s_estatus == $est->id)
                                              <td>{{ $est->nombre }}</td>
                                              @endif
                                              @endforeach
                                              <td style="white-space:nowrap !important;">
                                                  <a href="#" class="btn btn-lg btn-success btn-sm" data-toggle="modal" data-target="#M{{ $alum->id }}" title="Ver" style="display: inline-block !important; "><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                  @if ($alum->s_estatus == 2 or $alum->s_estatus == 9 or $alum->s_estatus == 10 or $alum->s_estatus == 11 or $alum->s_estatus == 12 )
                                                  <a href="{{ route('solicitudDetalle', $alum->id) }}" class="btn btn-lg btn-success btn-sm" title="Dar seguimiento a solicitud" style="display: inline-block !important;"><i class="fa fa-exclamation" aria-hidden="true"></i></a>
                                                  @endif
                                                  @if ($alum->s_estatus == 14)
                                                  <a href="{{ route('solicitudDetalle', $alum->id) }}" class="btn btn-lg btn-success btn-sm" title="Generar Oficio liberacion de proyecto" style="display: inline-block !important;"><i class="fa fa-exclamation" aria-hidden="true"></i></a>
                                                  @endif
                                                  @if ($alum->s_estatus == 15)
                                                  <a href="{{ route('solicitudDetalle', $alum->id) }}" class="btn btn-lg btn-success btn-sm" title="Generar Oficio impresion definitiva" style="display: inline-block !important;"><i class="fa fa-exclamation" aria-hidden="true"></i></a>
                                                  @endif
                                                  @if ($alum->s_estatus == 3 or $alum->s_estatus == 6)
                                                  <a href="{{ route('solicitudDetalle', $alum->id) }}" class="btn btn-lg btn-success btn-sm" title="Asignar revisores" style="display: inline-block !important;"><i class="fa fa-check-square-o " aria-hidden="true"></i></a>
                                                  @endif
                                                  @if ($alum->s_estatus == 5)
                                                  <a href="{{ route('solicitudDetalle', $alum->id) }}" class="btn btn-lg btn-success btn-sm" title="Asignacion de Sinodales" style="display: inline-block !important;"><i class="fa fa-check-square-o  " aria-hidden="true"></i></a>
                                                  @endif
                                              </td>
                                          </tr>
                                          @else
                                          @if ($alum->s_estatus== 3 or $alum->s_estatus== 5 or $alum->s_estatus== 6 or $alum->s_estatus== 7 or $alum->s_estatus== 9 or $alum->s_estatus== 10 or $alum->s_estatus== 11 or $alum->s_estatus== 12 or $alum->s_estatus== 13 or $alum->s_estatus == 14 or $alum->s_estatus == 15 or $alum->s_estatus == 16 or $alum->s_estatus == 17)
                                          <tr class="centrar">
                                              <td>{{date_format (new DateTime($alum->created_at), 'd/m/Y H:i:s A')  }}</td>
                                              <td>{{ $alum->n_control }}</td>
                                              <td>{{ $alum->p_nombre }} {{ $alum->s_nombre }}</td>
                                              <td>{{ $alum->a_paterno }}</td>
                                              <td>{{ $alum->a_materno }}</td>
                                              @foreach ($carreras as $carr)
                                              @if ($alum->id_carrera == $carr->id)
                                              <td>{{ $carr->nombre }}</td>
                                              @endif
                                              @endforeach

                                              @foreach ($planes as $plan)
                                              @if ($alum->id_plan == $plan->id)
                                              <td>{{ $plan->nombre }}</td>
                                              @endif
                                              @endforeach
                                              @foreach ($titulacion as $op_t)
                                              @if ($alum->id_optitulacion == $op_t->id)
                                              <td>{{ $op_t->nombre }}</td>
                                              @endif
                                              @endforeach
                                              @foreach ($estatus as $est)
                                              @if ($alum->s_estatus == $est->id)
                                              <td>{{ $est->nombre }}</td>
                                              @endif
                                              @endforeach
                                              <td style="white-space:nowrap !important;">
                                                  <a href="#" class="btn btn-lg btn-success btn-sm" data-toggle="modal" data-target="#M{{ $alum->id }}" title="Ver" style="display: inline-block !important; "><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                  @if ($alum->s_estatus == 2 or $alum->s_estatus == 9 or $alum->s_estatus == 10 or $alum->s_estatus == 11 or $alum->s_estatus == 12 or $alum->s_estatus == 14 or $alum->s_estatus == 15 or $alum->s_estatus == 16)
                                                  <a href="{{ route('solicitudDetalle', $alum->id) }}" class="btn btn-lg btn-success btn-sm" title="Dar seguimiento a solicitud" style="display: inline-block !important;"><i class="fa fa-exclamation" aria-hidden="true"></i></a>
                                                  @endif
                                                  @if ($alum->s_estatus == 3 or $alum->s_estatus == 6)
                                                  <a href="{{ route('solicitudDetalle', $alum->id) }}" class="btn btn-lg btn-success btn-sm" title="Asignar revisores" style="display: inline-block !important;"><i class="fa fa-check-square-o" aria-hidden="true"></i></a>
                                                  @endif
                                                  @if ($alum->s_estatus == 5)
                                                  <a href="{{ route('solicitudDetalle', $alum->id) }}" class="btn btn-lg btn-success btn-sm" title="Asignacion de sinodales" style="display: inline-block !important;"><i class="fa fa-check-square-o " aria-hidden="true"></i></a>
                                                  @endif
                                              </td>
                                          </tr>
                                          @endif
                                          @endif
                                          @endforeach
                                      </tbody>
                                  </table>
                                  @foreach ($alumno as $alum)
                                  <!-- basic modal -->
                                  <div class="modal fade " id="M{{ $alum->id }}" tabindex="-1" role="dialog" aria-labelledby="M{{ $alum->id }}" aria-hidden="true">
                                      <div class="modal-dialog modal-lg">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h4 class="modal-title" id="myModalLabel">Solicitud Alumno</h4>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                  </button>
                                              </div>
                                              <div class="modal-body">
                                                  <div class="container register">
                                                      <div class="row">
                                                          <div class="col-md-12 register-right">
                                                              <div class="tab-content" id="myTabContent">
                                                                  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                                      <div class="row ">
                                                                          <div class="col-md-6">
                                                                              <div class="">
                                                                                  <label for="inputfirstName">Primer
                                                                                      Nombre</label>
                                                                                  <input disabled id="inputfirstName" type="text" class="form-control  @error('name') is-invalid @enderror" name="p_name" value="{{ $alum->p_nombre }}" autocomplete="name" placeholder="{{ $alum->p_nombre }}" required autofocus />
                                                                              </div>
                                                                              <div class=" form-label-group">
                                                                                  <label for="inputSecondName">Segundo
                                                                                      Nombre</label>
                                                                                  <input disabled id="inputSecondName" name="s_name" type="text" class="form-control" placeholder="{{ $alum->s_nombre }}" />
                                                                              </div>
                                                                              <div class=" form-label-group">
                                                                                  <label for="inputAp">Apellido
                                                                                      Paterno</label>
                                                                                  <input disabled id="inputAp" name="ap_paterno" type="text" class="form-control" placeholder="{{ $alum->a_paterno }}" required />
                                                                              </div>
                                                                              <div class=" form-label-group">
                                                                                  <label for="inputAm">Apellido
                                                                                      Materno</label>
                                                                                  <input disabled id="inputAm" name="ap_materno" type="text" class="form-control" placeholder="{{ $alum->a_materno }}" required />
                                                                              </div>
                                                                              <div class=" form-label-group">
                                                                                  <label for="inputemail2">Segundo
                                                                                      Correo</label>
                                                                                  <input disabled id="inputemail2" name="email2" type="email" class="form-control" placeholder="{{ $alum->s_correo }}" />
                                                                              </div>
                                                                              <div class=" form-label-group">
                                                                                  <label for="inputtel">Telefono de
                                                                                      Casa</label>
                                                                                  <input disabled id="inputtel" name="tel" type="tel" class="form-control" placeholder="{{ $alum->telefono }}" />
                                                                              </div>
                                                                              <div class=" form-label-group">
                                                                                  <label for="inputtel2">Celular</label>
                                                                                  <input disabled id="inputtel2" name="cel" type="tel" minlength="10" maxlength="10" class="form-control" placeholder="{{ $alum->celular }}" required />
                                                                              </div>
                                                                              <div class=" form-label-group">
                                                                                  <label for="inputciudad">Municipio</label>
                                                                                  <input disabled id="inputciudad" name="municipio" type="text" class="form-control" placeholder="{{ $alum->municipio }}" required />
                                                                              </div>
                                                                              <div class=" form-label-group">
                                                                                  <label for="inputcp">CP</label>
                                                                                  <input disabled id="inputcp" name="cp" type="text" class="form-control" placeholder="{{ $alum->cp }}" required required />
                                                                              </div>
                                                                              <div class=" form-label-group">
                                                                                  <label for="inputestado">Entidad
                                                                                      Federativa</label>
                                                                                  <input disabled id="inputestado" name="entidad" type="text" class="form-control" placeholder="{{ $alum->entidad_f }}" required />
                                                                              </div>
                                                                              <div class=" form-label-group">
                                                                                  <label for="inputNcontrol">Numero
                                                                                      de Control</label>
                                                                                  <input disabled id="inputNcontrol" name="n_control" type="text" class="form-control" placeholder="{{ $alum->n_control }}" required />
                                                                              </div>
                                                                              <div class=" form-label-group">
                                                                                  <label for="inputCarrera">Carrera</label>
                                                                                  @foreach ($carreras as $carr)
                                                                                  @if ($alum->id_carrera == $carr->id)
                                                                                  <input disabled id="inputCarrera" name="carrera" type="text" class="form-control" placeholder="{{ $carr->nombre  }}" required />
                                                                                  @endif
                                                                                  @endforeach
                                                                              </div>
                                                                              <div class=" form-label-group">
                                                                                  <label for="inputCarrera">Plan</label>
                                                                                  @foreach ($planes as $plan)
                                                                                  @if ($alum->id_plan == $plan->id)
                                                                                  <input disabled id="inputCarrera" name="plan" type="text" class="form-control" placeholder="{{ $plan->nombre }}" required />
                                                                                  @endif
                                                                                  @endforeach
                                                                              </div>
                                                                              <div class=" form-label-group">
                                                                                  <label for="inputCarrera">Fecha de
                                                                                      Ingreso</label>
                                                                                  <input disabled id="inputCarrera" name="f_ingreso" type="text" class="form-control" placeholder="{{ $alum->f_ingreso }}" required />
                                                                              </div>
                                                                              <div class=" form-label-group">
                                                                                  <label for="inputCarrera">Fecha de
                                                                                      Egreso</label>
                                                                                  <input disabled id="inputCarrera" name="f_egreso" type="text" class="form-control" placeholder="{{ $alum->f_egreso }}" required />
                                                                              </div>
                                                                          </div>
                                                                          <div class="col-md-6">
                                                                              <!------ DOCUMENTOS ----------------->
                                                                              @if (count($documentos)>0)
                                                                              <?php $contador_doc = 0; ?>
                                                                              @foreach ($documentos as $n_doc)
                                                                              @if ($n_doc->id_solicitud == $alum->id)
                                                                              <?php $contador_doc++; ?>
                                                                              @endif
                                                                              @endforeach
                                                                              <br><br>
                                                                              <div id="accordion_doc{{$alum->id}}">
                                                                                  <div class="card">
                                                                                      <div class="card-header centrar" id="headingOne_doc">
                                                                                          <h5 class="mb-0 ">
                                                                                              <h5 class="centrar">DOCUMENTOS ADJUNTOS</h5>
                                                                                              <a onclick="muestra('muestra_doc{{$alum->id}}','oculta_doc{{$alum->id}}')" id="muestra_doc{{$alum->id}}" data-toggle="collapse" data-target="#collapseOne_doc{{$alum->id}}" aria-expanded="true" class="btn btn-app img-close ">
                                                                                                  <span class="badge bg-orange">{{$contador_doc}}</span>
                                                                                                  <i class="fa fa-folder"></i>Documentos Adjuntos
                                                                                              </a>
                                                                                              <a onclick="oculta('muestra_doc{{$alum->id}}','oculta_doc{{$alum->id}}')" id="oculta_doc{{$alum->id}}" style="display: none" data-toggle="collapse" data-target="#collapseTwo_doc{{$alum->id}}" aria-expanded="false" aria-controls="collapseTwo_doc{{$alum->id}}" class="btn btn-app img-open ">
                                                                                                  <span class="badge bg-orange">{{$contador_doc}}</span>
                                                                                                  <i class="fa fa-folder-open"></i>Documentos Adjuntos
                                                                                              </a>
                                                                                          </h5>
                                                                                      </div>
                                                                                      <div id="collapseOne_doc{{$alum->id}}" class="collapse " aria-labelledby="headingOne_doc" data-parent="#accordion_doc{{$alum->id}}">
                                                                                          <div class="card-body">
                                                                                              <div class="x_content">
                                                                                                  @foreach ($documentos as $doc)
                                                                                                  @if ($doc->id_solicitud == $alum->id)
                                                                                                  <label hidden for="inputCarrera">{{$doc->documento}}</label>
                                                                                                  <a class="btn btn-app" href="{{ route('descargar_archivo',$doc->ruta)}}" download="{{$doc->documento}}_{{$alum->n_control}}.pdf" data-toggle="tooltip" data-placement="top" title="{{$doc->documento}}"><i class="fa fa-file-pdf-o"></i></a>
                                                                                                  <input hidden disabled id="inputCarrera" name="f_egreso" type="text" class="form-control" placeholder="{{ $doc->ruta }}" required />
                                                                                                  @endif
                                                                                                  <?php $contador_doc = 0; ?>
                                                                                                  @endforeach
                                                                                              </div>
                                                                                          </div>
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="card">
                                                                                      <div class="card-header" id="headingTwo_doc{{$alum->id}}">
                                                                                          <h5 class="mb-0">
                                                                                          </h5>
                                                                                      </div>
                                                                                      <div id="collapseTwo_doc{{$alum->id}}" class="collapse" aria-labelledby="headingTwo_doc{{$alum->id}}" data-parent="#accordion_doc{{$alum->id}}">
                                                                                      </div>
                                                                                  </div>
                                                                              </div>
                                                                              @endif
                                                                              <br>
                                                                              <!------ END DOCUMENTOS ----------------->
                                                                              <!------ OFICIOS ----------------->
                                                                              @if (count($oficios)>0)
                                                                              <?php $contador_of = 0; ?>
                                                                              @foreach ($oficios as $n_ofi)
                                                                              @if ($n_ofi->id_solicitud == $alum->id)
                                                                              <?php $contador_of++; ?>
                                                                              @endif
                                                                              @endforeach
                                                                              <br><br>
                                                                              <div id="accordion{{$alum->id}}">
                                                                                  <div class="card">
                                                                                      <div class="card-header centrar" id="headingOne">
                                                                                          <h5 class="mb-0 ">
                                                                                              <h5 class="centrar">OFICIOS ADJUNTOS</h5>
                                                                                              <a onclick="muestra('muestra{{$alum->id}}','oculta{{$alum->id}}')" id="muestra{{$alum->id}}" data-toggle="collapse" data-target="#collapseOne{{$alum->id}}" aria-expanded="true" class="btn btn-app img-close ">
                                                                                                  <span class="badge bg-orange">{{$contador_of}}</span>
                                                                                                  <i class="fa fa-folder"></i>Oficios Adjuntos
                                                                                              </a>
                                                                                              <a onclick="oculta('muestra{{$alum->id}}','oculta{{$alum->id}}')" id="oculta{{$alum->id}}" style="display: none" data-toggle="collapse" data-target="#collapseTwo{{$alum->id}}" aria-expanded="false" aria-controls="collapseTwo{{$alum->id}}" class="btn btn-app img-open ">
                                                                                                  <span class="badge bg-orange">{{$contador_of}}</span>
                                                                                                  <i class="fa fa-folder-open"></i>Oficios Adjuntos
                                                                                              </a>
                                                                                          </h5>
                                                                                      </div>
                                                                                      <div id="collapseOne{{$alum->id}}" class="collapse " aria-labelledby="headingOne" data-parent="#accordion{{$alum->id}}">
                                                                                          <div class="card-body">
                                                                                              <div class="x_content">
                                                                                                  @foreach ($oficios as $ofi)
                                                                                                  @if ($ofi->id_solicitud == $alum->id)
                                                                                                  <label hidden for="inputCarrera">@foreach ($tipo_oficio as $t_of)
                                                                                                      @if ($t_of->id==$ofi->id_tipo_oficio)
                                                                                                      {{$t_of->nombre}}
                                                                                                      @endif
                                                                                                      @endforeach</label>
                                                                                                  <a class="btn btn-app" href="{{ route('descargar_archivo',$ofi->url)}}" download="oficio_{{$ofi->id_tipo_oficio}}{{$alum->n_control}}.pdf" data-toggle="tooltip" data-placement="top" title="@foreach ($tipo_oficio as $t_of)
                                                                                                @if ($t_of->id==$ofi->id_tipo_oficio)
                                                                                                {{$t_of->nombre}}   
                                                                                                @endif
                                                                                            @endforeach"><i class="fa fa-file-pdf-o"></i></a>
                                                                                                  <input hidden disabled id="inputCarrera" name="f_egreso" type="text" class="form-control" placeholder="{{ $ofi->url }}" required />
                                                                                                  @endif
                                                                                                  <?php $contador_of = 0; ?>
                                                                                                  @endforeach
                                                                                              </div>
                                                                                          </div>
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="card">
                                                                                      <div class="card-header" id="headingTwo{{$alum->id}}">
                                                                                          <h5 class="mb-0">
                                                                                          </h5>
                                                                                      </div>
                                                                                      <div id="collapseTwo{{$alum->id}}" class="collapse" aria-labelledby="headingTwo{{$alum->id}}" data-parent="#accordion{{$alum->id}}">
                                                                                      </div>
                                                                                  </div>
                                                                              </div>
                                                                              @endif
                                                                              <br>
                                                                              <!------ Oficios ----------------->
                                                                              <div class=" form-label-group">
                                                                                  <label for="inputCarrera">Opcion
                                                                                      de titulacion</label>
                                                                                  @foreach ($titulacion as $op_t)
                                                                                  @if ($alum->id_optitulacion == $op_t->id)
                                                                                  <input disabled id="inputCarrera" name="op_titulacion" type="text" class="form-control" placeholder="{{ $op_t->nombre }}" required />
                                                                                  @endif
                                                                                  @endforeach
                                                                              </div>
                                                                              @if ($alum->id_optitulacion != 4 )
                                                                              <div class=" form-label-group"><label for="inputCarrera">Archivo</label>
                                                                                  <a href="{{ route('descargar_archivo',$alum->proy_archivo)}}" download="proyecto_{{$alum->n_control}}.pdf"><button class="btn btn-success pull-right form-control" style="margin-right: 5px;"><i class="fa fa-cloud-download"></i>&nbsp;&nbsp;<i class="fa fa-file-pdf-o"></i>&nbsp;Descargar Archivo</button></a>
                                                                              </div>
                                                                              <div class=" form-label-group">
                                                                                  <label for="inputCarrera">Asesor Interno</label>
                                                                                  @foreach ($profesores as $prof)
                                                                                  @if ($alum->id_asesor== $prof->id)
                                                                                  <input disabled id="inputCarrera" name="carrera" type="text" class="form-control" placeholder="{{$prof->p_nombre}}" required />
                                                                                  @endif
                                                                                  @endforeach
                                                                              </div>
                                                                              @endif
                                                                              <!-- validados la solicitud para asignar rev-->
                                                                              @if ($alum->s_estatus== 6 or $alum->s_estatus==7 or $alum->s_estatus==11 or $alum->s_estatus==12 )
                                                                              <br>
                                                                              <h5 class="centrar">Asignacion de Revisores</h5>
                                                                              <br>
                                                                              <!----------- Primer Revisor -------------->
                                                                              @foreach ($revisores as $rev)
                                                                              @if($rev->id_solicitud==$alum->id and $rev->id_tipo==1)
                                                                              <div class=" form-label-group">
                                                                                  @foreach ($profesores as $prof)
                                                                                  @if($prof->id == $rev->id_profesor)
                                                                                  <label for="inputCarrera">Primer Revisor</label>
                                                                                  <input disabled id="inputCarrera" name="f_ingreso" type="text" class="form-control" placeholder="{{$prof->p_nombre}}" required />
                                                                                  @foreach ($estatus2 as $est)
                                                                                  @if ($rev->id_estatus==$est->id)
                                                                                  <small class="text-danger">*Estatus: {{$est->nombre}} </small>
                                                                                  @endif
                                                                                  @endforeach
                                                                                  @endif
                                                                                  @endforeach
                                                                              </div>
                                                                              @else
                                                                              @endif
                                                                              @endforeach
                                                                              <!----------- Fin Primer Revisor -------------->
                                                                              <!----------- Segundo Revisor -------------->
                                                                              @foreach ($revisores as $rev)
                                                                              @if($rev->id_solicitud==$alum->id and $rev->id_tipo==2)
                                                                              <div class=" form-label-group">
                                                                                  @foreach ($profesores as $prof)
                                                                                  @if($prof->id == $rev->id_profesor)
                                                                                  <label for="inputCarrera">Segundo Revisor</label>
                                                                                  <input disabled id="inputCarrera" name="f_ingreso" type="text" class="form-control" placeholder="{{$prof->p_nombre}}" required />
                                                                                  @foreach ($estatus2 as $est)
                                                                                  @if ($rev->id_estatus==$est->id)
                                                                                  <small class="text-danger">*Estatus: {{$est->nombre}} </small>
                                                                                  @endif
                                                                                  @endforeach
                                                                                  @endif
                                                                                  @endforeach
                                                                              </div>
                                                                              @endif
                                                                              @endforeach
                                                                              <!----------- Fin Segundo Revisor -------------->
                                                                              <!----------- Tercer Revisor -------------->
                                                                              @foreach ($revisores as $rev)
                                                                              @if($rev->id_solicitud==$alum->id and $rev->id_tipo==3)
                                                                              <div class=" form-label-group">
                                                                                  @foreach ($profesores as $prof)
                                                                                  @if($prof->id == $rev->id_profesor)
                                                                                  <label for="inputCarrera">Tercer Revisor</label>
                                                                                  <input disabled id="inputCarrera" name="f_ingreso" type="text" class="form-control" placeholder="{{$prof->p_nombre}}" required />
                                                                                  @foreach ($estatus2 as $est)
                                                                                  @if ($rev->id_estatus==$est->id)
                                                                                  <small class="text-danger">*Estatus: {{$est->nombre}} </small>
                                                                                  @endif
                                                                                  @endforeach
                                                                                  @endif
                                                                                  @endforeach
                                                                              </div>
                                                                              @endif
                                                                              @endforeach
                                                                              <!----------- Fin TERCER Revisor -------------->
                                                                              @else
                                                                              @if ($alum->s_estatus != 6 )
                                                                              <br>
                                                                              <?php $total = 0; ?>
                                                                              @foreach ($sinodales as $item)
                                                                              @if ($item->id_solicitud == $alum->id)
                                                                              <?php $total++; ?>
                                                                              @endif
                                                                              @endforeach
                                                                              @if ($total != 0)
                                                                              <h5 class="centrar">Asignacion de Sinodales</h5>
                                                                              @endif
                                                                              <br>
                                                                              <!----------- Presidente -------------->
                                                                              @foreach ($sinodales as $sino)
                                                                              @if($sino->id_solicitud==$alum->id and $sino->id_tipo==1)
                                                                              <div class=" form-label-group">
                                                                                  @foreach ($profesores as $prof)
                                                                                  @if($prof->id == $sino->id_profesor)
                                                                                  <label for="inputCarrera">Presidente
                                                                                      @foreach ($estatus2 as $est)
                                                                                      @if ($sino->id_estatus==$est->id)
                                                                                      <a href="#" class="text-danger" data-toggle="tooltip" data-placement="top" title="*Estatus: {{$est->nombre}}"><i class="fa fa-info-circle"></i></a>
                                                                                      @endif
                                                                                      @endforeach
                                                                                  </label>
                                                                                  <input disabled id="inputCarrera" name="f_ingreso" type="text" class="form-control" placeholder="{{$prof->p_nombre}}" required />
                                                                                  @foreach ($estatus2 as $est)
                                                                                  @if ($sino->id_estatus==$est->id)
                                                                                  <small class="text-danger">*Estatus: {{$est->nombre}} </small>
                                                                                  @endif
                                                                                  @endforeach
                                                                                  @endif
                                                                                  @endforeach
                                                                              </div>
                                                                              @endif
                                                                              @endforeach
                                                                              <!----------- Fin Presidente -------------->
                                                                              <!----------- Secretario -------------->
                                                                              @foreach ($sinodales as $sino)
                                                                              @if($sino->id_solicitud==$alum->id and $sino->id_tipo==2)
                                                                              <div class=" form-label-group">
                                                                                  @foreach ($profesores as $prof)
                                                                                  @if($prof->id == $sino->id_profesor)
                                                                                  <label for="inputCarrera">Secretario @foreach ($estatus2 as $est)
                                                                                      @if ($sino->id_estatus==$est->id)
                                                                                      <a href="#" class="text-danger" data-toggle="tooltip" data-placement="top" title="*Estatus: {{$est->nombre}}"><i class="fa fa-info-circle"></i></a>
                                                                                      @endif
                                                                                      @endforeach </label>
                                                                                  <input disabled id="inputCarrera" name="f_ingreso" type="text" class="form-control" placeholder="{{$prof->p_nombre}}" required />
                                                                                  @foreach ($estatus2 as $est)
                                                                                  @if ($sino->id_estatus==$est->id)
                                                                                  <small class="text-danger">*Estatus: {{$est->nombre}} </small>
                                                                                  @endif
                                                                                  @endforeach
                                                                                  @endif
                                                                                  @endforeach
                                                                              </div>
                                                                              @endif
                                                                              @endforeach
                                                                              <!----------- Fin Secretario -------------->
                                                                              <!----------- Vocal Propietario -------------->
                                                                              @foreach ($sinodales as $sino)
                                                                              @if($sino->id_solicitud==$alum->id and $sino->id_tipo==3)
                                                                              <div class=" form-label-group">
                                                                                  @foreach ($profesores as $prof)
                                                                                  @if($prof->id == $sino->id_profesor)
                                                                                  <label for="inputCarrera">Vocal Propietario @foreach ($estatus2 as $est)
                                                                                      @if ($sino->id_estatus==$est->id)
                                                                                      <a href="#" class="text-danger" data-toggle="tooltip" data-placement="top" title="*Estatus: {{$est->nombre}}"><i class="fa fa-info-circle"></i></a>
                                                                                      @endif
                                                                                      @endforeach </label>
                                                                                  <input disabled id="inputCarrera" name="f_ingreso" type="text" class="form-control" placeholder="{{$prof->p_nombre}}" required />
                                                                                  @foreach ($estatus2 as $est)
                                                                                  @if ($sino->id_estatus==$est->id)
                                                                                  <small class="text-danger">*Estatus: {{$est->nombre}} </small>
                                                                                  @endif
                                                                                  @endforeach
                                                                                  @endif
                                                                                  @endforeach
                                                                              </div>
                                                                              @endif
                                                                              @endforeach
                                                                              <!----------- Fin Vocal Propietario -------------->
                                                                              <!----------- Vocal Suplente -------------->
                                                                              @foreach ($sinodales as $sino)
                                                                              @if($sino->id_solicitud==$alum->id and $sino->id_tipo==4)
                                                                              <div class=" form-label-group">
                                                                                  @foreach ($profesores as $prof)
                                                                                  @if($prof->id == $sino->id_profesor)
                                                                                  <label for="inputCarrera">Vocal Suplente @foreach ($estatus2 as $est)
                                                                                      @if ($sino->id_estatus==$est->id)
                                                                                      <a href="#" class="text-danger" data-toggle="tooltip" data-placement="top" title="*Estatus: {{$est->nombre}}"><i class="fa fa-info-circle"></i></a>
                                                                                      @endif
                                                                                      @endforeach </label>
                                                                                  <input disabled id="inputCarrera" name="f_ingreso" type="text" class="form-control" placeholder="{{$prof->p_nombre}}" required />
                                                                                  @foreach ($estatus2 as $est)
                                                                                  @if ($sino->id_estatus==$est->id)
                                                                                  <small class="text-danger">*Estatus: {{$est->nombre}} </small>
                                                                                  @endif
                                                                                  @endforeach
                                                                                  @endif
                                                                                  @endforeach
                                                                              </div>
                                                                              @endif
                                                                              @endforeach
                                                                              <!----------- Fin Vocal Propietario -------------->
                                                                              @endif
                                                                              @endif
                                                                              <a href="{{ route('solicitudDetalle', $alum->id) }}"><button class="btn btn-success pull-right form-control" style="margin-right: 5px;"><i class="fa fa-pencil-square-o" aria-hidden="true"> </i>
                                                                                      &nbsp;Modificar </button>
                                                                              </a>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  @endforeach
                                  <!-- basic modal END-->
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- /table-->
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