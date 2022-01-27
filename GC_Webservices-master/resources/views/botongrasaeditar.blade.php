@extends("layouts.principal")

@section("content")
    <!-- Codigo para ver el fonde la imagen del proyecto en la parte superior de la vista -->
    <header class="fondo" style="max-height: 100px;">
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">Estudiantes</div>
            </div>
        </div>
    </header>
    <!-- codigo para retornar de acuerdo el id de cada cliente en este caso -->
    <nav aria-label="breadcrumb" style="margin:1%; margin-right:70%;">
        <ol class="breadcrumb" style="background-color: white">
            <li class="breadcrumb-item"><a href="/estudiantes">Estudiante</a></li>
            <li class="breadcrumb-item"><a href="{{route("grasa.uni",["id_grasa"=>$nombre->id])}}">Grasa Corporal</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar</li>
        </ol>
    </nav>
    <div class="container-xl clearfix px-2 mt-4">
        <div id="divPerfil" class="perfil col-md-1 col-md-2 col-12 card  float-md-left mr-5 pr-md-8 mt-lg-3 pr-xl-6 ml-lg-4">
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
            <!-- Codigo para mostrar la imagen en cada vista -->
            <img  src="/clientes_imagenes/{{$nombre->imagen}}" width="250px" height="260px"
                 style="margin-left: -7%">
            <div class="card margencard" style=" border: none;">


                <div >
                    <h5 style="margin-top: 10%">{{$nombre->nombre}}</h5>

                </div>
            </div>

        </div>
            <div class="card" style="width: 170px; border: none;background: transparent;margin-left: 3%;margin-top: 5px">

            </div>
        <!-- Codigo para mostrar el menu de expediente -->

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
            <a class="btn btn-secondary btn-sm" href="{{route("imc.ini",[$nombre->id])}}">MedidasAntropometricas</a>
            <a class="btn btn-primary btn-sm" href="{{route("grasa.uni",["id"=>$nombre->id])}}">GrasaCorporal</a>
            <a class="btn btn-secondary btn-sm" href="{{route("ruffier.uni",["id"=>$nombre->id])}}">Ruffier</a>


        </div>

        <script type="text/javascript">

            document.onreadystatechange = function () {

                if (document.readyState === "complete") {
                    calcularGrasa();
                }
            };

            <!-- Codigo para la funcion logica de los formularios -->


            function calcularGrasa() {
                pc_tricipital = document.getElementById("pc_tricipital").value;
                pc_infraescapular = document.getElementById("pc_infraescapular").value;
                pc_biciptal = document.getElementById("pc_biciptal").value;
                pc_supra_iliaco = document.getElementById("pc_supra_iliaco").value;
                grasa = (2.745 + (0.0008 * pc_tricipital) +
                    (0.002 * pc_infraescapular) + (0.637 * pc_supra_iliaco) + (0.809 * pc_biciptal));
                document.getElementById("grasa").value = grasa.toFixed(0);
                var genero = document.getElementById("sexo").value;


                if (genero === "M") {
                    if (grasa > 26) {
                        leyenda = 1;
                    } else if (grasa > 18) {
                        leyenda =
                            2;
                    } else if (grasa > 14) {
                        leyenda =
                            3;
                    } else if (grasa > 6) {
                        leyenda =
                            4;
                    } else if (grasa > 2) {
                        leyenda =
                            5;
                    } else {
                        leyenda = 6;

                    }
                } else {
                    if (grasa > 32) {
                        leyenda = 1;
                    } else if (grasa > 25) {
                        leyenda =
                            2;
                    } else if (grasa > 21) {
                        leyenda =
                            3;
                    } else if (grasa > 14) {
                        leyenda =
                            4;
                    } else if (grasa > 10) {
                        leyenda =
                            5;
                    } else {
                        leyenda = 6

                    }

                }

                document.getElementById("id_diagnostico").value = leyenda;

            }</script>

        </head>


        <input id="sexo" value="{{$nombre->genero}}" type="hidden">
        <!-- Metodo para guardar lo editado  -->
        <form name="id_imc" id="id_imc"
              style="font-family: 'Montserrat', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'"
              method="post"
              action="@isset($grasa)
              {{route('grasa.update', $grasa->id)}}
              @endisset ">

            {{method_field('put')}}


            <h5 style="margin-top: -1%;">Editar medidas de la grasa corporal</h5>
            <!-- Formulario para ingresar datos -->


            <div class="form-row">
                <div class="form-group col-md-6">
                    <h6 class="label2" for="email" style="margin-top: 1%">Pc tricipital:</h6>
                    <input style="width: 310px" type="number" class="form-control inputtamaño3" step="0.0001"
                           onkeyup="calcularGrasa()"
                           id="pc_tricipital" name="pc_tricipital" maxlength="3"
                           @isset($grasa)
                           value="{{$grasa->pc_tricipital}}"
                            @endisset
                    >
                </div>


                <div class="form-group col-md-6">
                    <h6 class="label2" for="email" style="margin-top: 1%">Pc Infraescrupural:</h6>
                    <input style="width: 310px" type="number" class="form-control inputtamaño3" step="0.0001"
                           onkeyup="calcularGrasa()"
                           id="pc_infraescapular" name="pc_infraescapular" maxlength="50"
                           placeholder="Ingrese medicas en cm"
                           @isset($grasa)
                           value="{{$grasa->pc_infraescapular}}"
                            @endisset
                    >
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <h6 class="label2" for="email" style="margin-top: 2%">Pc Biciptal:</h6>
                    <input style="width: 310px" type="number" class="form-control inputtamaño3" step="0.0001"
                           onkeyup="calcularGrasa()"
                           id="pc_biciptal" name="pc_biciptal" maxlength="3" placeholder="Ingrese medicas en cm"
                           @isset($grasa)
                           value="{{$grasa->pc_biciptal}}"
                            @endisset
                    >
                </div>


                <div class="form-group col-md-6">
                    <h6 class="label2" for="email" style="margin-top: 2%">Pc Suprailiaco:</h6>

                    <input style="width: 310px" type="number" class="form-control inputtamaño3" step="0.0001"
                           onkeyup="calcularGrasa()"
                           id="pc_supra_iliaco" name="pc_supra_iliaco" maxlength="50"
                           placeholder="Ingrese medicas en cm"
                           @isset($grasa)
                           value="{{$grasa->pc_supra_iliaco}}"
                            @endisset
                    >
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <h6 class="label2" for="email" style="margin-left:10% ; margin-top: 1% ">Porcentaje:</h6>
                    <input style="width: 310px; margin-left: 10%" type="number" class="form-control inputtamaño3" step="0.0001"
                           id="grasa" name="grasa" maxlength="3"
                           @isset($grasa)
                           value="{{$grasa->grasa}}"
                           @endisset
                           readonly>
                </div>



                    <input style="width: 310px; display: none " type="hidden" class="form-control inputtamaño3" step="0.0001"
                           id="id_diagnostico" name="id_diagnostico" maxlength="50"
                           @isset($grasa)
                           value="{{$grasa->leyenda}}"
                           @endisset
                           readonly>

            </div>


            <input name="id_cliente" value="{{$id->id}}" type="hidden">


            <div class="container2">

                <!--Botonones para guardar y cancelar  -->
                <a class="btn btn-primary my-2 boton" style="margin-left: 28%"
                   href="{{route("grasa.uni",["id"=>$id])}}">Cancelar</a>


                <button type="submit" class="btn btn-primary  boton3">Guardar</button>
            </div>

        </form>

    </div>
@endsection
