@extends("layouts.principal")

@section("content")
    <!-- codigo para la parte superior del fondo de la imagen en todas las vistas -->

    <header class=" fondo" style="max-height: 100px;">
        <div class=" container">
            <div class="intro-text">

            </div>
        </div>
    </header>
    <!-- codigo para diferenciar el id de los clientes -->

    @if($cliente->id_tipo_cliente==1)
        <nav aria-label="breadcrumb" style="margin:1%; margin-right:70%;">
            <ol class="breadcrumb" style="background-color: white">
                <li class="breadcrumb-item"><a href="/estudiantes">Estudiante</a></li>
                <li class="breadcrumb-item active" aria-current="page">Medidas Antropométricas</li>
            </ol>

        </nav>
    @endif

    @if($cliente->id_tipo_cliente==2)
        <nav aria-label="breadcrumb" style="margin:1%; margin-right:70%;">
            <ol class="breadcrumb" style="background-color: white">
                <li class="breadcrumb-item"><a href="/docentes">Docente</a></li>
                <li class="breadcrumb-item active" aria-current="page">Medidas Antropométricas</li>
            </ol>

        </nav>

    @endif

    @if($cliente->id_tipo_cliente==3 )
        <nav aria-label="breadcrumb" style="margin:1%; margin-right:70%;">
            <ol class="breadcrumb" style="background-color: white">
                <li class="breadcrumb-item"><a href="/particulares">Particular</a></li>
                <li class="breadcrumb-item active" aria-current="page">Medidas Antropométricas</li>
            </ol>

        </nav>

    @endif

    <div class="container-xl clearfix px-2 mt-4">

        <div id="divPerfil"  class="perfil col-md-1 col-md-2 col-12 card  float-md-left mr-5  mt-lg-3 pr-xl-6 ml-lg-4">

            <div class="card-header" style="background: #8affa5;margin-left: -7%;margin-right: -7%;text-align: center">
                @if($cliente->id_tipo_cliente==1)
                    <h7 style="margin-left: 1% ">Expediente Estudiante</h7>
                @endif
                @if($cliente->id_tipo_cliente==3 )

                    <h7 style="margin-left: 1%">Expediente Particular</h7>
                @endif
                @if($cliente->id_tipo_cliente==2)
                    <h7 style="margin-left: 1%">Expediente Docente</h7>
                @endif
            </div>
            <!-- codigo para ver la imagen en cada vista de la grasa -->

            <img  src="/clientes_imagenes/{{$cliente->imagen}}" width="250px"
                 height="260px" style="margin-left: -7%" >
            <div class="card margencard" style=" border: none;">
                <!-- Codigo para mostrar el nombre de cada cliente -->

                <div >
                    <h5 style="margin-top: 10%"> {{$cliente->nombre}}</h5>
                    <h6 style="all: revert">Medida Antropometrica</h6>
                    <!-- PARA MOSTRAR LA GRAFICA-->

                    <div style="max-height: 250px;">{!! $chart->container() !!}</div>
                </div>
            </div>
        </div>
        <div class="card"
             style="width: 170px; border: none">
            <div style="background: transparent;">

            </div>
        </div>

        <a class="btn btn-primary btn-sm  mt-3 " href="{{route("botonimc",["id"=>$cliente->id])}}"
           style="float: right; margin-right: 50px; color: white">Nuevo
        </a>
        <!-- codigo para difereciar la barra de menu de acuerdo por el id de cada cliente -->

        <div class=" btn-group mt-3 mb-5" style="margin-left: .1%; font-size: 14px" role="group"
             aria-label="Button group with nested dropdown">


            @if($cliente->id_tipo_cliente==3||$cliente->id_tipo_cliente==1)
                <a class="btn btn-secondary btn-sm" @if($cliente->id_tipo_cliente==3)
                href="{{route("pagoparticulares",["id"=>$cliente->id])}}"
                   @endif
                   @if($cliente->id_tipo_cliente ==1)
                   href="{{route("pagoestudiantes",["id"=>$cliente->id])}}" @endif

                   @if($cliente->id_tipo_cliente ==2)
                   style="display: none;"
                        @endif

                >Pagos</a>
            @endif
            <!-- mostrar la barra del menu -->

            <a class="btn btn-primary btn-sm" href="{{route("imc.ini",[$cliente->id])}}">Medidas Antropométricas</a>
            <a class="btn btn-secondary btn-sm" href="{{route("grasa.uni",["id"=>$cliente->id])}}">Grasa Corporal</a>
            <a class="btn btn-secondary btn-sm" href="{{route("ruffier.uni",["id"=>$cliente->id])}}">Ruffier</a>
            <a class="btn btn-secondary btn-sm" href="{{route("grafico.mostrar",["id"=>$cliente->id])}}"> Gráfico</a>


        </div>


        <div class="w3-container w3-teal mx-5">

            <div class="card" style="-moz-box-shadow: 0px 5px 3px 3px rgba(194,194,194,1);
box-shadow: 0px 5px 3px 3px rgba(194,194,194,1);border: none ">
                <!-- Mensaje de confirmacion -->

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

            <!-- CODIGO DE LA CREACCION DE LA TABLA  -->

                <div class=" table-responsive-lg">
                    <table class="table  table-hover" style="font-size: 12px">
                        <thead class="thead-dark">
                        <tr>

                            <th scope="col">N°</th>
                            <th scope="">Fecha</th>
                            <th scope="col">Diagnóstico</th>
                            <th scope="col">Peso Kg</th>
                            <th scope="col">Altura°</th>
                            <th scope="col">Imc</th>
                            <th scope="col">Pecho cm</th>
                            <th scope="col">Brazo cm</th>
                            <th scope="col">ABD A</th>
                            <th scope="col">ABD B</th>
                            <th scope="col">Cadera cm</th>
                            <th scope="col">Muslo cm</th>
                            <th scope="col">Pierna cm</th>
                            <th scope="col">Acciones</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if($antecedentes->count()>0)

                            @foreach($antecedentes as $antecedente)
                                <tr style="text-align:right">
                                    <td>{{$no++}}</td>
                                    <td><strong>{{date("d-m-Y",strtotime($antecedente->created_at))}}</strong></td>
                                    <td @if($antecedente->imc>30)
                                        style="color: red"
                                        @elseif($antecedente->imc>18.49&& $antecedente->imc<29.99)
                                        style="color: green"
                                        @elseif($antecedente->imc<18.48&& $antecedente->imc>16.00)
                                            style="color: blue;"
                                            @endif
                                        >{{$antecedente->diagnostico}}</td>

                                    <td>{{$antecedente->peso}}</td>
                                    <td>{{$antecedente->altura}}</td>
                                    <td>{{$antecedente->imc}}</td>
                                    <td>{{$antecedente->pecho}}</td>
                                    <td>{{$antecedente->brazo}}</td>
                                    <td>{{$antecedente->ABD_A}}</td>
                                    <td>{{$antecedente->ABD_B}}</td>
                                    <td>{{$antecedente->cadera}}</td>
                                    <td>{{$antecedente->muslo}}</td>
                                    <td>{{$antecedente->pierna}}</td>


                                    <td class="row">
                                        <!-- CODIGO DE LA RUTA PARA EDITAR -->


                                        <a class="btn btn-outline-warning btn-sm " style="margin-right: 5px"
                                           href="{{route('imc.editar',[$antecedente->id,$antecedente->id_cliente])}}"><i
                                                    class="fas fa-edit" ></i>

                                        </a>
                                        <!-- CODIGO PARA ELIMINAR -->


                                        <button class="btn btn-outline-danger btn-sm"
                                                data-id="{{$antecedente->id}}"
                                                data-id_cliente="{{$antecedente->id_cliente}}"
                                                data-toggle="modal" data-target="#modalBorrarImc"><i
                                                    class="fas fa-trash-alt"></i></button>


                                    </td>
                                </tr>
                            @endforeach



                        @else
                            <tr>
                                <td colspan="14" style="text-align: center">No hay medidas ingresadas</td>
                            </tr>
                        @endif


                        </tbody>
                    </table>


                    @if($antecedentes->count()>10)
                        <div class="panel">
                            {{ $antecedentes->links() }}
                        </div>
                    @endif


                </div>
            </div>
        </div>
        <div class="container" style="margin: 280px; height: 8%; width: 35%">

        </div>
    </div>
    <!-- CODIGO DE GRAFICOS -->
    {!! $chart->script() !!}
    <!-- CODIGO DE MODAL DE LA ALERTA DE LA ELIMINACION -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modalBorrarImc">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Atención Eliminación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- METODO DE BORRAR -->
                <form method="post" action="{{route('imc.borrar')}}">
                    {{method_field('delete')}}

                    <div class="modal-body">
                        <input name="id" id="id" type="hidden">
                        <input name="id_cliente" id="id_cliente" type="hidden">

                        <p>¿Está seguro que desea borrar la medida de imc?</p>
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

    </style>


@endsection
