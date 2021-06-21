<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="" type="image/ico" />

  <title>Titulación </title>

  <!-- Bootstrap -->
  <link href="{{asset('/res/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">


  <!-- Font Awesome -->
  <link href="{{asset('/res/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <!-- NProgress -->
  <link href="{{asset('/res/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
  <!-- iCheck -->
  <link href="{{asset('/res/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">

  <!-- bootstrap-progressbar -->
  <link href="{{asset('/res/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
  <!-- JQVMap -->
  <link href="{{asset('/res/vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet"/>
  <!-- bootstrap-daterangepicker -->
  <link href="{{asset('/res/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
  <!-- Custom Theme Style -->
  <link href="{{asset('/res/build/css/custom.min.css') }}" rel="stylesheet">
  <link href="{{asset('/res/css/estilo.css') }}" rel="stylesheet">
  <!-- Datatables -->
  <link href="{{asset('/res/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet"/>
  <link href="{{asset('/res/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet"/>
  <link href="{{asset('/res/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet"/>
  <link href="{{asset('/res/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet"/>
  <link href="{{asset('/res/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet"/>
<style type="text/css">
      div.dt-buttons{
        position:relative;
        float:right;
        margin-left:5em;
        }
        div.dataTables_filter{
          position:relative;
          float:right;

        }
        div.dataTables_length{ 
          float:left;

        }
        .centrar{
          text-align: center;
        }
        .col-centrada{
    float: none;
    margin: 0 auto;
}

    </style>
    <style>
      .chatperson{
  display: block;
  border-bottom: 1px solid #eee;
  width: 100%;
  display: flex;
  align-items: center;
  white-space: nowrap;
  overflow: hidden;
  margin-bottom: 15px;
  padding: 4px;
}
.chatperson:hover{
  text-decoration: none;
  border-bottom: 1px solid orange;
}
.namechat {
    display: inline-block;
    vertical-align: middle;
}
.chatperson .chatimg img{
  width: 40px;
  height: 40px;
  background-image: url('http://i.imgur.com/JqEuJ6t.png');
}
.chatperson .pname{
  font-size: 18px;
  padding-left: 5px;
}
.chatperson .lastmsg{
  font-size: 12px;
  padding-left: 5px;
  color: #ccc;
}


.col-md-2, .col-md-10{
    padding:0;
}
.panel{
    margin-bottom: 0px;
}
.chat-window{
    bottom:0;
    position:fixed;
    float:right;
    margin-left:10px;
}
.chat-window > div > .panel{
    border-radius: 5px 5px 0 0;
}
.icon_minim{
    padding:2px 10px;
}
.msg_container_base{
  background: #e5e5e5;
  margin: 0;
  padding: 0 10px 10px;
  max-height:300px;
  overflow-x:hidden;
}
.top-bar {
  background: #666;
  color: white;
  padding: 10px;
  position: relative;
  overflow: hidden;
}
.msg_receive{
    padding-left:0;
    margin-left:0;
}
.msg_sent{
    padding-bottom:20px !important;
    margin-right:0;
    
}
.messages {
  background: white;
  padding: 10px;
  border-radius: 2px;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
  max-width:100%;
}
.messages > p {
    font-size: 13px;
    margin: 0 0 0.2rem 0;
  }
.messages > time {
    font-size: 11px;
    color: #ccc;
}
.msg_container {
    padding: 10px;
    overflow: hidden;
    display: flex;
}

.avatar {
    position: relative;
}
.base_receive > .avatar:after {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    width: 0;
    height: 0;
    border: 5px solid #FFF;
    border-left-color: rgba(0, 0, 0, 0);
    border-bottom-color: rgba(0, 0, 0, 0);
}

.base_sent {
  justify-content: flex-end;
  align-items: flex-end;
}
.base_sent > .avatar:after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 0;
    border: 5px solid white;
    border-right-color: transparent;
    border-top-color: transparent;
    box-shadow: 1px 1px 2px rgba(black, 0.2); // not quite perfect but close
}

.msg_sent > time{
    float: right;
}



.msg_container_base::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

.msg_container_base::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

.msg_container_base::-webkit-scrollbar-thumb
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}

.btn-group.dropup{
    position:fixed;
    left:0px;
    bottom:0;
}


    </style>



</head>
<body class="nav-md ">
  <div class="container body ">
    <div class="main_container ">
      <div class="col-md-3 left_col ">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="{{ route('/alumnos') }}" class="site_title"><i class="fa fa-graduation-cap"></i> <span>IT Morelia</span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="{{asset('/res/imagen/default.png') }}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Bienvenido,</span>
              <h2>{{ Auth::user()->name }}</h2>
            </div>
          </div>
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>General</h3>
              <ul class="nav side-menu">
                <li><a><i class="fa fa-home"></i> Inicio <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="{{ route('/alumnos/perfil') }}">Perfil</a></li>
                    <li><a href="{{ route('/alumnos/mensajes') }}">Mensajes</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-edit"></i>Solicitud <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="{{ route('/alumnos/solicitud') }}">Solicitud</a></li>
                    <li><a href="{{ route('/alumnos/solicitud/editar') }}">Editar</a></li>
                    <li><a href="{{ route('/alumnos/solicitud/eliminar') }}">Eliminar</a></li>
                    <li><a href="{{ route('/alumnos/solicitud/estatus') }}">Estatus</a></li>

                  </ul>
                </li>

              </ul>
            </div>


          </div>
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
              <span class="" aria-hidden=""></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
              <span class="" aria-hidden="true"></span>
            </a>

            
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
          </a>
        </div>
        <!-- /menu footer buttons -->
      </div>
    </div>

    <!-- top navigation -->
    <div class="top_nav">
      <div class="nav_menu " style="background:#04c496;">
        <div class="nav toggle">
          <a id="menu_toggle" style="color: #34495e;"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
          <ul class=" navbar-right">
            <li class="nav-item dropdown open" style="padding-left: 15px;">
              <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                <img src="{{asset('/res/imagen/default.png') }}" alt="">{{ Auth::user()->name }}
              </a>
              <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item"  href="{{ route('/alumnos/perfil') }}"><i class="fa fa-user"></i> Perfil</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"> <i class="fa fa-sign-out"></i>
                {{ __('Salir') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </li>

          <li role="presentation" class="nav-item dropdown open">
            <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-envelope fa-3x" style="color: #34495e;"></i>
              <span class="badge bg-red">{{count($mensajes_rec)}}</span>
            </a>

            <!-------------------------------- Muestra mensajes ---------------------------->
          
              
            <ul class="dropdown-menu list-unstyled msg_list" style="height:150px; overflow:hidden; overflow-y:scroll;" role="menu" aria-labelledby="navbarDropdown1">
              @foreach ($mensajes_rec as $rec)
              <li class="nav-item" >
                <a class="dropdown-item" href="{{ route('/alumnos/mensajes') }}">
                  <span class="image"><img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Profile Image" /></span>
                  <span>
                    <span><small>{{$rec->p_nombre}}</small></span>
                    <span class="time">{{date_format (new DateTime($rec->fecha), 'd/m/Y H:i:s A')}}</span>
                  </span>
                  <span class="message">
                    {{ str_limit($rec->mensaje, $limit = 100, $end = '...')  }}
                  </span>
                </a>
              </li>
              @endforeach
              <li class="nav-item">
                <div class="text-center ">
                  <a class="dropdown-item" href="{{ route('/alumnos/mensajes') }}">
                    <strong>Ver todos los mensajes</strong>
                    <i class="fa fa-angle-right"></i>
                  </a>
                </div>
              </li>
            </ul>
            <!--------------------------------END  Muestra mensajes ---------------------------->

          </li>
        </ul>
      </nav>
    </div>
  </div>
  <!-- /top navigation -->

  <main class="py-4">
    @yield('content')
  </main>

</div>
</div>


 <!-- jQuery -->
 
      
      
<!--    Datatables-->
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script>
    function showContent() {
        element = document.getElementById("content");
        check = document.getElementById("check");
        check2 = document.getElementById("check2");
        if (check.checked) {
            element.style.display='block';
        }
        else {
          if (check2.checked) {
            element.style.display='none';
          }
        }
    }
//Idiomas con el 1er método   
$(document).ready(function() {
    $('#example').DataTable({
        "language": {
           "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        
         dom: 'lBfrtip',
          responsive: true,
         
        buttons: [{
    extend: "excel",
    className: "btn-sm btn-success",
    titleAttr: 'Export in Excel',
    text: 'Excel',
    init: function(api, node, config) {
       $(node).removeClass('btn-default')
    }
  },
  {
    extend:'pdf',
    className: "btn-sm btn-success",
    titleAttr: 'Export in PDF',
    text: 'PDF',
  },{
    extend:'csv',
    className: "btn-sm btn-success",
    titleAttr: 'Export in csv',
    text: 'CSV',
  }]        
        });
});

</script>
  
  <script src="{{asset('/res/js/funciones.js') }}"></script>
  <script src="{{asset('/res/vendors/jquery/dist/jquery.min.js') }}"></script>
  <!-- Bootstrap -->
  <script src="{{asset('/res/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <!-- FastClick -->
  <script src="{{asset('/res/vendors/fastclick/lib/fastclick.js') }}"></script>
  <!-- NProgress -->
  <script src="{{asset('/res/vendors/nprogress/nprogress.js') }}"></script>
  <!-- Chart.js -->
  <script src="{{asset('/res/vendors/Chart.js/dist/Chart.min.js') }}"></script>
  <!-- gauge.js -->
  <script src="{{asset('/res/vendors/gauge.js/dist/gauge.min.js') }}"></script>
  <!-- bootstrap-progressbar -->
  <script src="{{asset('/res/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
  <!-- iCheck -->
  <script src="{{asset('/res/vendors/iCheck/icheck.min.js') }}"></script>
  <!-- Switchery -->
  <script src="{{asset('/res/vendors/switchery/dist/switchery.min.js') }}"></script>
  <!-- Skycons -->
  <script src="{{asset('/res/vendors/skycons/skycons.js') }}"></script>
  <!-- Flot -->

  <script src="{{asset('/res/vendors/Flot/jquery.flot.js') }}"></script>
  <script src="{{asset('/res/vendors/Flot/jquery.flot.pie.js') }}"></script>
  <script src="{{asset('/res/vendors/Flot/jquery.flot.time.js') }}"></script>
  <script src="{{asset('/res/vendors/Flot/jquery.flot.stack.js') }}"></script>
  <script src="{{asset('/res/vendors/Flot/jquery.flot.resize.js') }}"></script>
  <!-- Flot plugins -->
  <script src="{{asset('/res/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
  <script src="{{asset('/res/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
  <script src="{{asset('/res/vendors/flot.curvedlines/curvedLines.js') }}"></script>
  <!-- DateJS -->
  <script src="{{asset('/res/vendors/DateJS/build/date.js') }}"></script>
  <!-- JQVMap -->
  <script src="{{asset('/res/vendors/jqvmap/dist/jquery.vmap.js') }}"></script>
  <script src="{{asset('/res/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
  <script src="{{asset('/res/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
  <!-- bootstrap-daterangepicker -->
  <script src="{{asset('/res/vendors/moment/min/moment.min.js') }}"></script>
  <script src="{{asset('/res/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
  <!-- bootstrap-datetimepicker -->    
  <script src="{{asset('/res/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}" ></script>

  <!-- Custom Theme Scripts -->
  <script src="{{asset('/res/build/js/custom.min.js') }}"></script>

  <!-- jQuery Smart Wizard -->
  <script src="{{asset('/res/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js') }}"></script>

  <!-- bootstrap-wysiwyg -->
  <script src="{{asset('/res/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js') }}"></script>
  <script src="{{asset('/res/vendors/jquery.hotkeys/jquery.hotkeys.js') }}"></script>
  <script src="{{asset('/res/vendors/google-code-prettify/src/prettify.js') }}"></script>

  <!-- Datatables -->
  <script src="{{asset('/res/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{asset('/res/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
  <script src="{{asset('/res/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{asset('/res/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
  <script src="{{asset('/res/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
  <script src="{{asset('/res/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{asset('/res/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{asset('/res/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
  <script src="{{asset('/res/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
  <script src="{{asset('/res/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{asset('/res/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
  <script src="{{asset('/res/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
  <script src="{{asset('/res/vendors/jszip/dist/jszip.min.js') }}"></script>
  <script src="{{asset('/res/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
  <script src="{{asset('/res/vendors/pdfmake/build/vfs_fonts.js') }}"></script>
  <!-- Dropzone.js -->
  <script src="{{asset('/res/vendors/dropzone/dist/min/dropzone.min.js') }}"></script>

<script>
function actualiza(id){
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
      $.ajax({
          url: '{{ route('/alumnos/mensajes/actualiza') }}',
          type:'POST',
          data:{
            'usuario_envio':id
          },
          dataType: 'text',
          success:  function (data) {
            console.log('Submission was successful.');
          },
          statusCode: {
             404: function() {
                alert('web not found');
             }
          },
          error:function(data){
            console.log('An error occurred.');
            console.log(data);
             //window.open(JSON.stringify(x));
             //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
          }
       });
}  
</script>

<script type = "text/javascript">
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $('#select_prof').click(function(){
     //we will send data and recive data fom our AjaxController
     //alert("im just clicked click me");
     $.ajax({
        url: '{{ route('/obtenerp') }}',
        type:'post',
        dataType: 'json'
        success:  function (response) {
           alert(response);
        },
        statusCode: {
           404: function() {
              alert('web not found');
           }
        },
        error:function(x,xs,xt){
           window.open(JSON.stringify(x));
           //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
        }
     });
      });
</script>

<script type = "text/javascript">
  $(document).ready(function(){
    // Bloqueamos el SELECT de los profesores
    $("#slt-profesor").prop('disabled', true);

    // Hacemos la lógica que cuando nuestro SELECT cambia de valor haga algo
    $("#op_status_tit").change(function(){
        // Guardamos el select de profesores
        var profe = $("#slt-profesor");
        var profe2 = $("#slt-profesor2");
        var profe3 = $("#slt-profesor3");
        var profe4 = $("#slt-profesor4");

        // Guardamos el select de op titulacion
        var op_titulacion = $(this);

        if($(this).val() != '')
        {
            $.ajax({
                data: { id : op_titulacion.val() },
                url:   '{{ route('/obtenerp') }}',
                type:  'GET',
                dataType: 'json',
                beforeSend: function () 
                {
                  op_titulacion.prop('disabled', true);
                  //alert('Espera unos segundos...');
                },
                success:  function (r) 
                {
                  op_titulacion.prop('disabled', false);
                    // Limpiamos el select
                    profe.find('option').remove();
                    profe2.find('option').remove();
                    profe3.find('option').remove();
                    profe4.find('option').remove();
                    profe.append('<option class="hidden"  selected disabled>Opcion </option>');
                    profe2.append('<option class="hidden"  selected disabled>Opcion </option>');
                    profe3.append('<option class="hidden"  selected disabled>Opcion </option>');
                    profe4.append('<option class="hidden"  selected disabled>Opcion </option>');

                    $(r).each(function(i, v){ // indice, valor
                      profe.append('<option value="' + v.id + '">' + v.p_nombre + '</option>');
                      profe2.append('<option value="' + v.id + '">' + v.p_nombre + '</option>');
                      profe3.append('<option value="' + v.id + '">' + v.p_nombre + '</option>');
                      profe4.append('<option value="' + v.id + '">' + v.p_nombre + '</option>');
                    })
                    profe.prop('disabled', false);
                    profe2.prop('disabled', false);
                    profe3.prop('disabled', false);
                    profe4.prop('disabled', false);
                },
                error: function()
                {
                    alert('Ocurrio un error en el servidor ..');
                    profesores.prop('disabled', false);
                }
            });
        }
        else
        {
            cursos.find('option').remove();
            cursos.prop('disabled', true);
        }
    })
})
</script>


</body>
</html>
