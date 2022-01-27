@extends("layouts.principal")

@section("content")
    <!-- codigo para la parte superior del fondo de la imagen en todas las vistas -->
    <header class="fondo" style="max-height: 100px;">
        <div class="container">
            <!--div class="intro-text">
                <div class="intro-lead-in">Estudiantes</div>
            </div-->
        </div>
    </header>



    <div class="w3-container w3-teal mx-5" style="font-family: 'Raleway', sans-serif ">


        <h2 class=" mt-3">Listado de Estudiantes</h2>

        <!-- Codigo para crear una un estudiante -->
        <button type="button" class="btn btn-primary float-right boton1" style="margin-left: 1%" id="crearNuevo" data-toggle="modal"
                data-target="#exampleModalScrollable">
            <i class="fas fa-user-plus"></i>
        </button>

        <button class="btn btn-outline-dark mb-3" style="float: right"
                data-toggle="collapse" href="#cardCollapses" data-target="#cardCollapses">
            <span><i class="fas fa-arrow-down"></i></span></button>
        <!--button type="button"  class="btn btn-warning float-right" data-dismiss="alert"
                data-toggle="modal" data-target="#exampleModalScrollable">

        </button-->

        <!-- Codigo para condicionar si se creo bien o dar un error  -->
        @if(session("errors"))
            <script>
                document.onreadystatechange = function () {

                    if (document.readyState === "complete") {
                        document.getElementById("crearNuevo").click();
                    }
                };

            </script>
        @endif
        @section("script")
        <script>
            $('#imageUpload').change(function() {
                readImgUrlAndPreview(this);

                function readImgUrlAndPreview(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#imagePreview').attr('src', e.target.result);
                        }
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            });

        </script>
        @endsection
    <!-- Function pata limpiar los campos -->
        <script>
            function limpiarDatosModal() {
                document.getElementById("nombre").value = '';
                document.getElementById("fecha_nacimiento").value = '';
                document.getElementById("identificacion").value = '';
                document.getElementById("carrera").value = 1;
                document.getElementById("telefono").value = '';
                document.getElementById("sexo1").checked = false;
                document.getElementById("sexo2").checked = false;
                document.getElementById("previewImagen").src="/images/addphoto.ico";


            }
        </script>


        <div class="modal fade  bd-example-modal-lg" id="exampleModalScrollable" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Registro Estudiantes</h5>
                        <button type="button" class="close" onclick="limpiarDatosModal()" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- metodo para guardar un estudiante -->
                    <div class="modal-body">

                        <form method="post" action="{{route('estudiante.guardar')}}" name="f2"
                              enctype="multipart/form-data">

                            <div class="row" style="width:100%;height: 100%;color: black;margin: 0px;">
                                <div class="col" style="text-align: start;padding: 10px;">


                                    <div class="row" style="height: 20%;margin: 0px;">
                                        <div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }} " style="width: 90%">
                                            <h6>Nombre Completo</h6>
                                            <input
                                                    value="{{old("nombre")}}"
                                                    class="form-control solo-letras" id="nombre" name="nombre"
                                                    required
                                            >
                                            @if ($errors->has('nombre'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row" style="height: 20%;margin: 0px;">
                                        <div class="form-group{{ $errors->has('identificacion') ? ' has-error' : '' }} " style="width: 90%">
                                            <h6>Número Cuenta</h6>
                                            <input type="text" pattern="([0-9]{1,11})"
                                                   class="form-control{{ $errors->has('identificacion') ? ' has-error' : '' }}"
                                                   id="identificacion"
                                                   name="identificacion"
                                                   title="Ingrese solo números"
                                                   required
                                                   value="{{old("identificacion")}}"
                                                   minlength="11" maxlength="11" aria-valuemax="11" max="99999999999">

                                            @if ($errors->has('identificacion'))
                                                <span class="help-block" style="color: red">
                                        <strong>{{ $errors->first('identificacion') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row" style="height: 20%;margin: 0px;">
                                        <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }} " style="width: 90%">
                                            <h6> Teléfono </h6>
                                            <input type="text" pattern="([0-9]{1,8})" style="width: 100%"
                                                   class="form-control{{ $errors->has('telefono') ? ' has-error' : '' }}"
                                                   id="telefono" name="telefono"
                                                   title="Ingrese solo números"
                                                   required
                                                   value="{{old("telefono")}}"
                                                   maxlength="8" minlength="8" aria-valuemax="8" max="99999999">
                                            @if ($errors->has('telefono'))
                                                <span class="help-block" style="color: red">
                                        <strong>{{ $errors->first('telefono') }}</strong>
                                    </span>
                                            @endif

                                        </div>

                                    </div>


                                    <div class="row" style="height: 20%;margin: 0px;">
                                        <div class="form-group {{ $errors->has('fecha_nacimiento') ? ' has-error' : '' }} " style="width: 90%">
                                            <h6>Fecha de nacimiento</h6>
                                            <input type="date" class="form-control" id="fecha_nacimiento"
                                                   name="fecha_nacimiento"

                                                   required
                                                   max="{{date("Y-m-d",strtotime("-1825 days"))}}"
                                                   value="{{old("fecha_nacimiento")}}">
                                            @if ($errors->has('fecha_nacimiento'))
                                                <span class="help-block" style="color: red">
                                        <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
                                    </span>
                                            @endif

                                        </div>
                                    </div>

                                    <div class="row" style="height: 20%;margin: 0px;">
                                        <div class="form-group {{ $errors->has('carrera') ? ' has-error' : '' }}" style="width: 90%">
                                            <h6>Carrera</h6>
                                            <select class="form-control" id="carrera" name="carrera"
                                                    required>
                                                @foreach($carreras as $carrera)
                                                    <option value="{{$carrera->id}}"
                                                            {{ old('carrera') == $carrera->id ? "selected" : "" }}>
                                                        {{$carrera->carrera}}
                                                    </option>
                                                @endforeach
                                                @if ($errors->has('carrera'))
                                                    <span class="help-block" style="color: red">
                                        <strong>{{ $errors->first('carrera') }}</strong>
                                    </span>
                                                @endif

                                            </select>
                                        </div>
                                    </div>

                                </div>


                                <div class="col" style="padding: 10px;">
                                    <div class="row" style="text-align: center;height: 80%;margin: 0px;">
                                        <div class="form-group {{ $errors->has('imagen') ? ' has-error' : '' }}" style="width: 90%">
                                            <h6 style="text-align: start">Imagen del Estudiante (Opcional)</h6>
                                            <img width="200px"   id="previewImagen" style=" max-height:250px;"
                                                 src="/images/addphoto.ico"
                                                 @if($errors->has("imagen")) src="/images/addphoto.ico"
                                                 @endif onclick="seleccionarImagen(event)"/>

                                            <label id="labelImagen" for="imagen" class="btn btn-large" ><span style="font-size: 60px">

                                        </span></label>
                                            <input type="file" accept="image/*"
                                                   onchange="loadFile(event)"
                                                   @if($errors->has("imagen"))
                                                   style="display: none"
                                                   required
                                                   @endif
                                                   class="form-control"
                                                   style="opacity: 0"
                                                   id="imagen"
                                                   name="imagen"/>
                                            @if ($errors->has('imagen'))
                                                <span class="help-block" style="color: red">
                                       <h6> <strong>{{ $errors->first('imagen') }}</strong></h6>
                                    </span>
                                            @endif
                                        </div>

                                        <script>

                                            var loadFile = function (event) {
                                                var image = document.getElementById('previewImagen');
                                                image.src = URL.createObjectURL(event.target.files[0]);
                                                document.getElementById("imagen").style.display = "none";
                                                document.getElementById("labelImagen").style.display="none";
                                            };
                                            var seleccionarImagen = function (event) {
                                                var element = document.getElementById("imagen");
                                                element.click();
                                            }
                                        </script>
                                    </div>






                                    <div class="row" style="text-align: start;height: 20%;margin: 0px;">
                                        <div class="form-group{{ $errors->has('sexo') ? ' has-error' : '' }} ">
                                            <h6>Sexo</h6>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" type="radio"
                                                       title="Masculino"
                                                       name="genero" id="sexo1" value="M"
                                                       required
                                                       @if(old("genero")==='M')
                                                       checked
                                                        @endif>
                                                <label style="color:black; margin-top: 5px" for="sexo1">Masculino</label>

                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="genero" id="sexo2" value="F"
                                                       required
                                                       @if(old("genero")==='F')
                                                       checked
                                                        @endif>
                                                <label style="color:black; margin-top: 5px" for="sexo2">Femenino</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>




                            <div class="modal-footer">
                                <button type="button" onclick="limpiarDatosModal()" class="btn btn-secondary"
                                        data-dismiss="modal">cerrar
                                </button>
                                <button type="submit" class="btn btn-primary">Guardar</button>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- codigo para buscar los estudiantes -->
        <form class="form-inline" method="get" action="{{route('estudiante.buscarEstudiante')}}">


            <div class="input-group mb-3 mr-2">

                <input type="text" class="form-control" id="inputText2" name="busquedaEstudiante"
                       value="{{old("busquedaEstudiante")}}"
                       required
                       placeholder="Buscar">
                @if(old("busquedaEstudiante"))
                    <div class="input-group-prepend">
                        <a class="btn btn-danger" onclick="window.location.href='/estudiantes'" style="color:white;" type="button">&times;</a>
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary mb-3 ">Buscar</button>
        </form>

        <div class="collapse" id="cardCollapses">
            <div class="row" >
                <!-- codigo para sumar los ingresos ingresos totales en dinero -->
                <div class="col-lg-3 col-md-6 col-sm-6 card-efect" style="margin-top: 5px;margin-bottom: 2%">
                    <div class="card card-style">
                        <div class="card-header">

                            <img src="/images/pago.png" width="40px" style="margin-left: 42%">
                            <br>
                            <h6 class="text-center">Total Pagos</h6>
                            <h6 class="text-center">Estudiantes</h6>
                            <h5 class="text-center"><span class="badge badge-dark">{{$ingresos}}</span></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(session("exito"))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('exito') }}
            </div>

        @endif
        @if(session("error"))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" id="crearNuevo" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('error') }}
            </div>

        @endif

        @if(session("errors"))
            <script>
                document.onreadystatechange = function () {

                    if (document.readyState === "complete") {
                        document.getElementById("crearNuevo").click();
                    }
                };

            </script>
        @endif
    <!-- modal para editar  -->
        <div class="modal fade  bd-example-modal-lg" id="editarEstudiante" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalScrollableTitle">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Editar Estudiantes</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <!-- metodo y ruta para editar. -->
                        <form method="post" action="{{route('estudiante.update')}}" enctype="multipart/form-data">
                            <input type="hidden" name="estudiante_id" id="id" value="">

                            {{method_field('put')}}

                            <div class="row" style="width:100%;height: 100%;color: black;margin: 0px;">
                                <div class="col" style="text-align: start;padding: 10px;">

                                    <div class="row" style="height: 20%;margin: 0px;">
                                <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}" style="width: 90%">
                                    <h6>Nombre Completo</h6>
                                    <input type="text" class="form-control solo-letras" id="nombre" name="nombre"
                                           value="{{old("nombre")}}"
                                           @isset($estudiante)
                                           value="{{$estudiante->nombre}}"
                                           @endisset value="{{old('nombre')}}">
                                    @if ($errors->has('nombre'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>

                                    <div class="row" style="height: 20%;margin: 0px;">
                                <div class="form-group{{ $errors->has('identificacion') ? ' has-error' : '' }} " style="width: 90%">
                                    <h6>Número Cuenta</h6>
                                    <input type="text" pattern="([0-9]{1,11})" class="form-control" id="identificacion"
                                           name="identificacion"
                                           value="{{old("identificacion")}}"
                                           @isset($estudiante)
                                           value="{{$estudiante->identificacion}}"
                                           @endisset value="{{old('identificacion')}}"
                                           title="Ingrese solo números"
                                           required
                                           minlength="11" maxlength="11" aria-valuemax="11" max="99999999999"
                                    >
                                    @if ($errors->has('identificacion'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('identificacion') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                                    <div class="row" style="height: 20%;margin: 0px;">
                                <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }} " style="width: 90%">
                                    <h6> Teléfono </h6>
                                    <input input="text" pattern="([0-9]{1,8})" class="form-control" id="telefono"
                                           name="telefono"
                                           value="{{old("telefono")}}"
                                           @isset($estudiante)
                                           value="{{$estudiante->telefono}}"
                                           @endisset value="{{old('telefono')}}"
                                           title="Ingrese solo números"
                                           required
                                           maxlength="8" minlength="8" aria-valuemax="8" max="99999999"
                                    >
                                    @if ($errors->has('telefono'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('telefono') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>



                                    <div class="row" style="height: 20%;margin: 0px;">
                                <div class="form-group{{ $errors->has('fecha_nacimiento') ? ' has-error' : '' }} " style="width: 90%">
                                    <h6>Fecha de nacimiento</h6>
                                    <input type="date" pattern="([0-9]{1,3})" class="form-control" id="fecha_nacimiento"
                                           name="fecha_nacimiento"
                                           value="{{old("fecha_nacimiento")}}"

                                           @isset($estudiante)
                                           value="{{$estudiante->fecha_nacimiento}}"
                                           @endisset value="{{old('fecha_nacimiento')}}"
                                           title="Ingresa solo numeros entre 1 a 99 años"
                                           required

                                           max="{{date("Y-m-d",strtotime("-1825 days"))}}"

                                    >
                                    @if ($errors->has('fecha_nacimiento'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                                    <div class="row" style="height: 20%;margin: 0px;">

                                <div class="form-group{{ $errors->has('carrera') ? ' has-error' : '' }} "style="width: 90%">
                                    <h6>Carrera</h6>
                                    <select class="form-control" id="carrera" placeholder="seleccione" name="carrera"
                                            required>
                                        @foreach($carreras as $carrera)
                                            <option value="{{$carrera->id}}">{{$carrera->carrera}}</option>
                                        @endforeach
                                        @if ($errors->has('carrera'))
                                            <span class="help-block" style="color: red">
                                        <strong>{{ $errors->first('carrera') }}</strong>
                                    </span>
                                        @endif


                                    </select>
                                </div>
                            </div>
                                </div>




                                <div class="col" style="padding: 10px;">
                                    <div class="row" style="text-align: center;height: 80%;margin: 0px;">
                                <div class="form-group {{ $errors->has('imagen') ? ' has-error' : '' }}" style="width: 90%">
                                    <h6 style="text-align: start">Imagen del estudiante</h6>
                                    <img width="200px" style=" max-height:250px"
                                         onerror="this.src='/img/user.png'"
                                         id="previewImagenEditar"
                                         onclick="seleccionarImagenEditar(event)"/>
                                    <input type="file" accept="image/*"
                                           style="display: none"
                                           onchange="loadFile2(event)"
                                           src="" class="form-control" id="imagenEditar"
                                           name="imagen"/>
                                    <br>
                                    <label style="color: black">Modifica la foto si gustas</label>

                                    <script>
                                        var loadFile2 = function (event) {
                                            var image = document.getElementById('previewImagenEditar');
                                            image.src = URL.createObjectURL(event.target.files[0]);
                                            document.getElementById("labelFoto").style.display="none";

                                        };
                                        var seleccionarImagenEditar = function (event) {
                                            var element = document.getElementById("imagenEditar");
                                            element.click();
                                        }</script>
                                </div>

                                        <div class="row" style="text-align: start;height: 20%;margin: 0px;">
                                        <div class="form-group{{ $errors->has('sexo') ? ' has-error' : '' }}" >
                                            <h6>Sexo</h6>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="genero" id="sexo1E" value="M"
                                                       required
                                                       @isset($estudiante)
                                                       value="{{$estudiante->sexo1}}"
                                                       @endisset value="{{old('sexo1')}}"
                                                       @if(old("genero")==='M')
                                                       checked
                                                        @endif>
                                                <label style="color:black; margin-top: 5px" for="sexo1E">Masculino</label>


                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="genero" id="sexo2E" value="F"
                                                       required
                                                       @isset($estudiante)
                                                       value="{{$estudiante->sexo2}}"
                                                       @endisset value="{{old('sexo2')}}"
                                                       @if(old("genero")==='F')
                                                       checked
                                                        @endif
                                                >
                                                <label style="color:black; margin-top: 5px" for="sexo2E">Femenino</label>


                                            </div>

                                        </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- boton para guardar y cerrar -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>


        <div class="table-responsive " style="-moz-box-shadow: 0px 5px 3px 3px rgba(194,194,194,1);
box-shadow: 0px 5px 3px 3px rgba(194,194,194,1);">
            <table class="table ruler-vertical table-hover mx-sm-0 ">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">N°</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Número de Cuenta</th>
                    <th scope="col">Carrera</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Sexo</th>
                    <th scope="col">Edad</th>
                    <th scope="col">Fecha de Ingreso</th>
                    <th scope="col">Acciones</th>
                </tr>
                </thead>

                <tbody>
                @if($estudiantes->count()>0)
                    @foreach($estudiantes as $estudiante)

                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$estudiante->nombre}}</td>
                            <td>{{$estudiante->identificacion}}</td>
                            <td>{{$estudiante->carrera}}</td>
                            <td>{{$estudiante->telefono}}</td>
                            <td>{{$estudiante->genero}}</td>
                            <td>{{$estudiante->edad}}
                            <td>{{date("d-m-Y",strtotime($estudiante->created_at))}}</td>
                            <div style="overflow: auto"></div>


                            <td class="form-inline " style="width: auto">
                                <form style="display: none" id="pago_form" method="GET"
                                      action="{{route("pagoestudiantes",["id"=>$estudiante->id])}}">
                                    <input name="id_cliente" value="{{$estudiante->id}}" type="hidden">
                                    {{ csrf_field() }}
                                </form>

                                <button class="btn btn-outline-warning mr-xl-2" data-toggle="modal"
                                        data-target="#editarEstudiante" data-mynombre="{{$estudiante->nombre}}"
                                        data-myfecha_nacimiento="{{$estudiante->fecha_nacimiento}}"
                                        data-mycuenta="{{$estudiante->identificacion}}"
                                        data-myfecha="{{$estudiante->fecha_de_ingreso}}"
                                        data-mytelefono="{{$estudiante->telefono}}"
                                        data-mycarrera="{{$estudiante->id_carrera}}"
                                        data-imagen="{{$estudiante->imagen}}"
                                        data-catid="{{$estudiante->id}}" data-sexo="{{$estudiante->genero}}"><i
                                            class="fas fa-edit"></i></button>

                                <button class="btn btn-outline-danger mr-xl-2 "
                                        data-id="{{$estudiante->id}}"
                                        data-nombre="{{$estudiante->nombre}}"
                                        data-toggle="modal"
                                        data-target="#modalBorrarEstudiante"><i class="fas fa-trash-alt"></i>
                                </button>


                                <a class="btn btn-outline-dark mr-xl-2 "
                                   href="{{route("imc.ini",$estudiante->id)}}">
                                    <i class="fas fa-running"></i>
                                </a>


                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <button class="dropdown-item" type="button"><a
                                                class="nav-link js-scroll-trigger"
                                                href="{{route("imc.ini",$estudiante->id)}}">MedidasAntropometricas</a>
                                    </button>
                                    <button class="dropdown-item" type="button"><a
                                                class="nav-link js-scroll-trigger"
                                                href="{{route("grasa.uni",["id"=>$estudiante->id])}}">Grasa
                                            Corporal</a>
                                    </button>
                                    <button class="dropdown-item" type="button"><a
                                                class="nav-link js-scroll-trigger"
                                                href="{{route("ruffier.uni",["id"=>$estudiante->id])}}">Ruffier</a>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9" style="text-align: center">No hay estudiantes ingresados</td>
                @endif


                </tbody>
            </table>



            @if($estudiantes->count()>10)
                <div class="panel">
                    {{ $estudiantes->links() }}
                </div>
            @endif

        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalBorrarEstudiante">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Atención Eliminación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route('estudiante.borrar')}}">
                    {{method_field('delete')}}

                    <div class="modal-body">
                        <input name="id" id="id" type="hidden">

                        <div>¿Está seguro que desea borrar a <label style="color: black;font-weight: bold"
                                                                    id="nombreBorrar"></label> ?
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
@endsection
<style>

    .btn {
        display: inline-block;
        padding: 4px 12px;
        margin-bottom: 0;
        font-size: 14px;
        line-height: 20px;
        color: #333333;
        text-align: center;
        cursor: pointer;
        border: 1px solid #bbbbbb;
        border-color: #e6e6e6 #e6e6e6 #bfbfbf;
        border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
        border-bottom-color: #a2a2a2;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
    }

    .btn {
        border-color: #c5c5c5;
        border-color: rgba(0, 0, 0, 0.15) rgba(0, 0, 0, 0.15) rgba(0, 0, 0, 0.25);
    }

    .btn-large {
        font-size: 24px;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
    }
    .boton1:hover {
        transition: all 0.2s ease;
        transform: scaleY(1.3) scaleX(1.3);
    }

    .tabla1:hover {

        box-shadow: 0 4px 16px rgba(49, 100, 50, 1);
        transition: all 0.2s ease;
        transform: scaleY(1.1) scaleX(1.1);
    }

</style>