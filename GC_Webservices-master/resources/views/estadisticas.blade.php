@extends("layouts.principal")

@section("content")
    <!-- Codigo del fondo de la imagen en la parte superior de la imagen  -->
    <header class="fondo" style="max-height: 100px;">
        <div class="container">
        </div>
    </header>





    <div class="w3-container w3-teal mx-5" style="font-family: 'Raleway', sans-serif">
        <h2 class=" mt-3">Listado de todos los clientes</h2>

        <!-- Codigo de la busqueda de los clientes en general -->
        <button class="btn btn-outline-dark mb-3" style="float: right"
                data-toggle="collapse" href="#cardCollapses" data-target="#cardCollapses"><span><i class="fas fa-arrow-down"></i></span></button>

        <form class="form-inline" method="get" action="{{route('cliente.buscarCliente')}}">

            <div class="input-group mb-3 mr-2">

                <input type="text" class="form-control" name="busquedaCliente"
                       id="inputText2" value="{{old("busquedaCliente")}}"
                       required
                       placeholder="Buscar">
                @if(old("busquedaCliente"))
                    <div class="input-group-prepend">
                        <a class="btn btn-danger" onclick="window.location.href='/estadisticas'" style="color:white;"
                           type="button">&times;</a>
                    </div>
                @endif

            </div>
            <button type="submit" class="btn btn-primary mb-3">Buscar</button>
        </form>

        <!-- Codigo de la agrupacion de los clientes segun su estado de peso -->
        <div class="collapse" id="cardCollapses">
            <div class="row" >

                <div class="col-lg-3 col-md-6 col-sm-6 card-efect" style="margin-top: 10px">
                    <div class="card card-style">
                        <div class="card-header">

                            <img src="/images/obeso.svg" width="40px" style="margin-left: 42%">
                            <br>
                            <h6 class="text-center"># Obesidad Tipo III </h6>
                            <h5 class="text-center"><span class="badge badge-dark">{{$obesidadTipoIII->count()}}</span></h5>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3 col-md-6 col-sm-6 card-efect" style="margin-top: 10px">
                    <div class="card card-style">
                        <div class="card-header">

                            <img src="/images/exceso-de-peso.svg" width="40px" style="margin-left: 42%">
                            <br>
                            <h6 class="text-center"># Obesidad Tipo II </h6>
                            <h5 class="text-center"><span class="badge badge-dark">{{$obesidadTipoII->count()}}</span></h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 card-efect" style="margin-top: 10px">
                    <div class="card card-style">
                        <div class="card-header">

                            <img src="/images/obe1.svg" width="40px" style="margin-left: 42%">
                            <br>
                            <h6 class="text-center"># Obesidad Tipo I </h6>
                            <h5 class="text-center"><span class="badge badge-dark">{{$obesidadTipoI->count()}}</span></h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 card-efect" style="margin-top: 10px">
                    <div class="card card-style">
                        <div class="card-header">

                            <img src="/images/fat.svg" width="40px" style="margin-left: 42%">
                            <br>
                            <h6 class="text-center"># Preobesidad </h6>
                            <h5 class="text-center"><span class="badge badge-dark">{{$preobesidad->count()}}</span></h5>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row" style="margin-left: 20%">

                <div class="col-lg-3 col-md-6 col-sm-6 card-efect" style="margin-top: 10px">
                    <div class="card card-style">
                        <div class="card-header">

                            <img src="/images/pesoNormal.svg" width="40px" style="margin-left: 42%">
                            <br>
                            <h6 class="text-center"># Peso Normal </h6>
                            <h5 class="text-center"><span class="badge badge-dark">{{$pesoNormal->count()}}</span></h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 card-efect" style="margin-top: 10px">
                    <div class="card card-style">
                        <div class="card-header">

                            <img src="/images/deladezsevera.svg" width="40px" style="margin-left: 42%">
                            <br>
                            <h6 class="text-center"># Delgadez </h6>
                            <h5 class="text-center"><span class="badge badge-dark">{{$delgadez->count()}}</span></h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 card-efect" style="margin-top: 10px">
                    <div class="card card-style">
                        <div class="card-header">

                            <img src="/images/delgado.svg" width="40px" style="margin-left: 42%">
                            <br>
                            <h6 class="text-center"># Delgadez severa </h6>
                            <h5 class="text-center"><span class="badge badge-dark">{{$delgadezSevera->count()}}</span></h5>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Codigo de la creacion de la tabla de los clientes en general -->
        <div class="table-responsive mt-4" style="-moz-box-shadow: 0px 5px 3px 3px rgba(194,194,194,1);
box-shadow: 0px 5px 3px 3px rgba(194,194,194,1);">
            <table class="table ruler-vertical table-hover mx-sm-0 ">
                <thead class="thead-dark">
                <tr>
                    <th>N°</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Identificación</th>
                    <th scope="col">Edad</th>
                    <th scope="col">Carrera o Profesión u Oficio</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Tipo de Cliente</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Acciones</th>
                </tr>
                </thead>

                <tbody>
                @if($clientes->count()>0)
                    @foreach($clientes as $estudiante)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$estudiante->nombre}}</td>
                            <td>{{$estudiante->identificacion}}</td>
                            <td>{{$estudiante->edad}}</td>
                            @if($estudiante->id_tipo_cliente ==1)
                                <td>{{$estudiante->carrera }}</td>
                            @else
                                <td>{{$estudiante->profesion_u_oficio}}</td>
                            @endif

                            @if($estudiante->telefono == null)
                                <td style="text-align: center"> ----</td>
                            @else
                                <td>{{$estudiante->telefono}}</td>
                            @endif

                            <td>{{$estudiante->descripcion}}</td>
                            <td>{{date("Y-m-d",strtotime($estudiante->created_at))}}</td>
                            <td>
                                <a class="btn  btn-outline-info  mr-xl-2 "
                                   href="{{route("grafico.mostrar",["id"=>$estudiante->id])}}">


                                    Ver Estadística
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8" style="text-align: center">No hay clientes ingresados</td>
                @endif
                </tbody>
            </table>

        </div>
    </div>

@endsection
