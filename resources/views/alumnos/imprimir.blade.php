<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Orden de Servicio</title>
    <style type="text/css">
        #container{width:100%;}
        #left{float:left;width:auto;}
        #right{float:right;width:auto;}
        #center{margin:0 auto;width:400px;}
    </style>
    <style>
        table, td {
            border:1px solid black;
        }
        table {
            border-collapse:collapse;
            width:100%;
        }
        td {
            padding:2px;
            font-size: 10pt;
            text-align:center;
        }
        th{
          
          font-size: 10pt;
          
      }
  </style>

</head>

<body>
    @foreach ($alumno as $alum)
    <div class="col-lg-12">        
        <h5 style="text-align: center">SOLICITUD DE REGISTRO DE OPCIÓN DE TITULACIÓN INTEGRAL</h5>
        <p style="text-align: center">Intituto Tecnologico de Morelia</p>
        <div id="container">
            <div id="left" style="">
                <p>Fecha: {{$date}}</p>
                <p>#Control:  {{$alum->n_control}}</p>
                @foreach ($planes as $pl)
                @if ($alum->plan == $pl->id)
                <p>Plan: {{$pl->nombre}}</p>
                @endif
                @endforeach                
            </div>
            <div id="center">             
            </div>
            <div id="right">
                <img class="img-thumbnail img-circle " width="100" height="100" src="{{asset('/res/imagen/default.png') }}">
            </div>  
        </div>
        <div align="center">            
        </div>
        <br><br>
        <br><br>
        <div class="col-lg-12 col-md-12 col-sm-12"><br><br></div>
        <div style="background-color: #688a7e; height: 16px"></div>
        <div style="background-color: #688a7e; height: 16px">
            <h5 class="">DATOS GENERALES</h5>
        </div>
        <div style="text-align:center;">
            <table>
                <thead>
                    <tr>
                        <th>Nombre (s)</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                    </tr>
                </thead>
                <tbody>
                   
                   <tr>
                    <td>{{$alum->p_nombre}}  {{$alum->s_nombre}}</td>
                    <td>{{$alum->a_paterno}}</td>
                    <td>{{$alum->a_materno}}</td>   
                </tr>
                
            </tbody>
        </table>
    </div>
    <div style="background-color: #688a7e; height: 16px">
        <h5 class="">DATOS DE CONTACTO</h5>
    </div>
    <div style="text-align:center;">
        <table>
            <thead>
              
                <tr>
                    <th>Municipio</th>
                    <th>CP</th>
                    <th>Entidad</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$alum->municipio}}</td>
                    <td>{{$alum->cp}}</td>
                    <td>{{$alum->entidad_f}}</td>
                    <td></td>   
                </tr>
                <tr>
                    <th>Correo</th>
                    <th>Segundo Correo</th>
                    <th>Telefono</th>
                    <th>Celular</th> 
                </tr>
                <tr>
                    <td>{{$alum->p_correo}}</td>
                    <td>{{$alum->s_correo}}</td>
                    <td>{{$alum->telefono}}</td>
                    <td>{{$alum->celular}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div style="background-color: #688a7e; height: 16px">
        <h5 class="">DATOS DE EGRESO</h5>
    </div>
    <div style="text-align:center;">
        <table>
            <thead>
                <tr>
                    <th>Numero de Control</th>
                    <th>Carrera</th>
                    <th>Plan de estudios</th>
                    <th>Opcion de titulacion</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$alum->n_control}}</td>
                    @foreach ($carreras as $carr)
                    @if ($alum->id_carrera== $carr->id)
                    <td>{{$carr->nombre}}</td>  
                    @endif    
                    @endforeach
                    
                    @foreach ($planes as $pl)
                    @if ($alum->id_plan == $pl->id)
                    <td>{{$pl->nombre}}</td>
                    @endif
                    @endforeach
                    @foreach ($op_titulaciones as $op_t)
                    @if ($alum->id_optitulacion == $op_t->id)
                    <td>{{$op_t->nombre}}</td>
                    @endif
                    @endforeach 
                </tr>
               
                <tr>
                    @if ($alum->asesor != 0)
                    <th>Asesor</th>
                    <th>Nombre del proyecto</th>
                    @else
                    <th></th>
                    <th></th>
                    @endif
                    <th>Ingreso</th>
                    <th>Egreso</th>
                </tr>
                <tr>
                    @if ($alum->asesor != 0)
                    @foreach ($profesores as $rev)
                    @if ($rev->id==$alum->asesor)
                    <td>{{$rev->p_nombre}}</td>
                    @endif
                    @endforeach
                    <td>{{$alum->n_proyecto}}</td>
                    @else
                    <td></td>
                    <td></td>
                    @endif
                    <td>{{$alum->f_ingreso}}</td>
                    <td>{{$alum->f_egreso}}</td>
                </tr>
                
            </tbody>
        </table>
    </div>
</div>
@if (!empty($sinodales))
<div style="background-color: #688a7e; height: 16px">
    <h5 class="">PROPUESTA DE SINODALES</h5>
</div>
<div style="text-align:center;">
    <table>
        <thead>
            <tr>
                <th>Presidente</th>
                <th>Secretario</th>
                <th>Vocal</th>
                <th>Suplente</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($sinodales as $sin)
                @foreach ($profesores as $prof)
                @if($sin->id_profesor==$prof->id)
                <td>{{$prof->p_nombre}}</td>
                @endif
                @endforeach
                @endforeach
            </tr>
            
        </tbody>
    </table>
</div>
@endif

@endforeach 
</div>

</body>
</html>