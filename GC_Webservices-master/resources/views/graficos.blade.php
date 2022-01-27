@extends("layouts.principal")

@section("content")


    <!-- codigo para la parte superior del fondo de la imagen en todas las vistas -->

    <header class="fondo" style="max-height: 100px;">
        <div class="container">
            <div class="intro-text">
            </div>
        </div>
    </header>
    <!-- codigo para seleccionar el graficon de cada cliente por el id -->
    @if($cliente->id_tipo_cliente==1)
        <nav aria-label="breadcrumb" style="margin:1%; margin-right:70%;">
            <ol class="breadcrumb" style="background-color: white" >
                <li class="breadcrumb-item"><a href="/estudiantes">Estudiante</a></li>
                <li class="breadcrumb-item active" aria-current="page">Graficos</li>
            </ol>

        </nav>
    @endif

    @if($cliente->id_tipo_cliente==2)
        <nav aria-label="breadcrumb" style="margin:1%; margin-right:70%;">
            <ol class="breadcrumb" style="background-color: white" >
                <li class="breadcrumb-item"><a href="/docentes">Docente</a></li>
                <li class="breadcrumb-item active" aria-current="page">Graficos</li>
            </ol>

        </nav>

    @endif

    @if($cliente->id_tipo_cliente==3 )
        <nav aria-label="breadcrumb" style="margin:1%; margin-right:70%;">
            <ol class="breadcrumb" style="background-color: white" >
                <li class="breadcrumb-item"><a href="/particulares">Particular</a></li>
                <li class="breadcrumb-item active" aria-current="page">Graficos</li>
            </ol>

        </nav>

    @endif
    <div class="container-xl clearfix px-2 mt-4">

        <div  class="perfil col-md-1 col-md-2 col-12  card float-md-left mr-5 pr-md-8   mt-lg-3 pr-xl-6 ml-lg-4">
      <div class="card-header" style="background: #bafa98;margin-left: -7%;margin-right: -7%;text-align: center" >
          @if($cliente->id_tipo_cliente==1)
              <h7 style="margin-left: 1%">Expediente Estudiante</h7>
          @endif
          @if($cliente->id_tipo_cliente==3 )

              <h7 style="margin-left: 1%">Expediente Particular</h7>
          @endif
          @if($cliente->id_tipo_cliente==2)
              <h7 style="margin-left: 1%">Expediente Docente</h7>
          @endif


   </div>
            <!-- Codigo para ver la imagen en cada grafico -->
            <img  src="/clientes_imagenes/{{$cliente->imagen}}" width="250px" height="260px"
                 style="margin-left: -7%">

            <div class="card " style=" border: none;" >

                <div style="margin-top: 10%" >
                    <h5 > {{$cliente->nombre}}</h5>
                    <h6 style="all: revert;">Graficos</h6>
                </div>

            </div>
            </div>

            <div class="card"
                 style="width: 170px; border: none">
                <div  style="background: transparent;">

                </div>

    </div>
        <!-- codigo para diferenciar los pagos en la barra del menu -->
    <div class="btn-group mt-3 mb-5 " role="group" aria-label="Button group with nested dropdown" >

        @if($cliente->id_tipo_cliente==3||$cliente->id_tipo_cliente==1)

            <a class="btn btn-secondary btn-sm" @if($cliente->id_tipo_cliente==3)
            href="{{route("pagoparticulares",["id"=>$cliente->id])}}"
               @endif
               @if($cliente->id_tipo_cliente ==1)
               href="{{route("pagoestudiantes",["id"=>$cliente->id])}}" @endif

               @if($cliente->id_tipo_cliente ==2)
               style="display: none;"

                    @endif>Pagos</a>



        @endif
        <!-- barra del menu en expediente -->
        <a class="btn btn-secondary btn-sm" href="{{route("imc.ini",[$cliente->id])}}">Medidas Antropométricas</a>
        <a class="btn btn-secondary btn-sm" href="{{route("grasa.uni",["id"=>$cliente->id])}}">Grasa Corporal</a>
        <a class="btn btn-secondary btn-sm" href="{{route("ruffier.uni",["id"=>$cliente->id])}}">Ruffier</a>
        <a class="btn btn-primary btn-sm" href="{{route("grafico.mostrar",["id"=>$cliente->id])}}">Gráfico</a>

    </div>
        <!-- codigo de los graficos -->
        <div class="w3-container " style=" margin-left: 25%;
         margin-right: 5%">
            {!! $chart->container() !!}


            {!! $chart->script() !!}
        </div>

    </div>


    <style>

        @media (min-width: 768px) {
            .perfil {
                float: left !important;
            }

            @media (min-width: 768px) {
                .perfil {
                    width: 66.66667%;
                }
            }
            .perfil{
                position: -webkit-sticky; /* Safari */
                position: sticky;
                overflow-y: hidden;
                overflow-x: hidden;
                top: 10%;
            }
        }

    </style>

@endsection