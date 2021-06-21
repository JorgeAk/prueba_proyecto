@extends('layouts.cabecera')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
  <div>
    <div class="col-lg-12">
      <h1 class="page-header">
        Panel <small>Proyecto Docencia</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active">
          <i class="fa fa-dashboard"></i> Alumno/<STRONG>Mensajes</STRONG>
        </li>
      </ol>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h5>Solicitud Titulación</h5>
    </div>
    <div class="card-body">
      <div class="fixed-table-toolbar">
        <div class="columns columns-right btn-group pull-right">
          <button class="btn btn-default" type="button" onclick="ajax_set_list()" name="refresh" title="Refresh"><i class="fa fa-refresh icon-refresh"></i>
          </button>

          <button class="btn btn-light border-secondary" type="button" title="%s" onclick="export_it('pdf');">pdf</button>
          <button class="btn btn-light border-secondary" type="button" title="%s" onclick="export_it('csv');">csv</button>
          <button class="btn btn-light border-secondary" type="button" title="%s" onclick="export_it('excel');">xls</button>
        </div>
        <div class="pull-right search">
          <input class="form-control" type="text" placeholder="Search">
        </div>
      </div>
      <div class="fixed-table-container">
        <div class="fixed-table-header">
          <table>
          </table>
        </div>
        <div class="fixed-table-body"><div class="fixed-table-loading" style="top: 37px;">
        </div>
        <table id="demo-table" class="table table-striped table-hover" data-pagination="true" data-show-refresh="true" data-ignorecol="0,2" data-show-toggle="true" data-show-columns="false" data-search="true">
          <thead>
            <tr>
              <th style="">
                <div class="th-inner ">no</div>
                <div class="fht-cell"></div>
              </th>
              <th style="">
                <div class="th-inner ">nombre</div>
                <div class="fht-cell"></div>
              </th>
              <th style="">
                <div class="th-inner ">tema</div>
                <div class="fht-cell"></div>
              </th>
              <th style="">
                <div class="th-inner ">fecha</div>
                <div class="fht-cell"></div>
              </th>
              <th class="text-right" style="">
                <div class="th-inner ">opciones</div>
                <div class="fht-cell"></div>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr data-index="0">
              <td style="">1</td>
              <td style="">jorge</td>
              <td style="">hola prueba</td>
              <td style="">07 Jun,2020 07:46:51</td>
              <td class="text-right" style="">
                <a class="btn btn-info btn-xs btn-labeled fa fa-location-arrow" data-toggle="tooltip" onclick="ajax_set_full('view','view contact message','éxito vistos!','contact_message_view','30');" data-original-title="Edit" data-container="body">
                  Ver Mensaje
                </a>
                <a onclick="delete_confirm('30','¿Realmente desea eliminar este producto?')" class="btn btn-danger btn-xs btn-labeled fa fa-trash" data-toggle="tooltip" data-original-title="Delete" data-container="body">
                  borrar
                </a>
              </td>
            </tr>
            <tr data-index="1">
              <td style="">2</td>
              <td style="">hola mensaje de prueba </td>
              <td style="">hola mensaje de pruebaaa</td>
              <td style="">22 Dec,2019 08:02:38</td><td class="text-right" style="">
                <a class="btn btn-info btn-xs btn-labeled fa fa-location-arrow" data-toggle="tooltip" onclick="ajax_set_full('view','view contact message','éxito vistos!','contact_message_view','29');" data-original-title="Edit" data-container="body">
                  Ver Mensaje
                </a>
                <a onclick="delete_confirm('29','¿Realmente desea eliminar este producto?')" class="btn btn-danger btn-xs btn-labeled fa fa-trash" data-toggle="tooltip" data-original-title="Delete" data-container="body">
                  borrar
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="fixed-table-pagination">
        <div class="pull-left pagination-detail">
          <span class="pagination-info">Showing 1 to 2 of 2 rows</span>
          <span class="page-list" style="display: none;">
            <span class="btn-group dropup">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <span class="page-size">10</span>
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li class="active">
                  <a href="javascript:void(0)">10</a>
                </li>
              </ul>
            </span> records per page</span>
          </div>
          <div class="pull-right pagination" style="display: none;"><ul class="pagination">
            <li class="page-first disabled">
              <a href="javascript:void(0)">&lt;&lt;</a>
            </li>
            <li class="page-pre disabled">
              <a href="javascript:void(0)">&lt;</a>
            </li>
            <li class="page-number active disabled">
              <a href="javascript:void(0)">1</a>
            </li>
            <li class="page-next disabled">
              <a href="javascript:void(0)">&gt;</a>
            </li>
            <li class="page-last disabled">
              <a href="javascript:void(0)">&gt;&gt;</a>
            </li>
          </ul>
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
    Titulacion SGE  by <a href="">IT Morelia</a>
  </div>
  <div class="clearfix"></div>
</footer>
<!-- /footer content -->

@endsection
