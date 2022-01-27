@extends("layouts.principal")

@section("content")
    <!-- MOSTRAR EL FONDO DE LA IMAGEN EN  LA PARTE SUPERIOR DE CADA VISTA -->

    <header class="fondo" style="max-height: 100px;">
        <div class="container">
        </div>
    </header>
    <!-- COdigo para diferenciar el pago de estudiante, docente y particulares -->
    @if($nombre->id_tipo_cliente==1)
        <nav aria-label="breadcrumb" style="margin:1%; margin-right:70%;">
            <ol class="breadcrumb" style="background-color: white" >
                <li class="breadcrumb-item"><a href="/estudiantes">Estudiante</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pagos</li>
            </ol>

        </nav>
    @endif

    @if($nombre->id_tipo_cliente==2)
        <nav aria-label="breadcrumb" style="margin:1%; margin-right:70%;">
            <ol class="breadcrumb" style="background-color: white" >
                <li class="breadcrumb-item"><a href="/particulares">Docente</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pagos</li>
            </ol>

        </nav>

    @endif

    @if($nombre->id_tipo_cliente==3 )
        <nav aria-label="breadcrumb" style="margin:1%; margin-right:70%;">
            <ol class="breadcrumb" style="background-color: white" >
                <li class="breadcrumb-item"><a href="/particulares">Particular</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pagos</li>
            </ol>

        </nav>

    @endif
    <!-- codigo para diferenciar el id de cada cliente  -->

    <div class="container-xl clearfix px-2 mt-4">
        <div class="perfil col-md-1 col-md-2 col-12 card float-md-left mr-5 pr-md-8  mt-lg-3 pr-xl-6 ml-lg-4">
            <div class="card-header" style="background: #8addff;margin-left: -7%;margin-right: -7%;text-align: center"">
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
        <!--codigo para mostrar la imagen de cada cliente -->

            <img  src="/clientes_imagenes/{{$nombre->imagen}}" width="250px" height="260px" style="margin-left: -7%">
            <div class="card margencard" style=" border: none;" >
                <div >
                    <h5 style="margin-top: 10%"> {{$nombre->nombre}}</h5>
                    @if($nombre->id_tipo_cliente==2)
                        <H6> Expediente Docente</H6>

                    @endif
                    @if($nombre->id_tipo_cliente==1)
                        <H6> Expediente Estudiante</H6>
                    @endif
                    <h6 style="all: revert">Pagos</h6>


                </div>
            </div>
        </div>

            <div class="card"
                 style="width: 170px; border: none">
                <div  style="background: transparent;">

                </div>
    </div>

    <!-- codigo para mostrar el nombre de cada cliente -->

        <div class="btn-group mt-3 mb-5" style="margin-left: .1%;" role="group" aria-label="Button group with nested dropdown">
        <a class="btn btn-primary btn-sm" @if($nombre->id_tipo_cliente!==1)
        href="{{route("pagoparticulares",["id"=>$nombre->id])}}"
           @else
           href="{{route("pagoestudiantes",["id"=>$nombre->id])}}" @endif >Pagos</a>

            <!-- codigo para mostrar el menu -->

            <a class="btn btn-secondary btn-sm" href="{{route("imc.ini",[$nombre->id])}}">Medidas Antropometicas</a>
        <a class="btn btn-secondary btn-sm" href="{{route("grasa.uni",["id"=>$nombre->id])}}">Grasa Corporal</a>
        <a class="btn btn-secondary btn-sm" href="{{route("ruffier.uni",["id"=>$nombre->id])}}">Ruffier</a>
        <a class="btn btn-secondary btn-sm" href="{{route("grafico.mostrar",["id"=>$nombre->id])}}"> Gráfico</a>


    </div>


    <button class="btn btn-primary   float-right mt-sm-3" style="margin-top: -10px; margin-right: 50px"
            data-toggle="modal" data-target="#modalPagoParticular" >Nuevo
    </button>
    <!-- modal para guardar los pagos -->

        <button class="btn btn-outline-dark mb-3" style="float: right; margin-top: 1%;margin-right: 1%;
                     padding-top: -2%;padding-bottom: -8%"
                data-toggle="collapse" href="#cardCollapses" data-target="#cardCollapses">
            <span><i class="fas fa-arrow-down"></i></span></button>

            <div class="modal fade" id="modalPagoParticular" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalScrollableTitle" >
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalScrollableTitle">Agregar Pago</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <form method="post" action="{{route('pagoparticulares.guardar')}}">
                                <h6>Fecha</h6>
                                <div class="form-group">
                                    <input type="date" class="form-control"
                                           id="fecha" name="fecha_pago" required>
                                    <input type="hidden" id="mes" name="mes">
                                </div>
                                <h6>Agregar Nota</h6>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="nota" name="nota"
                                           @isset($user)
                                           value="{{$user->nota}}"
                                            @endisset
                                    >
                                </div>
                                <div class="modal-footer">
                                    <input name="id" value="{{$nombre->id}}" type="hidden">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                                    <button type="submit" class="btn btn-primary ">Guardar</button>

                                </div>
                            </form>

                        </div>

                    </div>
                </div>

            </div>

        <div class="w3-container w3-teal mx-5">
            <div class="collapse" id="cardCollapses">
                <div class="row" >

                    <div class="col-lg-3 col-md-6 col-sm-6 card-efect" style="margin-top: 5px;margin-bottom: 2%;margin-left: -1%">
                        <div class="card card-style">
                            <div class="card-header">
                                <!-- imagen para los pagos ingresado por ese cliente -->
                                <img src="/images/pago.png" width="40px" style="margin-left: 42%">
                                <br>
                                <h6 class="text-center">Total Pagos</h6>
                                <h5 class="text-center"><span class="badge badge-dark">{{$ingresos}}</span></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card" style="-moz-box-shadow: 0px 5px 3px 3px rgba(194,194,194,1);
box-shadow: 0px 5px 3px 3px rgba(194,194,194,1);border: none">


                <div class="table-responsive" >

                    <!-- alerta de exito o error -->

                    @if(session("exito"))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-left: 0%; margin-right: 0%;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                            {{ session('exito') }}
                        </div>

                    @endif

                    @if(session("error"))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin-left: 0%; margin-right: 0%;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>


                            {{ session('error') }}
                        </div>

                    @endif

                    <!-- editar los datos agregados -->
                        <div class="modal fade" id="editarPagoParticular" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalScrollableTitle" >
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalScrollableTitle">Editar Pago Particular</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form method="post" action="{{route('pagoparticulares.update')}}" enctype="multipart/form-data">
                                            <input type="hidden" name="particularpago_id" id="id" value="">

                                            {{method_field('put')}}



                                            <h6>Fecha</h6>
                                            <div class="form-group">
                                                <input type="date" class="form-control" id="fecha_pago" name="fecha_pago"
                                                       @isset($user)
                                                       value="{{$user->fecha_pago}}"
                                                       @endisset value="{{old('fecha_pago')}}"
                                                >
                                                <input type="hidden" id="mes" name="mes">
                                            </div>

                                            <h6>Agregar Nota</h6>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="nota" name="nota"
                                                       @isset($user)
                                                       value="{{$user->nota}}"
                                                       @endisset value="{{old('nota')}}"
                                                >
                                            </div>


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                                                <button type="submit"  class="btn btn-primary">Guardar</button>

                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>


                    <table class="table  table-hover " style="font-size: 14px">
                        <!-- creacion de la tabla -->

                        <thead class="thead-dark">
                        <tr>
                            <th >N°</th>
                            <th>Mes</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Nota</th>
                            <th>Acciones</th>
                        <tr>
                        </thead>
                        <tbody>

            @if($pagos->count()>0)
            @foreach ($pagos as $day => $users_list)
                <tr>
                    <th colspan="6"
                        style="background-color: #85d6f7; color: white;">Registros del año {{ $day }}</th>
                </tr>
                @foreach ($users_list as $user)
                    <tr>
                        <td>{{$no++}}</td>
                        <th>{{ $user->mes }}</th>
                        <th>{{ $user->fecha_pago }}</th>
                        <th>Cancelado</th>
                        @if($user->nota)
                            <th >{{ $user->nota }}</th>
                        @else<th> n/a</th>
                        @endif
                        <th>
                            <button class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#editarPagoParticular" data-myfecha="{{$user->fecha_pago}}"
                                    data-mynota="{{$user->nota}}"  data-catid="{{$user->id}}" ><i class="fas fa-edit"></i></button>

                            <button class="btn btn-outline-danger btn-sm"
                                    data-id="{{$user->id}}"
                                    data-id_cliente="{{$user->id_cliente}}"
                                    data-toggle="modal" data-target="#modalBorrarPagoParticular"><i class="fas fa-trash-alt"></i></button>

                        </th>

                    </tr>
                @endforeach
            @endforeach
            @else
                <tr>
                    <td colspan="6" style="text-align: center">No hay pagos ingresados</td>
            @endif


                        </tbody>
                    </table>

                </div>


            </div>

        </div>
    <!-- Modal para alerta de borrar pagos -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modalBorrarPagoParticular">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Atención Eliminación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route('pagoparticulares.borrar')}}">
                    {{method_field('delete')}}

                    <div class="modal-body">
                        <input name="id" id="id" type="hidden">
                        <input name="id_cliente" id="id_cliente" type="hidden">

                        <p>¿Está seguro que desea borrar el pago?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                    </div>

                </form>
            </div>

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