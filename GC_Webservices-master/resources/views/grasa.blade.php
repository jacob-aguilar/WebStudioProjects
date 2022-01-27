@extends("layouts.principal")

@section("content")
    <!-- Header -->
    <header class="fondo" style="max-height: 100px;">
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">Estudiantes</div>
            </div>
        </div>
    </header>
    @if($nombre->id_tipo_cliente==1)
        <nav aria-label="breadcrumb" style="margin:1%; margin-right:70%;">
            <ol class="breadcrumb" style="background-color: white" >
                <li class="breadcrumb-item"><a href="/estudiantes">Estudiante</a></li>
                <li class="breadcrumb-item active" aria-current="page">Grasa Corporal</li>
            </ol>

        </nav>
    @endif

    @if($nombre->id_tipo_cliente==2)
        <nav aria-label="breadcrumb" style="margin:1%; margin-right:70%;">
            <ol class="breadcrumb" style="background-color: white" >
                <li class="breadcrumb-item"><a href="/docentes">Docente</a></li>
                <li class="breadcrumb-item active" aria-current="page">Grasa Corporal</li>
            </ol>

        </nav>

    @endif

    @if($nombre->id_tipo_cliente==3 )
        <nav aria-label="breadcrumb" style="margin:1%; margin-right:70%;">
            <ol class="breadcrumb" style="background-color: white" >
                <li class="breadcrumb-item"><a href="/particulares">Particular</a></li>
                <li class="breadcrumb-item active" aria-current="page">Grasa Corporal</li>
            </ol>

        </nav>

    @endif



    <div class="container-xl clearfix px-2 mt-4">

        <div  class="perfil col-md-1 col-md-2 col-12 card  float-md-left mr-5  mt-lg-3 pr-xl-6 ml-lg-4">

            <div class="card-header" style="background-color: #f27961;margin-left: -7%;margin-right: -7%;text-align: center">

                @if($nombre->id_tipo_cliente==1)
                    <h7 style="margin-left: 1%">Expediente Estudiante</h7>
                @endif
                @if($nombre->id_tipo_cliente==3 )

                    <h7 style="margin-left: 1%">Expediente Particular</h7>
                @endif
                @if($nombre->id_tipo_cliente==2)
                    <h7 style="margin-left: 1%">Expediente Docente</h7>
                @endif
            </div>

        <img src="/clientes_imagenes/{{$nombre->imagen}}" width="250px" height="260px" style="margin-left: -7%"  >

        <div class="card margencard" style=" border: none;" >

            <div >
                <h5 style="margin-top: 10%">{{$nombre->nombre}}</h5>
            <h6 style="all: revert">Grasa Corporal</h6>
                <div style="max-height: 250px;">{!! $chart->container() !!}</div>


        </div>
    </div>

            <div class="card"
                 style="width: 170px; border: none">
                <div  style="background: transparent;">

                </div>
            </div>
        </div>
            <a class="btn btn-primary btn-sm mt-sm-3" href="{{route("botongrasa",["id"=>$nombre->id])}}"
               style="float: right; margin-right: 50px;color: white">Nuevo

            </a>
    <div class="btn-group mt-3 mb-5" style="margin-left: .1%;" role="group"
         aria-label="Button group with nested dropdown">
        @if($nombre->id_tipo_cliente==3||$nombre->id_tipo_cliente==1)

            <a class="btn btn-secondary btn-sm" @if($nombre->id_tipo_cliente==3)
            href="{{route("pagoparticulares",["id"=>$nombre->id])}}"
           @endif
           @if($nombre->id_tipo_cliente ==1)
           href="{{route("pagoestudiantes",["id"=>$nombre->id])}}" @endif

           @if($nombre->id_tipo_cliente ==2)
           style="display: none;"
                @endif >Pagos</a>
        @endif


        <a class="btn btn-secondary btn-sm" href="{{route("imc.ini",[$nombre->id])}}">Medidas Antropometricas</a>
        <a class="btn btn-primary btn-sm" href="{{route("grasa.uni",["id"=>$nombre->id])}}">Grasa Corporal</a>
        <a class="btn btn-secondary btn-sm" href="{{route("ruffier.uni",["id"=>$nombre->id])}}">Ruffier</a>
            <a class="btn btn-secondary btn-sm" href="{{route("grafico.mostrar",["id"=>$nombre->id])}}">Grafico</a>

    </div>


    <div class="w3-container w3-teal mx-5">

        <div class="card" style="-moz-box-shadow: 0px 5px 3px 3px rgba(194,194,194,1);
box-shadow: 0px 5px 3px 3px rgba(194,194,194,1);border: none">

            @if($exito)
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{$exito }}
                </div>

            @endif
            @if($error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" id="crearNuevo" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ $error }}
                </div>

            @endif

            <div class="table-responsive-lg" style="font-size: 12px" >
                <table class="table table-hover">

                    <thead class="thead-dark">
                    <tr >
                        <th scope="col">N°</th>

                        <th scope="col">Fecha</th>
                        <th scope="col">Clasificacion</th>
                        <th scope="col">PC Tricipital</th>
                        <th scope="col">PC Infraescapular</th>
                        <th scope="col">PC Supra Ilíaco</th>
                        <th scope="col">PC Biciptal</th>
                        <th scope="col">Porcentaje</th>


                        <th scope="col">Acciones</th>

                    </tr>
                    </thead>

                    <tbody>

                        @if($grasa_corporal->count()>0)
                            @foreach($grasa_corporal as $grasa)
                                <tr style="text-align:right">
                                    <td>{{$no++}}</td>
                                    <th>{{date("d-m-Y",strtotime($grasa->created_at))}}</th>


                                    <td  if(genero==="M"){ @if($grasa->grasa>=26)
                                        style="color: red"
                                        @elseif($grasa->grasa>=18&& $grasa->grasa<=25)
                                        style="color: blue"
                                        @elseif($grasa->grasa<=14&& $grasa->grasa>=2)
                                        style="color: green;"
                                        @endif }
                                         else {

                                         @if($grasa->grasa>=32)
                                         style="color: red"
                                         @elseif($grasa->grasa>=21&& $grasa->grasa<=31)
                                         style="color: blue"
                                         @elseif($grasa->grasa<=20&& $grasa->grasa>=10)
                                         style="color: green;"
                                         @endif

                                         }style="text-align: center">{{$grasa->diagnostico}}</td>


                                <td>{{$grasa->pc_tricipital}}</td>
                                <td>{{$grasa->pc_infraescapular}}</td>
                                <td>{{$grasa->pc_supra_iliaco}}</td>
                                <td>{{$grasa->pc_biciptal}}</td>

                                    <td>{{$grasa->grasa}}</td>


                                <td class="row">

                                    <a class="btn btn-outline-warning btn-sm" style="margin-right: 5px "
                                            href="{{route('grasa.editar',["id_grasa"=>$grasa->id,"id_cliente"=>$grasa->id_cliente])}}"><i
                                                class="fas fa-edit" ></i>


                                    </a>

                                        <button class="btn btn-outline-danger btn-sm"
                                                data-id="{{$grasa->id}}"
                                                data-id_cliente="{{$grasa->id_cliente}}"
                                        data-toggle="modal" data-target="#modalBorrarGrasa"><i
                                                    class="fas fa-trash-alt"></i></button>
                                    
                                </td>



                    </tr>

                    @endforeach
                    @else
                        <tr>

                            <td colspan="14" style="text-align: center">No hay medidas ingresadas</td>
                    @endif

                    </tbody>
                </table>


                @if($grasa_corporal->count()>10)
                    <div class="panel">
                        {{ $grasa_corporal->links() }}
                    </div>
                @endif
            </div>
            </div>


        </div>
        <div class="container" style="margin: 280px; height: 8%; width: 35%">

        </div>
    </div>



    {!! $chart->script() !!}
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalBorrarGrasa">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Atención Eliminación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route('grasa.borrar')}}">
                    {{method_field('delete')}}

                    <div class="modal-body">
                        <input name="id" id="id" type="hidden">
                        <input name="id_cliente" id="id_cliente" type="hidden">

                        <p>¿Está seguro que desea borrar la medida la grasa?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                    </div>
                </form>
            </div>

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
        }
    </style>


@endsection

