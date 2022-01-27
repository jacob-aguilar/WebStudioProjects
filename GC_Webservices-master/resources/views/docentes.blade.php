@extends("layouts.principal")

@section("content")
    <!-- Codigo para ver el fonde la imagen del proyecto en la parte superior de la vista -->

    <header class="fondo" style="max-height: 100px;">
        <div class="container">
        </div>
    </header>



    <div class="w3-container w3-teal mx-5" style="font-family: 'Raleway', sans-serif">
            <h2 class=" mt-3">Listado de Docentes</h2>


        <!-- codigo para crear un nuevo docente -->


            <button type="button" class="btn btn-primary float-right boton1" id="crearNuevo" data-toggle="modal" data-target="#exampleModalScrollable">
                <i class="fas fa-user-plus"></i>
            </button>

            <!--button type="button"  class="btn btn-warning float-right" data-dismiss="alert"
                    data-toggle="modal" data-target="#exampleModalScrollable">

            </button-->
        @if(session("errors"))
            <script>
                document.onreadystatechange= function () {

                    if(document.readyState==="complete"){
                        document.getElementById("crearNuevo").click();
                    }
                };

            </script>
        @endif
    <!-- funcion para cargar la imagen -->

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
    <!--  limpiar-->
        <script>
            function limpiarDatosModal() {
                document.getElementById("nombre").value='';
                document.getElementById("fecha_nacimiento").value='';
                document.getElementById("identificacion").value='';
                document.getElementById("profesion_u_oficio").value='';
                document.getElementById("telefono").value='';
                document.getElementById("sexo1").checked=false;
                document.getElementById("sexo2").checked=false;
                document.getElementById("labelImagen").value='';
                document.getElementById("previewImagen").value='';
                document.getElementById("imagen").value='';
                document.getElementById("previewImagen").src="/images/addphoto.ico";





            }
        </script>

            <div class="modal fade  bd-example-modal-lg" id="exampleModalScrollable" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalScrollableTitle">Registro de Docentes</h5>
                            <button type="button" onclick="limpiarDatosModal()" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- Guardar datos del docente -->
                        <div class="modal-body">
                            <form method="post" action="{{route('docente.guardar')}}"name="f2"
                            enctype="multipart/form-data">

                                <div class="row" style="width:100%;height: 100%;color: black;margin: 0px;">
                                    <div class="col" style="text-align: start;padding: 10px;">

                                        <div class="row" style="height: 20%;margin: 0px;">
                                    <div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }} " style="width: 90%">
                                    <h6>Nombre Completo</h6>
                                    <input type="text" class="form-control solo-letras" id="nombre" name="nombre"
                                           required
                                           value="{{old("nombre")}}"
                                    >
                                        @if ($errors->has('nombre'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                            </div>
                                        <!-- Codificacion para la validación del cada campo del modal -->
                                        <div class="row" style="height: 20%;margin: 0px;">
                                    <div class="form-group{{ $errors->has('identificacion') ? ' has-error' : '' }} " style="width: 90%">
                                        <h6>Número de Empleado</h6>
                                        <input type="text" pattern="([0-9]{1,5})" class="form-control" id="identificacion" name="identificacion"
                                               title="Ingrese solo números"
                                               required
                                               value="{{old("identificacion")}}"
                                               minlength="5" maxlength="5" min="1" max="99999"
                                        >
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
                                        <input type="text" pattern="([0-9]{1,8})" class="form-control" id="telefono" name="telefono"
                                               title="Ingrese solo números"
                                               required
                                               maxlength="8" minlength="8" aria-valuemax="8" max="99999999"
                                               value="{{old("telefono")}}"

                                        >
                                        @if ($errors->has('telefono'))
                                            <span class="help-block" style="color: red">
                                        <strong>{{ $errors->first('telefono') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                        <div class="row" style="height: 20%;margin: 0px;">
                                    <div class="form-group{{ $errors->has('fecha_nacimiento') ? ' has-error' : '' }}  " style="width: 90%">
                                        <h6>Fecha de nacimiento</h6>
                                        <input type="date"  pattern="([0-9]{1,3})" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                                               title="Ingrese solo números entre 1 a 99 años"

                                               required
                                               minlength="1" maxlength="2" min="1"
                                               max="{{date("Y-m-d",strtotime("-1825 days"))}}"
                                               value="{{old("fecha_nacimiento")}}"
                                        >
                                        @if ($errors->has('fecha_nacimiento'))
                                            <span class="help-block" style="color: red">
                                        <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                        <div class="row" style="height: 20%;margin: 0px;">

                                    <div class="form-group{{ $errors->has('profesion_u_oficio') ? ' has-error' : '' }} " style="width: 90%">
                                        <h6>Profesión</h6>
                                        <input type="text" class="form-control solo-letras" id="profesion_u_oficio" name="profesion_u_oficio"
                                               required
                                               value="{{old("profesion_u_oficio")}}"
                                        >
                                        @if ($errors->has('profesion_u_oficio'))
                                            <span class="help-block" style="color: red">
                                        <strong>{{ $errors->first('profesion_u_oficio') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                    </div>



                                        <div class="col" style="padding: 10px;">
                                            <div class="row" style="text-align: center;height: 80%;margin: 0px;">
                                        <div class="form-group {{ $errors->has('imagen') ? ' has-error' : '' }}"style="width: 90%">
                                        <h6 style="text-align: start">Imagen del Docente (Opcional)</h6>
                                        <img width="200px"  id="previewImagen" style="max-height:250px"
                                             src="/images/addphoto.ico"
                                             @if($errors->has("imagen"))  src="/images/addphoto.ico"
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
                                               style="opacity: 0" id="imagen"
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
                                            <input class="form-check-input" type="radio" name="genero" id="sexo1" value="M"
                                                   @if(old("genero")==='M')
                                                   checked
                                                   @endif
                                                   required>
                                            <label style="color:black; margin-top: 5px"  for="sexo1">Masculino</label>

                                            <label class="form-check-label" for="inlineRadio1"></label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="genero" id="sexo2" value="F"
                                                   @if(old("genero")==='F')
                                                   checked
                                                   @endif
                                                   required>
                                            <label style="color:black; margin-top: 5px"  for="sexo2">Femenino</label>
                                            <label class="form-check-label" for="inlineRadio2"></label>
                                        </div>
                                    </div>

                            </div>
                                        </div>
                                </div>





                                <div class="modal-footer">
                                <button type="button" onclick="limpiarDatosModal()" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                                <button type="submit"  class="btn btn-primary">Guardar</button>

                            </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        <!--Codificacion para la busqueda de los clientes  -->
        <form class="form-inline" method="get" action="{{route('docente.buscarDocente')}}">

            <div class="input-group mb-3 mr-2">

                <input type="text" class="form-control " name="busquedaDocente"
                       id="inputText2"  value="{{old("busquedaDocente")}}"
                       required
                       placeholder="Buscar">
                @if(old("busquedaDocente"))
                    <div class="input-group-prepend">
                        <a class="btn btn-danger" onclick="window.location.href='/docentes'" style="color:white;" type="button">&times;</a>
                    </div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary mb-3 ">Buscar</button>
        </form>
        <!-- codigo de la alerta de registro con exito -->
        @if(session("exito"))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button"  class="close" data-dismiss="alert" aria-label="Close">
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
                document.onreadystatechange= function () {

                    if(document.readyState==="complete"){
                        document.getElementById("crearNuevo").click();
                    }
                };

            </script>
        @endif

        <div class="modal fade  bd-example-modal-lg" id="editarDocente" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Registro de Docentes</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!--  metodo para editar-->
                    <div class="modal-body">

                        <form method="post" action="{{route('docente.update')}}"  enctype="multipart/form-data">
                            <input type="hidden" name="docente_id" id="id" value="">
                            {{method_field('put')}}


                            <div class="row" style="width:100%;height: 100%;color: black;margin: 0px;">
                                <div class="col" style="text-align: start;padding: 10px;">
                                    <!-- codigo para validar los campos en editar y poner los errores -->
                                    <div class="row" style="height: 20%;margin: 0px;">
                                <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }} " style="width: 90%">
                            <h6>Nombre Completo</h6>
                                <input type="text" class="form-control solo-letras" id="nombre" name="nombre"
                                       value="{{old("nombre")}}"
                                       @isset($docente)
                                       value="{{$docente->nombre}}"
                                       @endisset value="{{old('nombre')}}"
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
                                    <h6>Número de Empleado</h6>
                                    <input type="text"  pattern="([0-9]{1,5})"  class="form-control" id="identificacion" name="identificacion"
                                           value="{{old("identificacion")}}"
                                           @isset($docente)
                                           value="{{$docente->numero_de_empleado}}"
                                           @endisset value="{{old('identificacion')}}"
                                           title="Ingrese solo números "
                                           required
                                           minlength="5" maxlength="5" min="1" max="99999"

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
                                    <input type="text" pattern="([0-9]{1,8})" class="form-control" id="telefono" name="telefono"
                                           value="{{old("telefono")}}"
                                           @isset($docente)
                                           value="{{$docente->telefono}}"
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

                                <div class="form-group{{ $errors->has('fecha_nacimiento') ? ' has-error' : '' }} "style="width: 90%">
                                    <h6>Fecha de nacimiento</h6>
                                    <input type="date"  pattern="([0-9]{1,3})"  class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                                           max="{{date("Y-m-d",strtotime("-1825 days"))}}"
                                           value="{{old("fecha_nacimiento")}}"
                                           @isset($docente)
                                           value="{{$docente->fecha_nacimiento}}"
                                           max="{{date("Y-m-d",strtotime("-1825 days"))}}"
                                           @endisset value="{{old('fecha_nacimiento')}}"
                                           title="Ingrese solo números entre 1 a 99 años"
                                           required
                                           minlength="1" maxlength="2" min="1" max="99"
                                    >
                                    @if ($errors->has('fecha_nacimiento'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                                    <div class="row" style="height: 20%;margin: 0px;">
                                <div class="form-group{{ $errors->has('profesion_u_oficio') ? ' has-error' : '' }} "style="width: 90%">
                                    <h6>Profesión</h6>
                                    <input type="text"  class="form-control solo-letras" id="profesion_u_oficio" name="profesion_u_oficio"
                                           value="{{old("profesion_u_oficio")}}"
                                           @isset($docente)
                                           value="{{$docente->profesion_u_oficio}}"
                                           @endisset value="{{old('profesion_u_oficio')}}"
                                           required
                                    >
                                    @if ($errors->has('profesion_u_oficio'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('profesion_u_oficio') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                                </div>



                                <div class="col" style="padding: 10px;">
                                    <div class="row" style="text-align: center;height: 80%;margin: 0px;">

                                <div class="form-group {{ $errors->has('imagen') ? ' has-error' : '' }}"style="width: 90%">
                                    <h6 style="text-align: start">Imagen del Docente</h6>

                                    <input type="file" accept="image/*"
                                           style="display: none"
                                           onchange="loadFile4(event)" class="form-control"
                                           id="imagenEditarDocente"
                                           name="imagen"/>

                                    <img width="200px" style="max-height:250px"
                                         onerror="this.src='/img/user.png'"
                                         id="previewImagenEditar"
                                         onclick="seleccionarImagenEditar(event)"/>

                                    <br>
                                    <label style="color: black">Modifica la foto si gustas</label>

                                    <script>
                                        var loadFile4 = function (event) {
                                            var image = document.getElementById('previewImagenEditar');
                                            image.src = URL.createObjectURL(event.target.files[0]);
                                            document.getElementById("imagenEditarDocente").style.display = "none";
                                        };
                                        var seleccionarImagenEditar = function (event) {
                                            var element = document.getElementById("imagenEditarDocente");
                                            element.click();
                                        }
                                    </script>
                                </div>







                                        <div class="row" style="text-align: start;height: 20%;margin: 0px;">

                                <div class="form-group{{ $errors->has('sexo') ? ' has-error' : '' }} ">
                                    <h6>Sexo</h6>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="genero" id="sexo1D" value="M" required
                                               @isset($docente)
                                               value="{{$docente->sexo1}}"
                                               @endisset value="{{old('sexo1')}}"
                                               @if(old("genero")==='M')
                                               checked
                                                @endif
                                        >
                                        <label style="color:black; margin-top: 5px"  for="sexo1D">Masculino</label>

                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="genero" id="sexo2D" value="F" required
                                               @isset($docente)
                                               value="{{$docente->sexo2}}"
                                               @endisset value="{{old('sexo2')}}"
                                               @if(old("genero")==='F')
                                               checked
                                                @endif
                                        >
                                        <label style="color:black; margin-top: 5px"  for="sexo2D">Femenino</label>
                                        <label class="form-check-label" for="inlineRadio2"></label>
                                    </div>
                                </div>

                            </div>
                                    </div>
                                </div>
                            </div>

                            <!-- bonotes para guardar y cerrar -->

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                                <button type="submit"  class="btn btn-primary">Guardar</button>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- Creacion de la tabla  -->

        <div class="table-responsive " style="-moz-box-shadow: 0px 5px 3px 3px rgba(194,194,194,1);
box-shadow: 0px 5px 3px 3px rgba(194,194,194,1);">
            <table class="table ruler-vertical table-hover mx-sm-0 ">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">N°</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Número de Empleado</th>
                    <th scope="col">Profesión</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Sexo</th>
                    <th scope="col">Edad</th>
                    <th scope="col">Fecha de Ingreso</th>
                    <th scope="col">Acciones</th>
                </tr>
                </thead>


                <tbody>
                @if($docentes->count()>0)
                    @foreach($docentes as $docente)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$docente->nombre}}</td>
                    <td>{{$docente->identificacion}}</td>
                    <td>{{$docente->profesion_u_oficio}}</td>
                    <td>{{$docente->telefono}}</td>
                    <td>{{$docente->genero}}</td>
                    <td width="100px">{{$docente->edad}}</td>

                    <td>{{date("d-m-Y",strtotime($docente->created_at))}}</td>
                    <div  style="overflow: auto"></div>

                    <td class="form-inline">
                        <!-- Editar los datos de docentes -->
                        <button class="btn btn-outline-warning mr-2" data-toggle="modal" data-target="#editarDocente" data-mynombre="{{$docente->nombre}}" data-myfecha_nacimiento="{{$docente->fecha_nacimiento}}"
                                data-mynumero="{{$docente->identificacion}}"
                                data-imagen="{{$docente->imagen}}"
                                data-myfecha="{{$docente->fecha_de_ingreso}}" data-myprofesion="{{$docente->profesion_u_oficio}}"
                                data-mytelefono="{{$docente->telefono}}" data-catid="{{$docente->id}}" data-sexo="{{$docente->genero}}"><i class="fas fa-edit"></i></button>
                        <!--Borrar docente  -->
                        <button class="btn btn-outline-danger mr-xl-2 "
                                data-id="{{$docente->id}}"
                                data-nombre="{{$docente->nombre}}"
                                data-toggle="modal"
                                data-target="#modalBorrarDocente"><i class="fas fa-trash-alt"></i>
                        </button>
                        <a class="btn btn-outline-dark mr-xl-2 "
                           href="{{route("imc.ini",$docente->id)}}">
                            <i class="fas fa-running"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <button class="dropdown-item" type="button"><a class="nav-link js-scroll-trigger" href="{{route("imc.ini",$docente->id)}}">MedidasAntropometricas</a></button>
                            <button class="dropdown-item" type="button"><a class="nav-link js-scroll-trigger" href="{{route("grasa.uni",["id"=>$docente->id])}}">Grasa Corporal</a></button>
                            <button class="dropdown-item" type="button"><a class="nav-link js-scroll-trigger" href="/ruffiel">Ruffiel</a></button>
                        </div>
                    </td>
                </tr>
@endforeach
                @else
                    <tr>
                        <td colspan="9" style="text-align: center">No hay docentes ingresados</td>

                @endif

                </tbody>
            </table>

            @if($docentes->count()>10)
                <div class="panel">
                    {{ $docentes->links() }}
                </div>
            @endif

    </div>
</div>
    <div class="modal fade" tabindex="-1" role="dialog" id="modalBorrarDocente">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Atención Eliminación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route('docente.borrar')}}">
                    {{method_field('delete')}}

                    <div class="modal-body">
                        <input name="id" id="id" type="hidden">

                        <div>¿Está seguro que desea borrar a <label style="color: black;font-weight: bold" id="nombreBorrar"></label> ?</div>
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