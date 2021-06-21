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
    @if ($tipo_oficio == 1)
        @foreach ($datos as $dato)
            <div class="texto-derecha">
                <p class="tam">Morelia , Mich., a {{ date_format(new DateTime($fecha), 'd/m/Y') }} </p>
                <p class="tam"><b>OFICIO</b>:{{ $dato['num_oficio'] }}</p>
            </div>
            <div class="texto-derecha">
                <p>ASUNTO: Autorizacion de tema y asignacion<br> de asesor <br> de proyecto para Titulación.</p>
            </div>
            <br>
            <br>
            <br>
            <br>
            <div class="texto-izquierda">
                <p class="tam">{{ $dato['dirigido'] }}</p>
                <p class="tam"><b>{{ $dato['puesto'] }}</b></p>
            </div>
            <div class="texto-izquierda">
                <p><b>PRESENTE</b></p>
            </div>
            <div class="texto-jutif">
                @foreach ($solicitud as $sol)
                    <p>Por este medio le informo que el proyecto del alumno {{ mb_strtoupper($sol->p_nombre) }}
                        {{ mb_strtoupper($sol->s_nombre) }} {{ mb_strtoupper($sol->a_paterno) }}
                        {{ mb_strtoupper($sol->a_materno) }}, con número
                        de control {{ $sol->n_control }} de la carrera de @foreach ($carreras as $carr)
                            @if ($carr->id == $sol->id_carrera)
                                {{ mb_strtoupper($carr->nombre) }}@endif
                        @endforeach,
                        denominado “{{ mb_strtoupper($sol->n_proyecto) }}”,
                        ha sido REGISTRADO y AUTORIZADO como tema para la TITULACIÓN bajo la opción: TITULACIÓN
                        INTEGRAL POR @foreach ($titulaciones as $tit)
                            @if ($tit->id == $sol->id_optitulacion)
                                {{ mb_strtoupper($tit->nombre) }}@endif
                        @endforeach, haciendo la designación de
                        @foreach ($profesores as $prof)
                            @if ($prof->id == $sol->id_asesor)
                                {{ mb_strtoupper($prof->p_nombre) }} {{ mb_strtoupper($prof->s_nombre) }}
                                {{ mb_strtoupper($prof->a_paterno) }} {{ mb_strtoupper($prof->a_materno) }}
                            @endif
                        @endforeach como ASESOR DEL PROYECTO.
                    <p class="texto-jutif">Agradezco la atención al presente y aprovecho para enviar un
                        afectuoso saludo.</p>
                    </p>
                @endforeach
            </div>
            <br>
            <br>
            <br>
            <br>
            <div class="texto-centro">
                <p class="tam">A T E N T A M E N T E
                <p class="tam">Excelencia en Educación Tecnológica®
                <P class="tam"> <small>“Técnica, Progreso de México”®</small></p>
                </p>
                </p>
            </div>
            <br>
            <br>
            <br>
            <br>
            <div class="estilo123 texto-centro">
                <p class="tam2">{{ mb_strtoupper($dato['genero']) }}
                <p class="tam2">{{ $dato['departamento'] }}</p>
                </p>

            </div>
            <div class="estilo123 texto-centro">
                <p class="tam2">{{ $dato['n_presid_academia'] }}

                <p class="tam2">{{ $dato['n_area'] }}</p>
                </p>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="texto-izquierda">
                <p class="tam3">
                <h6 class="tam3"> C.c.p. {{ $dato['ccp'] }} <br> C.c.p. {{ $dato['ccp2'] }} <br> AACR/
                    @if ($dato['aacr'] != 0) {{ $dato['aacr'] }}@endif
                </h6>
                </p>

            </div>
        @endforeach
    @endif

    <!------------------------------------------ OFICIO 2------------------------------------------------------>
    @if ($tipo_oficio == 2)
        @foreach ($datos as $dato)
            <div class="texto-derecha">
                <p class="tam">Morelia , Mich., a {{ date_format(new DateTime($fecha), 'd/m/Y') }} </p>
                <p class="tam"><b>OFICIO</b>:{{ $dato['num_oficio'] }}</p>
            </div>
            <div class="texto-derecha">
                <p><u>ASUNTO: Registro de Informe Técnico de Residencia Profesional.</u></p>
            </div>
            <br>
            <br>
            <div class="texto-izquierda">
                <p class="tam">{{ $dato['dirigido'] }}</p>
                <p class="tam"><b>{{ $dato['puesto'] }}</b></p>
                <p class="tam5"><b>PRESENTE</b></p>
            </div>
            <div style="float: right;">
                <p style="border: black 1px solid;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    {{ $fecha_completa }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            </div>
            <div style=" float: right;">
                <p style="border: black 1px solid;">&nbsp;&nbsp;&nbsp;Fecha:&nbsp;&nbsp;&nbsp; </p>
            </div>
            <br>
            <br>
            <br>
            <div>
                @foreach ($solicitud as $sol)
                    <table cellspacing="0">
                        <thead>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: left;">Nombre de del proyecto </td>
                                <td style="text-align: left;">{{ $sol->n_proyecto }}</td>
                            </tr>
                            <tr>
                                <td style="text-align: left;">Nombre del asesor</td>
                                <td style="text-align: left;">
                                    @foreach ($profesores as $prof)
                                        @if ($prof->id == $sol->id_asesor)
                                            {{ mb_strtoupper($prof->p_nombre) }}
                                            {{ mb_strtoupper($prof->s_nombre) }}
                                            {{ mb_strtoupper($prof->a_paterno) }}
                                            {{ mb_strtoupper($prof->a_materno) }}
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left;">Numero de Estudiantes</td>
                                <td style="text-align: left;">1</td>
                            </tr>
                        </tbody>
                    </table>
                @endforeach
                <p class="texto-centro tam3"><b>Datos del Estudiante</b></p>
                @foreach ($solicitud as $sol)
                    <table cellspacing="0">
                        <thead>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: left;">Nombre del(a) alumno(a):</td>
                                <td style="text-align: left;">{{ $sol->p_nombre }} {{ $sol->s_nombre }}
                                    {{ $sol->a_paterno }}
                                    {{ $sol->a_materno }}</td>
                            </tr>
                            <tr>
                                <td style="text-align: left;">No. Control:</td>
                                <td style="text-align: left;">{{ $sol->n_control }} </td>
                            </tr>
                            <tr>
                                <td style="text-align: left;">Carrera:</td>
                                <td style="text-align: left;">
                                    @foreach ($carreras as $carr)
                                        @if ($carr->id == $sol->id_carrera)
                                            {{ mb_strtoupper($carr->nombre) }}@endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left;">Observaciones:</td>
                                <td style="text-align: left;">{{ $dato['observaciones'] }} </td>
                            </tr>
                        </tbody>
                    </table>
                @endforeach

            </div>
            <br>
            <br>


            <div class="texto-centro">
                <p class="tam">A T E N T A M E N T E
                <p class="tam">Excelencia en Educación Tecnológica®
                <P class="tam"> <small>“Técnica, Progreso de México”®</small></p>
                </p>
                </p>
            </div>
            <br>
            <br>
            <br>
            <br>
            <div class="estilo123 texto-centro">
                <p class="tam2">{{ mb_strtoupper($dato['genero']) }}
                <p class="tam2">{{ $dato['departamento'] }}</p>
                </p>
            </div>
            <div class="estilo123 texto-centro">
                <p class="tam2">{{ mb_strtoupper($dato['n_presid_academia']) }}
                <p class="tam2">{{ $dato['n_area'] }}</p>
                </p>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="  texto-centro">
                <p class="tam2">{{ mb_strtoupper($dato['n_jefe_proy_inv']) }}
                <p class="tam2">Jefe de Proyecto Investigación</p>
                <p class="tam2">{{ $dato['departamento_jefe_proy_inv'] }}
                </p>
                </p>
            </div>
            <br>
            <br>
            <div class="texto-izquierda">
                <p class="tam3">
                <h6 class="tam3"> C.c.p. {{ $dato['ccp'] }} <br> C.c.p. {{ $dato['ccp2'] }} <br> AACR/
                    @if ($dato['aacr'] != 0) {{ $dato['aacr'] }}@endif
                </h6>
                </p>
            </div>
        @endforeach
    @endif


    <!------------------------------------------ OFICIO 3------------------------------------------------------>
    @if ($tipo_oficio == 3)
        @foreach ($datos as $dato)
            <div class="texto-derecha">
                <p class="tam">Morelia , Mich., a {{ date_format(new DateTime($fecha), 'd/m/Y') }} </p>
                <p class="tam"><b>OFICIO</b>:{{ $dato['num_oficio'] }}</p>
            </div>
            <br>
            <h4 class="texto-centro ">DEPARTAMENTO DE SISTEMAS Y COMPUTACIÓN <br>REVISORES PARA OPCIÓN DE TITULACIÓN
            </h4>
            <br>
            <br>
            <div>
                @foreach ($solicitud as $sol)
                    <table cellspacing="0">
                        <thead>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: left;">&nbsp;Nombre del(a) alumno(a):</td>
                                <td style="text-align: left;">&nbsp;{{ $sol->p_nombre }} {{ $sol->s_nombre }}
                                    {{ $sol->a_paterno }}
                                    {{ $sol->a_materno }}</td>
                            </tr>
                            <tr>
                                <td style="text-align: left;">&nbsp;No. Control:</td>
                                <td style="text-align: left;">&nbsp;{{ $sol->n_control }} </td>
                            </tr>
                            <tr>
                                <td style="text-align: left;">&nbsp;Opción de Titulación</td>
                                <td style="text-align: left;">
                                    @foreach ($titulaciones as $tit)
                                        @if ($tit->id == $sol->id_optitulacion)
                                            &nbsp;{{ mb_strtoupper($tit->nombre) }}@endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left;">&nbsp;Carrera:</td>
                                <td style="text-align: left;">
                                    @foreach ($carreras as $carr)
                                        @if ($carr->id == $sol->id_carrera)
                                            &nbsp;{{ mb_strtoupper($carr->nombre) }}@endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left;">&nbsp;Título del trabajo:</td>
                                <td style="text-align: left;">&nbsp;{{ $sol->n_proyecto }} </td>
                            </tr>
                            <tr>
                                <td style="text-align: left;">&nbsp;Asesor:</td>
                                <td style="text-align: left;">
                                    @foreach ($profesores as $prof)
                                        @if ($prof->id == $sol->id_asesor)
                                            &nbsp;{{ mb_strtoupper($prof->p_nombre) }}
                                            {{ mb_strtoupper($prof->s_nombre) }}
                                            {{ mb_strtoupper($prof->a_paterno) }}
                                            {{ mb_strtoupper($prof->a_materno) }}
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>
                @endforeach
                <p class="texto-centro tam3"><b>Revisores</b></p>
                <table cellspacing="0">
                    <thead>
                        <tr>
                            <th>Cargo</th>
                            <th>Nombre del(la) Profesor(a)</th>
                            <th>Firma</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datos as $dato)
                        <tr>
                            <td style="text-align: left;">
                                 &nbsp;Presidente<br>
                            </td>
                            <td style="text-align: left;">
                                @foreach ($profesores as $prof)
                                @if ($prof->id == $sol->id_asesor)
                                    &nbsp;{{ mb_strtoupper($prof->p_nombre) }}
                                    {{ mb_strtoupper($prof->s_nombre) }}
                                    {{ mb_strtoupper($prof->a_paterno) }}
                                    {{ mb_strtoupper($prof->a_materno) }}
                                @endif
                            @endforeach
                                       <br>
                                       <br>
                            </td>
                            <td style="text-align: left;">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </td>
                            
                        </tr>
                            <tr>
                                <td style="text-align: left;">
                                     &nbsp;Secretario<br>
                                </td>
                                <td style="text-align: left;">
                                           {{$dato['p_revisor']}} &nbsp;<br>
                                           <br>
                                           <br>
                                </td>
                                <td style="text-align: left;">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </td>
                                
                            </tr>
                            <tr>
                                <td style="text-align: left;">
                                     &nbsp;Vocal<br>
                                </td>
                                <td style="text-align: left;">
                                           {{$dato['s_revisor']}} <br>
                                           <br>
                                           <br>
                                </td>
                                <td style="text-align: left;">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </td>
                                
                            </tr>
                            <tr>
                                <td style="text-align: left;">
                                    
                                     &nbsp;Vocal Propietario <br>
                                     
                                </td>
                                <td style="text-align: left;">
                                           {{$dato['t_revisor']}} 
                                           <br>
                                           <br>
                                </td>
                                <td style="text-align: left;">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </td>
                                
                            </tr>
                            

                        @endforeach

                    </tbody>
                </table>

            </div>
            <br>
            <br>


            <div class="estilo123 texto-centro" style="border: black .5px solid;">
                <div style="border: black .5px solid;"><br><br><br><br><br></div>
                <p class="tam2">{{ mb_strtoupper($dato['genero']) }}
                <p class="tam2">{{ $dato['departamento'] }}</p>
                </p>
            </div>
            <div class="estilo123 texto-centro" style="border: black .5px solid;">
                <div style="border: black .5px solid;"><br><br><br><br><br></div>
                <p class="tam2">{{ mb_strtoupper($dato['n_presid_academia']) }}
                <p class="tam2">{{ $dato['n_area'] }}</p>
                </p>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>

            <div class="texto-izquierda">
                <p class="tam3">
                <h6 class="tam3"> C.c.p. {{ $dato['ccp'] }} <br> C.c.p. {{ $dato['ccp2'] }} <br> AACR/
                    @if ($dato['aacr'] != 0) {{ $dato['aacr'] }}@endif
                </h6>
                </p>
            </div>
        @endforeach
    @endif

    <!------------------------------------------ OFICIO 5------------------------------------------------------>
    @if ($tipo_oficio == 5)
        @foreach ($datos as $dato)
            <div class="texto-derecha">
                <p class="tam">Morelia , Mich., a {{ date_format(new DateTime($fecha), 'd/m/Y') }} </p>
                <p class="tam"><b>OFICIO</b>:{{ $dato['num_oficio'] }}</p>
            </div>
            <div class="texto-derecha">
                <p><u>ASUNTO: Revisión final de proyecto de titulación.<u></p>
            </div>
            <br>
            <div class="texto-izquierda">
                
                    <p class="tam">
                        @foreach ($solicitud as $sol)
                        @foreach ($profesores as $prof)
                                @if ($prof->id == $sol->id_asesor)
                                    {{ mb_strtoupper($prof->p_nombre) }}
                                    {{ mb_strtoupper($prof->s_nombre) }}
                                    {{ mb_strtoupper($prof->a_paterno) }}
                                    {{ mb_strtoupper($prof->a_materno) }}
                                @endif
                            @endforeach
                            @endforeach <br><br><br>
                            {{$dato['p_revisor']}}<br><br><br>
                            {{$dato['s_revisor']}}<br><br><br>
                            {{$dato['t_revisor']}}<br><br><br>  
                            
                            
                    </p>
               
            </div>
            <div class="texto-izquierda">
                <p><b>PRESENTE</b></p>
            </div>
            <div class="texto-jutif">
                @foreach ($solicitud as $sol)
                    <p>A través del presente les envío un cordial saludo y por otro lado les solicito de
                        la manera más atenta AUTORIZAR, RECHAZAR,
                        tal como lo llevaron a cabo en el proceso de revisión del proyecto del alumno
                        {{ mb_strtoupper($sol->p_nombre) }}
                        {{ mb_strtoupper($sol->s_nombre) }} {{ mb_strtoupper($sol->a_paterno) }}
                        {{ mb_strtoupper($sol->a_materno) }}, con número
                        de control {{ $sol->n_control }} de la carrera de @foreach ($carreras as $carr)
                            @if ($carr->id == $sol->id_carrera)
                                {{ mb_strtoupper($carr->nombre) }}@endif
                        @endforeach,
                        denominado “{{ mb_strtoupper($sol->n_proyecto) }}”,
                        como tema para la TITULACIÓN bajo la opción: TITULACIÓN
                        INTEGRAL POR @foreach ($titulaciones as $tit)
                            @if ($tit->id == $sol->id_optitulacion)
                                {{ mb_strtoupper($tit->nombre) }}@endif
                        @endforeach. Queda como soporte los correos electrónicos que se anexarán al
                        expediente del alumno donde han emitido sus dictámenes, así como las correcciones en su caso.
                    </p>
                @endforeach
            </div>
            <br>
            <table cellspacing="0">
                <thead>
                    <tr>
                        <th>Docente</th>
                        <th>Autorizado</th>
                        <th>Rechazado</th>
                    </tr>
                </thead>
                <tbody>
                
                        <tr>
                            <td style="text-align: left;">
                                @foreach ($solicitud as $sol)
                                @foreach ($profesores as $prof)
                                        @if ($prof->id == $sol->id_asesor)
                                            {{ mb_strtoupper($prof->p_nombre) }}
                                            {{ mb_strtoupper($prof->s_nombre) }}
                                            {{ mb_strtoupper($prof->a_paterno) }}
                                            {{ mb_strtoupper($prof->a_materno) }}
                                        @endif
                                    @endforeach
                                    @endforeach <br><br><br>   
                            </td>
                            <td style="text-align: left;">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </td>
                            <td style="text-align: left;">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align: left;">
                                {{$dato['p_revisor']}} <br><br><br>   
                            </td>
                            <td style="text-align: left;">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </td>
                            <td style="text-align: left;">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align: left;">
                                {{$dato['s_revisor']}} <br><br><br>   
                            </td>
                            <td style="text-align: left;">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </td>
                            <td style="text-align: left;">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align: left;">
                                {{$dato['t_revisor']}} <br><br><br>   
                            </td>
                            <td style="text-align: left;">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </td>
                            <td style="text-align: left;">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </td>
                        </tr>

                  

                </tbody>
            </table>
            <div class="texto-derecha">
                <p><b>*MARCAR CON UNA X<b></p>
            </div>
            <p class="texto-jutif">Agradezco la atención al presente y aprovecho para enviar un
                afectuoso saludo.</p>
            </p>
            <br>
            <br>
            <div class="texto-centro">
                <p class="tam">A T E N T A M E N T E
                <p class="tam">Excelencia en Educación Tecnológica®
                <P class="tam"> <small>“Técnica, Progreso de México”®</small></p>
                </p>
                </p>
            </div>
            <br>
            <br>
            <div class="texto-centro">
                <p class="tam">{{ $dato['jef_proy_doc'] }}
                <p class="tam">JEFE DE PROYECTO DOCENCIA
                </p>
                </p>
            </div>
            <br>
            <div class="texto-izquierda">
                <p class="tam3">
                <h6 class="tam3"> C.c.p. {{ $dato['ccp'] }} <br> C.c.p. {{ $dato['ccp2'] }} <br> AACR/
                    @if ($dato['aacr'] != 0) {{ $dato['aacr'] }}@endif
                </h6>
                </p>

            </div>
        @endforeach
    @endif


    <!------------------------------------------ OFICIO 6------------------------------------------------------>
    @if ($tipo_oficio == 6)
        @foreach ($datos as $dato)
            <div class="texto-derecha">
                <p class="tam">Morelia , Mich., a {{ date_format(new DateTime($fecha), 'd/m/Y') }} </p>
                <p class="tam"><b>OFICIO</b>:{{ $dato['num_oficio'] }}</p>
            </div>
            <div class="texto-derecha">
                <p><u>ASUNTO: Liberación de proyecto para Titulación Integral</u></p>
            </div>
            <br>
            <br>
            <br>
            <br>
            <div class="texto-izquierda">
                <p class="tam">{{ $dato['dirigido'] }}</p>
                <p class="tam"><b>{{ $dato['puesto'] }}</b></p>
            </div>
            <div class="texto-izquierda">
                <p><b>PRESENTE</b></p>
            </div>
            <div class="texto-jutif">
                <p>Por este medio, le informo que ha sido liberado el siguiente proyecto para la Titulación Integral:
                </p>
            </div>
            @foreach ($solicitud as $sol)
                <table cellspacing="0">
                    <thead>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: left;">&nbsp;Nombre del Egresado:</td>
                            <td style="text-align: left;">&nbsp;{{ $sol->p_nombre }} {{ $sol->s_nombre }}
                                {{ $sol->a_paterno }}
                                {{ $sol->a_materno }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left;">&nbsp;No. Control:</td>
                            <td style="text-align: left;">&nbsp;{{ $sol->n_control }} </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;">&nbsp;Opción de Titulación</td>
                            <td style="text-align: left;">
                                @foreach ($titulaciones as $tit)
                                    @if ($tit->id == $sol->id_optitulacion)
                                        &nbsp;{{ mb_strtoupper($tit->nombre) }}@endif
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;">&nbsp;Carrera:</td>
                            <td style="text-align: left;">
                                @foreach ($carreras as $carr)
                                    @if ($carr->id == $sol->id_carrera)
                                        &nbsp;{{ mb_strtoupper($carr->nombre) }}@endif
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;">&nbsp;Título del trabajo:</td>
                            <td style="text-align: left;">&nbsp;{{ $sol->n_proyecto }} </td>
                        </tr>
                    </tbody>
                </table>
            @endforeach
            <p class="texto-jutif">Agradezco la atención al presente y aprovecho para enviar un
                afectuoso saludo.</p>
            </p>
            <br>
            <br>
            <div class="texto-centro">
                <p class="tam">A T E N T A M E N T E
                <p class="tam">Excelencia en Educación Tecnológica®
                <P class="tam"> <small>“Técnica, Progreso de México”®</small></p>
                </p>
                </p>
            </div>
            <br>
            <br>
            <br>
            <br>

            <table cellspacing="0">
                <thead>
                </thead>
                <tbody>
                    <tr>
                        <td><br><br><br><br>
                            @foreach ($solicitud as $sol)
                            @foreach ($profesores as $prof)
                                    @if ($prof->id == $sol->id_asesor)
                                        {{ mb_strtoupper($prof->p_nombre) }}
                                        {{ mb_strtoupper($prof->s_nombre) }}
                                        {{ mb_strtoupper($prof->a_paterno) }}
                                        {{ mb_strtoupper($prof->a_materno) }}
                        @endif
                        @endforeach
                        @endforeach</td>
                        <td><br><br><br><br> {{$dato['p_revisor']}}</td>
                        <td><br><br><br><br>{{$dato['s_revisor']}}</td>
                        <td><br><br><br><br>{{$dato['t_revisor']}}</td>
                        
                        
                    </tr>

                    <tr>
                        <td>PRESIDENTE Y ASESOR</td>
                        <td>SECRETARIO </td>
                        <td>VOCAL PROPIETARIO</td>
                        <td>VOCAL SUPLENTE</td>
                        
                        
                    </tr>
                    
                    
                </tbody>
            </table>        
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="texto-izquierda">
                <p class="tam3">
                <h6 class="tam3"> C.c.p. {{ $dato['ccp'] }} <br> C.c.p. {{ $dato['ccp2'] }} <br> AACR/
                  
                </h6>
                </p>
            </div>
        @endforeach
    @endif

    <!------------------------------------------ OFICIO 7------------------------------------------------------>
    @if ($tipo_oficio == 7)
        @foreach ($datos as $dato)
            <div class="texto-derecha ">
                <p class="tam">Morelia , Mich., a {{ date_format(new DateTime($fecha), 'd/m/Y') }} </p>
                <p class="tam"><b>DEPENDENCIA</b>:{{ $dato['dependencia'] }}</p>
                <p class="tam"><b>SECCIÓN</b>:{{ $dato['seccion'] }}</p>
                <p class="tam"><b>OFICIO</b>:{{ $dato['num_oficio'] }}</p>
            </div>
            <div class="texto-derecha">
                <p><u>ASUNTO: Dictamen de solicitud de titulación.<u></p>
            </div>
            <br>
            <br>
            <br>
            <br>
            <div class="texto-izquierda">
                <p class="tam">{{ $dato['dirigido'] }}</p>
                <p class="tam"><b>{{ $dato['puesto'] }}</b></p>
            </div>
            <div class="texto-izquierda">
                <p><b>PRESENTE</b></p>
            </div>
            <div class="texto-jutif">
                @foreach ($solicitud as $sol)
                    <p>Por este medio le informo que el proyecto del alumno {{ mb_strtoupper($sol->p_nombre) }}
                        {{ mb_strtoupper($sol->s_nombre) }} {{ mb_strtoupper($sol->a_paterno) }}
                        {{ mb_strtoupper($sol->a_materno) }}, con número
                        de control {{ $sol->n_control }} de la carrera de @foreach ($carreras as $carr)
                            @if ($carr->id == $sol->id_carrera)
                                {{ mb_strtoupper($carr->nombre) }}@endif
                        @endforeach,
                        denominado “{{ mb_strtoupper($sol->n_proyecto) }}”,
                        ha sido RECHAZADO como tema para la TITULACIÓN bajo la opción: TITULACIÓN
                        INTEGRAL POR @foreach ($titulaciones as $tit)
                            @if ($tit->id == $sol->id_optitulacion)
                                {{ mb_strtoupper($tit->nombre) }}@endif
                        @endforeach, en virtud que no reúne los requisitos mínimos para ser
                        considerado como un trabajo de titulación.
                    <p class="texto-jutif">Agradezco la atención al presente y aprovecho para enviar un
                        afectuoso saludo.</p>
                    </p>
                @endforeach
            </div>
            <br>
            <br>
            <br>
            <br>
            <div class="texto-centro">
                <p class="tam">A T E N T A M E N T E
                <p class="tam">Excelencia en Educación Tecnológica®
                <P class="tam"> <small>“Técnica, Progreso de México”®</small></p>
                </p>
                </p>
            </div>
            <br>
            <br>
            <br>
            <br>
            <div class="estilo123 texto-centro">
                <p class="tam2">{{ mb_strtoupper($dato['genero']) }}
                <p class="tam2">{{ $dato['departamento'] }}</p>
                </p>

            </div>
            <div class="estilo123 texto-centro">
                <p class="tam2">{{ $dato['n_presid_academia'] }}
                <p class="tam2">{{ $dato['n_area'] }}</p>
                </p>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="texto-izquierda">
                <p class="tam3">
                <h6 class="tam3"> C.c.p. {{ $dato['ccp'] }} <br> C.c.p. {{ $dato['ccp2'] }} <br> AACR/
                    @if (!empty($dato['aarc']) and $dato['aarc'] != 0) {{ $dato['aacr'] }}@endif
                </h6>
                </p>

            </div>
        @endforeach
    @endif


    <!------------------------------------------ OFICIO 8------------------------------------------------------>
    @if ($tipo_oficio == 8)
        @foreach ($datos as $dato)
            <div class="texto-derecha ">
                <p class="tam">Morelia , Mich., a {{ date_format(new DateTime($fecha), 'd/m/Y') }} </p>
                <p class="tam"><b>DEPENDENCIA</b>:{{ $dato['dependencia'] }}</p>
                <p class="tam"><b>SECCIÓN</b>:{{ $dato['seccion'] }}</p>
                <p class="tam"><b>OFICIO</b>:{{ $dato['num_oficio'] }}</p>
            </div>
            <div class="texto-derecha">
                <p><u>ASUNTO: Asignación de sinodales.<u></p>
            </div>
            <br>
            <br>
            <br>
            <br>
            <div class="texto-izquierda">
                <p class="tam">{{ $dato['dirigido'] }}</p>
                <p class="tam"><b>{{ $dato['puesto'] }}</b></p>
            </div>
            <div class="texto-izquierda">
                <p><b>PRESENTE</b></p>
            </div>
            <div class="texto-jutif">
                @foreach ($solicitud as $sol)
                    <p>A través del presente le informo a usted que el (la) {{ mb_strtoupper($sol->p_nombre) }}
                        {{ mb_strtoupper($sol->s_nombre) }} {{ mb_strtoupper($sol->a_paterno) }}
                        {{ mb_strtoupper($sol->a_materno) }},pasante de la carrera de
                        @foreach ($carreras as $carr)
                            @if ($carr->id == $sol->id_carrera)
                                {{ mb_strtoupper($carr->nombre) }}@endif
                        @endforeach y con número
                        de control {{ $sol->n_control }},registró la OPCIÓN de TITULACIÓN INTEGRAL POR
                        @foreach ($titulaciones as $tit)
                            @if ($tit->id == $sol->id_optitulacion)
                                {{ mb_strtoupper($tit->nombre) }}@endif
                        @endforeach @if ($sol->id_optitulacion !=4)
                        con el proyecto “{{ mb_strtoupper($sol->n_proyecto) }}”   
                        @endif 
                        ,y se ha llegado a la siguiente conclusión: AUTORIZACIÓN DE LA OPCIÓN DE TITULACIÓN y
                        se le informa que la asignación de sinodales queda integrada de la siguiente manera:
                        <br>
                        <br>
                        <br>
                        
                            <p >
                                <b>PRESIDENTE Y ASESOR:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ mb_strtoupper($dato['presidente'] ) }} <br>
                                <b>SECRETARIO:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ mb_strtoupper($dato['secretario'] ) }}<br>
                                <b>VOCAL PROPIETARIO:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ mb_strtoupper($dato['vocal'] ) }}<br>
                                <b>SUPLENTE:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ mb_strtoupper($dato['vocal_suplente'] ) }}<br>
                               
                            </p>
                    


                    <p class="texto-jutif">Agradezco la atención al presente y aprovecho para enviar un
                        afectuoso saludo.</p>
                    </p>
                @endforeach
            </div>
            <br>
            <br>
            <br>
            <br>
            <div class="texto-centro">
                <p class="tam">A T E N T A M E N T E
                <p class="tam">Excelencia en Educación Tecnológica®
                <P class="tam"> <small>“Técnica, Progreso de México”®</small></p>
                </p>
                </p>
            </div>
            <br>
            <br>
            <br>
            <br>
            <div class=" texto-centro">
                <p class="tam2">{{ mb_strtoupper($dato['genero']) }}
                <p class="tam2">{{ $dato['departamento'] }}</p>
                </p>

            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="texto-izquierda">
                <p class="tam3">
                <h6 class="tam3"> C.c.p. {{ $dato['ccp'] }} <br> C.c.p. {{ $dato['ccp2'] }} <br> AACR/
                    @if (!empty($dato['aarc']) and $dato['aarc'] != 0) {{ $dato['aacr'] }}@endif
                </h6>
                </p>

            </div>
        @endforeach
    @endif

    <!------------------------------------------ OFICIO 10------------------------------------------------------>
    @if ($tipo_oficio == 10)
        @foreach ($datos as $dato)
            <div class="texto-derecha">
                <p class="tam">Morelia , Mich., a {{ date_format(new DateTime($fecha), 'd/m/Y') }} </p>
                <p class="tam"><b>DEPENDENCIA</b>:{{ $dato['dependencia'] }}</p>
                <p class="tam"><b>SECCIÓN</b>:{{ $dato['seccion'] }}</p>
                <p class="tam"><b>OFICIO</b>:{{ $dato['num_oficio'] }}</p>
            </div>
            <div class="texto-derecha">
                <p><u>ASUNTO: Autorización de Impresión Definitiva</u></p>
            </div>
            <br>
            <br>
            <br>
            <br>
            <div class="texto-izquierda">
                <p class="tam">{{ $dato['dirigido'] }}</p>
                <p class="tam"><b>{{ $dato['puesto'] }}</b></p>
            </div>
            <div class="texto-izquierda">
                <p><b>PRESENTE</b></p>
            </div>
            <div class="texto-jutif">
                <p>Los que suscriben, integrantes del Jurado de Examen Recepcional del egresado (a) cuyos datos se
                    especifican a continuación:
                </p>
            </div>
            @foreach ($solicitud as $sol)
                <table cellspacing="0">
                    <thead>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: left;">&nbsp;Nombre del Egresado:</td>
                            <td style="text-align: left;">&nbsp;{{ $sol->p_nombre }} {{ $sol->s_nombre }}
                                {{ $sol->a_paterno }}
                                {{ $sol->a_materno }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left;">&nbsp;No. Control:</td>
                            <td style="text-align: left;">&nbsp;{{ $sol->n_control }} </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;">&nbsp;Opción de Titulación</td>
                            <td style="text-align: left;">
                                @foreach ($titulaciones as $tit)
                                    @if ($tit->id == $sol->id_optitulacion)
                                        &nbsp;{{ mb_strtoupper($tit->nombre) }}@endif
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;">&nbsp;Carrera:</td>
                            <td style="text-align: left;">
                                @foreach ($carreras as $carr)
                                    @if ($carr->id == $sol->id_carrera)
                                        &nbsp;{{ mb_strtoupper($carr->nombre) }}@endif
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;">&nbsp;Titulo final del trabajo de titulación:</td>
                            <td style="text-align: left;">&nbsp;{{ $sol->n_proyecto }} </td>
                        </tr>
                    </tbody>
                </table>
            @endforeach
            <p class="texto-jutif">Hacemos constar que hemos revisando su informe técnico y tenemos a bien comunicarle
                nuestra autorización para la liberación del mismo y su impresión definitiva.</p>
            </p>
            <br>
            <br>
            <div class="texto-centro">
                <p class="tam">A T E N T A M E N T E
                <p class="tam">Excelencia en Educación Tecnológica®
                <P class="tam"> <small>“Técnica, Progreso de México”®</small></p>
                </p>
                </p>
            </div>
            <br>
            <br>
            <br>
            <br>
            @foreach ($sinodales as $rev)
            @foreach ($profesores as $prof)
                @if ($prof->id == $rev->id_profesor )
                @if ($rev->id_tipo == 1 or $rev->id_tipo == 2)
                <div class="estilo123  texto-centro">
                    <p class="tam2">@if ($rev->id_tipo == 1)<b>PRESIDENTE Y ASESOR:</b>@endif
                        @if ($rev->id_tipo == 2) <b>SECRETARIO:</b>@endif
                        @if ($rev->id_tipo == 3) <b>VOCAL PROPIETARIO:</b> @endif
                        @if ($rev->id_tipo == 4)<b> SUPLENTE:</b>@endif
                    <p class="tam2"><b>{{ mb_strtoupper($prof->p_nombre) }}
                        {{ mb_strtoupper($prof->s_nombre) }}
                        {{ mb_strtoupper($prof->a_paterno) }}
                        {{ mb_strtoupper($prof->a_materno) }}</b></p>
                    </p>
                </div>
                    
                @endif
               
                
                @endif
            @endforeach
            @endforeach
            <br>
            <br>
            <br>
            <br>
            <br>
            @foreach ($sinodales as $rev)
            @foreach ($profesores as $prof)
                @if ($prof->id == $rev->id_profesor )
                @if ($rev->id_tipo == 3 or $rev->id_tipo == 4)
                <div class="estilo123  texto-centro">
                    <p class="tam2">@if ($rev->id_tipo == 1)<b>PRESIDENTE Y ASESOR:</b>@endif
                        @if ($rev->id_tipo == 2) <b>SECRETARIO:</b>@endif
                        @if ($rev->id_tipo == 3) <b>VOCAL PROPIETARIO:</b> @endif
                        @if ($rev->id_tipo == 4)<b> SUPLENTE:</b>@endif
                    <p class="tam2"><b>{{ mb_strtoupper($prof->p_nombre) }}
                        {{ mb_strtoupper($prof->s_nombre) }}
                        {{ mb_strtoupper($prof->a_paterno) }}
                        {{ mb_strtoupper($prof->a_materno) }}</b></p>
                    </p>
                </div>
                    
                @endif
               
                
                @endif
            @endforeach
            @endforeach 
            <br>
            <br>
            <br>
            <br>
            <br>  
            
            <div class="texto-izquierda">
                <p class="tam3">
                <h6 class="tam3"> C.c.p. {{ $dato['ccp'] }} <br> C.c.p. {{ $dato['ccp2'] }} <br> AACR/
                    @if (!empty($dato['aarc']) and $dato['aarc'] != 0) {{ $dato['aacr'] }}@endif
                </h6>
                </p>

            </div>
        @endforeach
    @endif







</body>

</html>
