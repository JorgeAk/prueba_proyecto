<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="UTF-8" />
    <title>Orden de Servicio</title>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link href="{{ asset('/res/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <style type="text/css">
        @font-face {
            font-family: "source_sans_proregular";
            src: local("Source Sans Pro"), url(" {{ asset('/res/fuentes/Montserrat-ExtraBold.ttf') }}") format("truetype");
            font-weight: normal;
            font-style: normal;

        }

        body {
            font-family: 'Montserrat';
            font-size: 13px;
        }

    </style>

    <style type="text/css">
        .container {
            width: 100%;
        }

        .left {
            float: left;
            width: auto;
        }

        .right {
            float: right;
            width: auto;
        }

        .center {
            margin: 0 auto;
            width: 400px;
        }

        #contenedor {
            width: 700px;
        }

    </style>
    <style>
        table,
        td {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        td {
            padding: 2px;
            font-size: 10pt;
            text-align: center;
        }

        th {

            font-size: 10pt;

        }

        .texto-derecha {
            text-align: right;
        }

        .texto-izquierda {
            text-align: left;
        }

        .texto-centro {
            text-align: center;
        }

        .texto-jutif {
            text-align: justify;
        }

        .estilo123 {
            float: left;
            width: 50%;
        }

        .estilo1234 {
            float: left;
            width: 25%;
        }

        .tam {
            line-height: 30%;
        }

        .tam2 {
            line-height: 30%;
        }

        .tam3 {
            line-height: 150%;
        }

        .tam4 {
            line-height: 20%;

        }

        .tam5 {
            line-height: 10%;

        }

        .format-cel {

            border-collapse: collapse;

        }

    </style>


</head>

<body>
    @if ($tipo_oficio == 9)
        @foreach ($datos as $dato)
            <div class="texto-derecha">
                <p class="tam">Morelia , Mich., a {{ date_format(new DateTime($fecha), 'd/m/Y') }} </p>
                <p class="tam"><b>OFICIO</b>:{{ $dato['num_oficio'] }}</p>
            </div>
            <div class="texto-derecha">
                <p>ASUNTO: Solicitud de asignación de <br>sinodales   @foreach ($solicitud as $sol) @if ($sol->id_optitulacion != 4)
                    antes revisores
                @endif
                @endforeach 
            .</p>
            </div>
            <br>
            <br>
            <br>
            <br>
            <div class="texto-izquierda">
                <p class="tam"><b>C. {{ $dato['dirigido'] }}</b></p>
                <p class="tam"><b>{{ $dato['puesto'] }}</b></p>
            </div>
            <div class="texto-izquierda">
                <p><b></b></p>
            </div>
            <div class="texto-jutif">
                @foreach ($solicitud as $sol)
                    <p>Anexo al presente, envío expediente de solicitud de registro de opción de titulación ante la
                        División de Estudios Profesionales, él (la) C. {{ mb_strtoupper($sol->p_nombre) }}
                        {{ mb_strtoupper($sol->s_nombre) }} {{ mb_strtoupper($sol->a_paterno) }}
                        {{ mb_strtoupper($sol->a_materno) }}, con número
                        de control {{ $sol->n_control }} pasante de la carrera de @foreach ($carreras as $carr)
                            @if ($carr->id == $sol->id_carrera)
                                {{ mb_strtoupper($carr->nombre) }}@endif
                        @endforeach,
                        por la opción @foreach ($titulaciones as $tit)
                        @if ($tit->id == $sol->id_optitulacion)
                            {{ mb_strtoupper($tit->nombre) }}@endif
                    @endforeach del plan de estudios  @foreach ($planes as $plan)
                    @if ($plan->id == $sol->id_plan)
                        {{ mb_strtoupper($plan->nombre) }}@endif
                @endforeach con el
                objeto de que a la brevedad posible sean asignados los sinodales @if ($sol->id_optitulacion != 4)
                del proyecto  , si procede sean
                asignados los sinodales  y a mas tardar en 3 días hábiles emitan la impresión definitiva
                correspondiente @endif .
                    <p class="texto-jutif">Aprovecho la ocasión para enviarle un cordial saludo.</p>
                    </p>
                @endforeach
            </div>
            <br>
            <br>
            <br>
            <br>
            <div class="texto-izquierda">
                <p class="tam"><b>A T E N T A M E N T E </b>
                <p class="tam">Excelencia en Educación Tecnológica®
                <P class="tam"> <small>“Técnica, Progreso de México”®</small></p>
                </p>
                </p>
            </div>
            <br>
            <br>
            <br>
            <br>
            <div class="estilo123 texto-izquierda">
                <p class="tam2"><b>C. {{ mb_strtoupper($dato['genero']) }} <b>
                <p class="tam2"><b>COORDINADORA DE APOYO A LA TITULACIÓN<br><br><br><br>
                    DE LA DIVISIÓN DE ESTUDIOS PROFESIONALES<b></p>
                </p>

            </div>
            
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="texto-izquierda">
                <p class="tam3">
                <h6 class="tam3"> C.c.p. {{ $dato['ccp'] }}  
                    @if (!empty($dato['ccp2'])  and $dato['ccp2'] != 0) {{ "<br> C.c.p. ".$dato['ccp2'] }}@endif   
                    @if (!empty($dato['ccp3']) and $dato['ccp3'] != 0) {{ "<br> C.c.p. ".$dato['ccp3'] }}@endif  
                    @if (!empty($dato['ccp4'])  and $dato['ccp4'] != 0) {{ "<br> C.c.p. ".$dato['ccp2'] }}@endif
                    <br> LMCA/
                    @if ($dato['aacr'] != 0) {{ $dato['aacr'] }}@endif
                </h6>
                </p>

            </div>
        @endforeach
    @endif


    @if ($tipo_oficio == 11)
        @foreach ($datos as $dato)
            <div class="texto-derecha">
                <p class="tam"><b>DEPENDENCIA</b>:{{ $dato['dependencia'] }}</p>
                <p class="tam"><b>SECCIÓN</b>:{{ $dato['seccion'] }}</p>
                <p class="tam"><b>OFICIO</b>:{{ $dato['num_oficio'] }}</p><bR><br>

                <p class="tam">Morelia , Mich., a {{ $fecha_completa }} </p>
            </div>
            <div class="texto-centro">
                <h3>TITULACIÓN INTEGRAL POR  @foreach ($solicitud as $sol)
                    @foreach ($titulaciones as $tit)
                        @if ($tit->id == $sol->id_optitulacion)
                            {{ mb_strtoupper($tit->nombre) }}@endif
                    @endforeach 
                    @endforeach </h3>
            </div>
            <br>
            <br>
           
            <div class="texto-izquierda">
                <p><b>C.INTEGRANTES DEL JURADO</b></p>
            </div>
            <div class="texto-izquierda">
                @foreach ($sinodales as $rev)
                    <p class="tam">
                        @foreach ($profesores as $prof)
                            @if ($prof->id == $rev->id_profesor)
                            @if ($rev->id_tipo == 1)<b>PRESIDENTE:</b>@endif
                        @if ($rev->id_tipo == 2) <b>SECRETARIO:</b>@endif
                        @if ($rev->id_tipo == 3) <b>VOCAL PROPIETARIO:</b> @endif
                        @if ($rev->id_tipo == 4)<b> SUPLENTE:</b>@endif
                                &nbsp;{{ mb_strtoupper($prof->p_nombre) }}
                                {{ mb_strtoupper($prof->s_nombre) }}
                                {{ mb_strtoupper($prof->a_paterno) }}
                                {{ mb_strtoupper($prof->a_materno) }} <br><br><br>
                            @endif
                        @endforeach
                    </p>
                @endforeach
            </div>

            <br>
            <br>
            <br>

            <div class="texto-derecha">
                <p class="tam2"><b>C. {{ mb_strtoupper($dato['jef_serv_escolares']) }} <b>
                <p class="tam2"><b>JEFA DEl DEPTO. DE SERV. ESCOLARES<br><br><br><br>
                    <b></p>
                </p>

            </div>
           
            <div class="texto-izquierda">
                <p><b></b></p>
            </div>
            <div class="texto-jutif">
                @foreach ($solicitud as $sol)
                    <p>Por este medio le informo que el Acto de Recepción Profesional del (la) C. {{ mb_strtoupper($sol->p_nombre) }}
                        {{ mb_strtoupper($sol->s_nombre) }} {{ mb_strtoupper($sol->a_paterno) }}
                        {{ mb_strtoupper($sol->a_materno) }}, con número
                        de control {{ $sol->n_control }} egresado (a) del Instituto Tecnológico de Morelia, pasante de la carrera de @foreach ($carreras as $carr)
                            @if ($carr->id == $sol->id_carrera)
                                {{ mb_strtoupper($carr->nombre) }}@endif
                        @endforeach se realizara el dia {{$fecha_acto_completa}} en el horario {{$dato['hora_inicio']}} a
                        {{$dato['hora_fin']}} hrs.,
                            @foreach ($salas as $sala)
                            @if ($sala->id == $dato['sala'])
                            @if ($sala->nombre == "Videoconferencia")
                            mediante Videoconferencia a traves de la Plataforma Microsoft Teams.<br> Para lo cual le pido seguir el protocolo de conexión.
                            @else
                            En la  {{$sala->nombre}}. 
                            @endif
                            @endif
                            @endforeach

                        @if ($sol->id_optitulacion != 4)
                        <br>Con trabajo denominado: "{{$sol->n_proyecto}}"
                        @endif
                        .
                       
                    <p class="texto-jutif">Se le notifica a usted que cuenta con dos dias hábiles para dar aviso a su jefe de departamento
                        cualquier inconveniente en presentarse al acto recepcional.</p>
                    </p>
                @endforeach
            </div>
            <br>
            <br>
            <div class="texto-izquierda">
                <p class="tam"><b>A T E N T A M E N T E </b>
                <p class="tam">Excelencia en Educación Tecnológica®
                <P class="tam"> <small>“Técnica, Progreso de México”®</small></p>
                </p>
                </p>
            </div>
            <br>
            <br>
           
            <div class="estilo123 texto-izquierda">
                <p class="tam"><b>C. {{ $dato['jef_div_est_prof'] }}</b></p>
                <p class="tam"><b>JEFA DE LA DIV. DE EST. PROFESIONALES</b></p>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="texto-izquierda">
                <p class="tam3">
                <h6 class="tam3"> C.c.p. {{ $dato['ccp'] }}  
                    @if (!empty($dato['ccp2'])  ) <br>{{ "C.c.p. ".$dato['ccp2'] }}@endif   
                    @if (!empty($dato['ccp3']) ) <br>{{ "C.c.p. ".$dato['ccp3'] }}@endif  
                    @if (!empty($dato['ccp4']) ) <br>{{ "C.c.p. ".$dato['ccp2'] }}@endif
                    <br> PMV/
                    @if (!empty($dato['aacr'])) {{ $dato['aacr'] }}@endif
                </h6>
                </p>

            </div>
        @endforeach
    @endif



    







</body>

</html>
