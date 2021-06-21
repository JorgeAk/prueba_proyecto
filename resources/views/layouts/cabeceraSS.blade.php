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


    <!-- THIS LINE -->
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>


    <!-- Bootstrap -->
    <link href="{{ asset('/res/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel=“stylesheet” href=“https://cdn.jsdelivr.net/npm/fontisto@v3.0.4/css/fontisto/fontisto.min.css”></i>

    <link href="{{ asset('/res/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- NProgress -->
    <link href="{{ asset('/res/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('/res/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    <!-- Switchery -->
    <link href="{{ asset('/res/vendors/switchery/dist/switchery.min.css') }}" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="{{ asset('/res/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}"
        rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('/res/vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('/res/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('/res/build/css/custom.min.css') }}" rel="stylesheet">
    <!-- PNotify -->
    <link href="{{ asset('/res/vendors/pnotify/dist/pnotify.css') }}" rel="stylesheet">
    <link href=" {{ asset('/res/vendors/pnotify/dist/pnotify.buttons.css') }}" rel="stylesheet">
    <link href="{{ asset('/res/vendors/pnotify/dist/pnotify.nonblock.css') }}" rel="stylesheet">

    <!-- Datatables -->
    <link href="{{ asset('/res/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/res/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('/res/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('/res/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('/res/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}"
        rel="stylesheet" />

    <style type="text/css">
        div.dt-buttons {
            position: relative;
            float: right;
            margin-left: 5em;
        }

        div.dataTables_filter {
            position: relative;
            float: right;

        }

        div.dataTables_length {
            float: left;

        }

        .centrar {
            text-align: center;
        }

        .color1 {
            background: #04c496;
            color: #04c496;
        }

        .est {
            border: 0px solid;
            border-radius: 30px;
        }

    </style>
    <style type="text/css">
        div.dt-buttons {
            position: relative;
            float: right;
            margin-left: 5em;
        }

        div.dataTables_filter {
            position: relative;
            float: right;

        }

        div.dataTables_length {
            float: left;

        }

        .centrar {
            text-align: center;
        }

        .col-centrada {
            float: none;
            margin: 0 auto;
        }

    </style>

    <style type="text/css">
        .email-app {
            display: flex;
            flex-direction: row;
            background: #fff;
            border: 1px solid #e1e6ef;
        }

        .email-app nav {
            flex: 0 0 200px;
            padding: 1rem;
            border-right: 1px solid #e1e6ef;
        }

        .email-app nav .btn-block {
            margin-bottom: 15px;
        }

        .email-app nav .nav {
            flex-direction: column;
        }

        .email-app nav .nav .nav-item {
            position: relative;
        }

        .email-app nav .nav .nav-item .nav-link,
        .email-app nav .nav .nav-item .navbar .dropdown-toggle,
        .navbar .email-app nav .nav .nav-item .dropdown-toggle {
            color: #151b1e;
            border-bottom: 1px solid #e1e6ef;
        }

        .email-app nav .nav .nav-item .nav-link i,
        .email-app nav .nav .nav-item .navbar .dropdown-toggle i,
        .navbar .email-app nav .nav .nav-item .dropdown-toggle i {
            width: 20px;
            margin: 0 10px 0 0;
            font-size: 14px;
            text-align: center;
        }

        .email-app nav .nav .nav-item .nav-link .badge,
        .email-app nav .nav .nav-item .navbar .dropdown-toggle .badge,
        .navbar .email-app nav .nav .nav-item .dropdown-toggle .badge {
            float: right;
            margin-top: 4px;
            margin-left: 10px;
        }

        .email-app main {
            min-width: 0;
            flex: 1;
            padding: 1rem;
        }

        .email-app .inbox .toolbar {
            padding-bottom: 1rem;
            border-bottom: 1px solid #e1e6ef;
        }

        .email-app .inbox .messages {
            padding: 0;
            list-style: none;
        }

        .email-app .inbox .message {
            position: relative;
            padding: 1rem 1rem 1rem 2rem;
            cursor: pointer;
            border-bottom: 1px solid #e1e6ef;
        }

        .email-app .inbox .message:hover {
            background: #f9f9fa;
        }

        .email-app .inbox .message .actions {
            position: absolute;
            left: 0;
            display: flex;
            flex-direction: column;
        }

        .email-app .inbox .message .actions .action {
            width: 2rem;
            margin-bottom: 0.5rem;
            color: #c0cadd;
            text-align: center;
        }

        .email-app .inbox .message a {
            color: #000;
        }

        .email-app .inbox .message a:hover {
            text-decoration: none;
        }

        .email-app .inbox .message.unread .header,
        .email-app .inbox .message.unread .title {
            font-weight: bold;
        }

        .email-app .inbox .message .header {
            display: flex;
            flex-direction: row;
            margin-bottom: 0.5rem;
        }

        .email-app .inbox .message .header .date {
            margin-left: auto;
        }

        .email-app .inbox .message .title {
            margin-bottom: 0.5rem;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .email-app .inbox .message .description {
            font-size: 12px;
        }

        .email-app .message .toolbar {
            padding-bottom: 1rem;
            border-bottom: 1px solid #e1e6ef;
        }

        .email-app .message .details .title {
            padding: 1rem 0;
            font-weight: bold;
        }

        .email-app .message .details .header {
            display: flex;
            padding: 1rem 0;
            margin: 1rem 0;
            border-top: 1px solid #e1e6ef;
            border-bottom: 1px solid #e1e6ef;
        }

        .email-app .message .details .header .avatar {
            width: 40px;
            height: 40px;
            margin-right: 1rem;
        }

        .email-app .message .details .header .from {
            font-size: 12px;
            color: #9faecb;
            align-self: center;
        }

        .email-app .message .details .header .from span {
            display: block;
            font-weight: bold;
        }

        .email-app .message .details .header .date {
            margin-left: auto;
        }

        .email-app .message .details .attachments {
            padding: 1rem 0;
            margin-bottom: 1rem;
            border-top: 3px solid #f9f9fa;
            border-bottom: 3px solid #f9f9fa;
        }

        .email-app .message .details .attachments .attachment {
            display: flex;
            margin: 0.5rem 0;
            font-size: 12px;
            align-self: center;
        }

        .email-app .message .details .attachments .attachment .badge {
            margin: 0 0.5rem;
            line-height: inherit;
        }

        .email-app .message .details .attachments .attachment .menu {
            margin-left: auto;
        }

        .email-app .message .details .attachments .attachment .menu a {
            padding: 0 0.5rem;
            font-size: 14px;
            color: #e1e6ef;
        }

        @media (max-width: 767px) {
            .email-app {
                flex-direction: column;
            }

            .email-app nav {
                flex: 0 0 100%;
            }
        }

        @media (max-width: 575px) {
            .email-app .message .header {
                flex-flow: row wrap;
            }

            .email-app .message .header .date {
                flex: 0 0 100%;
            }
        }

    </style>





</head>

<body class="nav-md" onload="contador();">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="{{ route('/docencia/ss') }}" class="site_title"><i class="fa fa-graduation-cap"></i>
                            <span>IT Morelia</span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="{{ asset('/res/imagen/default.png') }}" alt="..."
                                class="img-circle profile_img">
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
                                        <li><a href="{{ route('/servicio/perfil') }}">Perfil</a></li>
                                        <li><a href="{{ route('/servicio/correo/mensajes', 'inbox') }}">Mensajes</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-graduation-cap"></i>Alumnos <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('/servicio/alumnos/solicitudes') }}">Solicitudes</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-black-tie"></i>Ceremonia <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('/servicio/ceremonias') }}">Ver</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-book"></i>Profesores <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('/servicio/profesores/modificar') }}">Ver listado</a>
                                        </li>
                                        <li><a
                                                href="{{ route('/servicio/profesores/solicitudes/revisores') }}">Revisores</a>
                                        </li>
                                        <li><a
                                                href="{{ route('/servicio/profesores/solicitudes/sinodales') }}">Sinodales</a>
                                        </li>
                                    </ul>
                                </li>
                                
                                <li><a><i class="fa fa-envelope"></i>Correo <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('/servicio/correo/mensajes', 'inbox') }}">Bandeja</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-file-text-o"></i>Oficios <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('/servicio/oficios/agregar') }}">Agregar</a></li>
                                        <li><a href="{{ route('/servicio/oficios/modificar') }}">Modificar</a></li>
                                        <li><a href="{{ route('/servicio/oficios/generar') }}">Generar</a></li>
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


                        <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
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
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true"
                                    id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('/res/imagen/default.png') }}"
                                        alt="">{{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right"
                                    aria-labelledby="navbarDropdown">



                                    <a class="dropdown-item" href="{{ route('/servicio/perfil') }}"><i
                                            class="fa fa-user"></i> Perfil</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"> <i class="fa fa-sign-out"></i>
                                        {{ __('Salir') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                            <li role="presentation" class="nav-item dropdown open">
                                <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1"
                                    data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-envelope fa-3x" style="color: #34495e;"></i>
                                    <span class=""><span
                                            class="badge bg-red">{{ count($recibidos_ind) }}</span></span>
                                </a>

                                <!-------------------------------- Muestra mensajes ---------------------------->


                                <ul class="dropdown-menu list-unstyled msg_list"
                                    style="height:150px; overflow:hidden; overflow-y:scroll;" role="menu"
                                    aria-labelledby="navbarDropdown1">
                                    @foreach ($recibidos_ind as $rec)
                                        <li class="nav-item">
                                            <a class="dropdown-item"
                                                href="{{ route('/servicio/mensajeSe_Detalle', $rec->id) }}">
                                                <span class="image"><img
                                                        src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                                        alt="Profile Image" /></span>
                                                <span>
                                                    <span>{{ $rec->usuario_envio }}</span>
                                                    <span
                                                        class="time">{{ date_format(new DateTime($rec->fecha), 'd/m/Y H:i:s A') }}</span>
                                                </span>
                                                <span class="message">
                                                    {{ str_limit($rec->mensaje, $limit = 100, $end = '...') }}
                                                </span>
                                            </a>
                                        </li>
                                    @endforeach
                                    <li class="nav-item">
                                        <div class="text-center ">
                                            <a class="dropdown-item"
                                                href="{{ route('/servicio/correo/mensajes', 'inbox') }}">
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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script>
        function muestra(id, oc) {

            $('#' + oc + '').show();
            $('#' + id + '').hide();
        };

        function oculta(id, oc) {
            $('#' + id + '').show();
            $('#' + oc + '').hide();
        }

        function showContent() {
            element = document.getElementById("content");
            check = document.getElementById("check");
            check2 = document.getElementById("check2");
            if (check.checked) {
                element.style.display = 'block';
            } else {
                if (check2.checked) {
                    element.style.display = 'none';
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
                "order": [
                    [0, "desc"]
                ],

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
                        extend: 'pdf',
                        className: "btn-sm btn-success",
                        titleAttr: 'Export in PDF',
                        text: 'PDF',
                    }, {
                        extend: 'csv',
                        className: "btn-sm btn-success",
                        titleAttr: 'Export in csv',
                        text: 'CSV',
                    }
                ]
            });
        });

    </script>

    <script src="{{ asset('/res/js/funciones.js') }}"></script>
    <script src="{{ asset('/res/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('/res/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('/res/vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('/res/vendors/nprogress/nprogress.js') }}"></script>
    <!-- Chart.js -->
    <script src="{{ asset('/res/vendors/Chart.js/dist/Chart.min.js') }}"></script>
    <!-- gauge.js -->
    <script src="{{ asset('/res/vendors/gauge.js/dist/gauge.min.js') }}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset('/res/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('/res/vendors/iCheck/icheck.min.js') }}"></script>
    <!-- Switchery -->
    <script src="{{ asset('/res/vendors/switchery/dist/switchery.min.js') }}"></script>
    <!-- Skycons -->
    <script src="{{ asset('/res/vendors/skycons/skycons.js') }}"></script>
    <!-- Flot -->

    <script src="{{ asset('/res/vendors/Flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('/res/vendors/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('/res/vendors/Flot/jquery.flot.time.js') }}"></script>
    <script src="{{ asset('/res/vendors/Flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('/res/vendors/Flot/jquery.flot.resize.js') }}"></script>
    <!-- Flot plugins -->
    <script src="{{ asset('/res/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
    <script src="{{ asset('/res/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
    <script src="{{ asset('/res/vendors/flot.curvedlines/curvedLines.js') }}"></script>
    <!-- DateJS -->
    <script src="{{ asset('/res/vendors/DateJS/build/date.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('/res/vendors/jqvmap/dist/jquery.vmap.js') }}"></script>
    <script src="{{ asset('/res/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('/res/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('/res/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('/res/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ asset('/res/build/js/custom.min.js') }}"></script>

    <!-- jQuery Smart Wizard -->
    <script src="{{ asset('/res/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js') }}"></script>

    <!-- bootstrap-wysiwyg -->
    <script src="{{ asset('/res/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js') }}"></script>
    <script src="{{ asset('/res/vendors/jquery.hotkeys/jquery.hotkeys.js') }}"></script>
    <script src="{{ asset('/res/vendors/google-code-prettify/src/prettify.js') }}"></script>

    <!-- PNotify -->
    <script src="{{ asset('/res/vendors/pnotify/dist/pnotify.js') }}"></script>
    <script src="{{ asset('/res/vendors/pnotify/dist/pnotify.buttons.js') }}"></script>
    <script src="{{ asset('/res/vendors/pnotify/dist/pnotify.nonblock.js') }}"></script>


    <!-- Datatables -->
    <script src="{{ asset('/res/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/res/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('/res/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/res/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('/res/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('/res/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('/res/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('/res/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('/res/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('/res/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/res/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
    <script src="{{ asset('/res/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
    <script src="{{ asset('/res/vendors/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('/res/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/res/vendors/pdfmake/build/vfs_fonts.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var maxField = 10; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML =
                '<div> Campo* <a href="javascript:void(0);" class="remove_button btn btn-success" title="Remove field"> <i class="fa fa-remove"></i></a><div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre del campo<span class="required">*</span></label> <input class="col-md-6 col-sm-6" type="text" name="field_name[]" value=""/> </div>   <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tipo<span class="required">*</span></label> <input class="col-md-6 col-sm-6" type="text" name="field_name[]" value=""/> </div>   <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Longitud<span class="required">*</span></label> <input class="col-md-6 col-sm-6" type="text" name="field_name[]" value=""/> </div> </div>  '; //New input field html 
            var x = 1; //Initial field counter is 1
            $(addButton).click(function() { //Once add button is clicked
                if (x < maxField) { //Check maximum number of input fields
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); // Add field html
                }
            });
            $(wrapper).on('click', '.remove_button', function(e) { //Once remove button is clicked
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });

    </script>
    <script>
        function contador() {
            const counters = document.querySelectorAll('.counter');
            const speed = 1;
            counters.forEach(counter => {
                const updateCount = () => {
                    const target = +counter.getAttribute('data-target');
                    const count = +counter.innerText;
                    const inc = target / speed;
                    if (count < target) {
                        counter.innerText = count + inc;
                        setTimeout(updateCount, 1);

                    } else {
                        counter.innerText = target;
                    }

                };
                updateCount();
            });
        }

    </script>



    <script>
        /*
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route('/docencia/resumen') }}',
                type: 'get',
                dataType: 'json'
                success: function(response) {
                    contador();
                    var solicitudes = 0;
                    var aceptados = 0;
                    var rechazados = 0;
                    var revision = 0;

                    /*$(r).each(function(i, v){ // indice, valor
                              solicitudes = v.nuevas;
                              aceptados   = v.aceptado;
                              revision    = v.revision;
                              rechazados  = v.rechazado;
                            })
                    count(solicitudes,aceptados,revision,rechazados);
                },
                statusCode: {
                    404: function() {
                        alert('web not found');
                    }
                },
                error: function(x, xs, xt) {
                    window.open(JSON.stringify(x));
                    //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
                }
            });


        });
        */

    </script>


    <script type="text/javascript">
        function mostrar_oficio(id) {
            //console.log(id);

            generar_formulario(id);
            /*
              var vacio = "";
              var n_oficio =
                  '<div class="form-group row" id="id_num_of"><label class="control-label col-md-3 col-sm-3 " for="first-name">Numero de oficio:<span class="required">*</span></label><div class="col-md-9 col-sm-9 "><input type="text" required id="first-name" name="num_oficio" class="form-control "></div></div>';
              var dirigido =
                  '<div class="form-group row" id="id_dirigido"><label class="control-label col-md-3 col-sm-3 " for="first-name">Dirigido a:<span class="required">*</span></label><div class="col-md-9 col-sm-9 "><input required type="text" id="first-name" name="dirigido" class="form-control "></div></div>';
              var puesto =
                  '<div class="form-group row" id="id_puesto"><label class="control-label col-md-3 col-sm-3 " for="first-name">Puesto<span class="required">*</span></label><div class="col-md-9 col-sm-9 "><input required type="text" id="first-name" name="puesto" class="form-control"></div></div>';
              var jef_dep =
                  '<div class="form-group row" id="id_jef_dep"><label class="control-label col-md-3 col-sm-3 " for="first-name">Jeje del departamento:<span class="required">*</span></label><div class="col-md-9 col-sm-9 "><input required type="text" id="first-name" name="genero" class="form-control "></div></div>';
              var depto =
                  '<div class="form-group row" id="id_jef_dep_depp"><label class="control-label col-md-3 col-sm-3 " for="first-name">Departamento<span class="required">*</span></label><div class="col-md-9 col-sm-9 "><input required type="text" id="first-name" name="departamento" class="form-control "></div></div>';
              var pres_ac =
                  '<div class="form-group row" id="id_pres_aca"><label class="control-label col-md-3 col-sm-3 " for="first-name">Presidente de la Academia<span class="required">*</span></label><div class="col-md-9 col-sm-9 "><input required type="text" id="first-name" name="n_presid_academia" class="form-control "></div></div><div class="form-group row" id="id_pres_aca_area"><label class="control-label col-md-3 col-sm-3 " for="first-name">Area<span class="required">*</span></label><div class="col-md-9 col-sm-9 "><input type="text" id="first-name" name="n_area" class="form-control "></div></div>';
              var ccp =
                  '<div class="form-group row" id="id_ccp_01"><label class="control-label col-md-3 col-sm-3 " for="first-name">C.c.p/<span class="required">*</span></label><div class="col-md-9 col-sm-9 "><input required type="text" id="first-name" name="ccp" class="form-control "></div></div><div class="form-group row" id="id_ccp_02"><label class="control-label col-md-3 col-sm-3 " for="first-name">C.c.p/<span class="required">*</span></label><div class="col-md-9 col-sm-9 "><input type="text" id="first-name" name="ccp2" class="form-control "></div></div>';
              var aacr =
                  '<div class="form-group row" id="id_aacr"><label class="control-label col-md-3 col-sm-3 " for="first-name">AACR/<span class="required">*</span></label><div class="col-md-9 col-sm-9 "><input required type="text" id="first-name" name="aacr" class="form-control "></div></div>';

              var oficio_2 =
                  '<div class="form-group row"><label class="control-label col-md-3 col-sm-3 " for="first-name">Nombre de Jefe de Proyecto de Investigación<span class="required">*</span></label><div class="col-md-9 col-sm-9 "><input required type="text" id="first-name" name="n_jefe_proy_inv" class="form-control "></div></div><div class="form-group row"><label class="control-label col-md-3 col-sm-3 " for="first-name">Departamento<spanclass="required">*</span></label><div class="col-md-9 col-sm-9 "><input type="text" id="first-name" name="departamento_jefe_proy_inv" class="form-control "></div></div><div class="form-group row"><label class="control-label col-md-3 col-sm-3 " for="first-name">Observaciones<spanclass="required">*</span></label><div class="col-md-9 col-sm-9 "><input type="text" id="first-name" name="observaciones" class="form-control "></div></div>';
              var oficio_3 = '';
              var oficio_5 =
                  '<div class="form-group row" id="id_aacr"><label class="control-label col-md-3 col-sm-3 " for="first-name">Jefe proyecto Docencia <spanclass="required">*</span></label><div class="col-md-9 col-sm-9 "><input required type="text" id="first-name" name="jef_proy_doc" class="form-control "></div></div>';
              var oficio_7 =
                  '<div class="form-group row"><label class="control-label col-md-3 col-sm-3 " for="first-name">Dependencia:<span class="required">*</span></label><div class="col-md-9 col-sm-9 "><input required type="text" id="first-name" name="dependencia" class="form-control "></div></div><div class="form-group row"><label class="control-label col-md-3 col-sm-3 " for="first-name">Seccion:<span class="required">*</span></label><div class="col-md-9 col-sm-9 "><input type="text" id="first-name" name="seccion" class="form-control required "></div></div>';
              if (id == "1") {
                
                
                  $("#of1").show();
                  $("#of2").html(n_oficio + dirigido + puesto + jef_dep + depto + pres_ac + ccp + aacr);
                  $("#of3").html(vacio);
                  $("#of4").html(vacio);
                  $("#of5").html(vacio);
                  $("#of6").html(vacio);
                  $("#of7").html(vacio);
                  $("#of8").html(vacio);
                  $("#of10").html(vacio);
                  
              }

              if (id == "2") {
                  $("#of1").show();
                  $("#of2").html(n_oficio + dirigido + puesto + jef_dep + depto + pres_ac + ccp + aacr + oficio_2);
                  $("#of3").html(vacio);
                  $("#of4").html(vacio);
                  $("#of5").html(vacio);
                  $("#of6").html(vacio);
                  $("#of7").html(vacio);
                  $("#of8").html(vacio);
                  $("#of10").html(vacio);
              }

              if (id == "3") {
                  $("#of1").show();
                  $("#of2").html(vacio);
                  $("#of3").html(n_oficio + jef_dep + depto + pres_ac + ccp + aacr);
                  $("#of4").html(vacio);
                  $("#of5").html(vacio);
                  $("#of6").html(vacio);
                  $("#of7").html(vacio);
                  $("#of8").html(vacio);
                  $("#of10").html(vacio);
              }

              if (id == "4") {
                  $("#of1").show();
                  $("#of2").html(vacio);
                  $("#of3").html(vacio);
                  $("#of4").html(vacio);
                  $("#of5").html(vacio);
                  $("#of6").html(vacio);
                  $("#of7").html(vacio);
                  $("#of8").html(vacio);
                  $("#of10").html(vacio);
              }
              if (id == "5") {
                  $("#of1").show();
                  $("#of5").html(n_oficio + oficio_5 + ccp + aacr);
                  $("#of2").html(vacio);
                  $("#of3").html(vacio);
                  $("#of4").html(vacio);
                  $("#of6").html(vacio);
                  $("#of7").html(vacio);
                  $("#of8").html(vacio);
                  $("#of10").html(vacio);
                  /*
                  $("#of1").hide();
                    $("#of2").hide();
                    $("#of3").hide();
                    $("#of4").hide();
                    $("#of5").show();
                    $("#of6").hide();
                    $("#of7").hide();
                    $("#of8").hide();
                    $("#of10").hide();
                    
              }
              
              if (id == "6") {
                  $("#of1").show();
                  $("#of2").html(vacio);
                  $("#of3").html(vacio);
                  $("#of4").html(vacio);
                  $("#of5").html(vacio);
                  $("#of6").html(n_oficio + dirigido + puesto + ccp + aacr);
                  $("#of7").html(vacio);
                  $("#of8").html(vacio);
                  $("#of10").html(vacio);
              }
              if (id == "7") {
                  $("#of1").show();
                  $("#of2").html(n_oficio + dirigido + puesto + jef_dep + depto + pres_ac + ccp + aacr + oficio_7);
                  $("#of3").html(vacio);
                  $("#of4").html(vacio);
                  $("#of5").html(vacio);
                  $("#of6").html(vacio);
                  $("#of7").html(vacio);
                  $("#of8").html(vacio);
                  $("#of10").html(vacio);
              }
              if (id == "8") {
                  $("#of1").show();
                  $("#of2").html(vacio);
                  $("#of3").html(vacio);
                  $("#of4").html(vacio);
                  $("#of5").html(vacio);
                  $("#of6").html(vacio);
                  $("#of7").html(vacio);
                  $("#of8").html(n_oficio + dirigido + puesto + jef_dep + depto + ccp + aacr + oficio_7);
                  $("#of10").html(vacio);
              }
              if (id == "10") {
                  $("#of1").show();
                  $("#of2").html(vacio);
                  $("#of3").html(vacio);
                  $("#of4").html(vacio);
                  $("#of5").html(vacio);
                  $("#of6").html(vacio);
                  $("#of7").html(vacio);
                  $("#of8").html(vacio);
                  $("#of10").html(n_oficio + dirigido + puesto + ccp + aacr + oficio_7);
              }

              */

        }

        function generar_formulario(id) {
          $("#of1").show();
          var campos = "";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route('/servicio/oficios/obtener/formulario', '') }}' + '/' + id,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                  var dato = response;
                  if(dato!= ""){
                    $.each(dato,function(i, v){ // indice, valor
                      console.log(v.id);
                      campos += '<div class="form-group row" id="id_num_of"><label class="control-label col-md-3 col-sm-3" for="first-name">'+v.nombre+'<span class="required">*</span></label><div class="col-md-9 col-sm-9 "><input type="'+v.tipo+'" required id="'+v.nombre_corto+'" name="'+v.nombre_corto+'" class="form-control "></div></div>';
                      $("#of2").html(campos);
                      //campos =''':';
                    });

                  }else{
                    $("#of2").html(campos);

                  }
                 
                    

                },
                statusCode: {
                    404: function() {
                        alert('web not found');
                    }
                },
                error: function(x, xs, xt) {
                    window.open(JSON.stringify(x));
                    //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
                }
            });
        }

    </script>





</body>

</html>
