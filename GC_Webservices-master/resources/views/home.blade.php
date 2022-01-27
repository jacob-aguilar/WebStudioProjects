@extends('layouts.principal')

@section('content')

    <!--LETRAS DE PRESENTACION  -->
    <div class=" fondo2" style="font-family: 'Raleway', sans-serif">
        <div class="intro-lead-in text-center ">Bienvenido al control del gimnasio</div>
        <div class="intro-heading text-uppercase text-center ">UNAH-TEC Danli</div>

        <div class="container" style="margin-top: 60px">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 card-efect" style="margin-top: 10px">
                    <div class="card card-style" style="background: #f5f5f5 ">
                        <div class="card-header">
                            <!-- CONTEO DE LOS INGRESO ESTUDIANTES, DOCENTESN Y PARTICULARES -->
                            <img src="/images/estudiante.svg" width="80px" style="margin-left:30%">
                            <br>
                            <h5 class="text-center">Total Estudiantes </h5>
                            <h5 class="text-center"><span class="badge badge-dark">{{$estudiantes}}</span></h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6  card-efect" style="margin-top: 10px">
                    <div class="card card-style" style="background: #f5f5f5 ">
                        <div class="card-header">
                            <img src="/images/docente.svg" width="80px" style="margin-left: 30.05%">
                            <br>
                            <h5 class="text-center ">Total Docentes</h5>
                            <h5 class="text-center"><span class="badge badge-dark">{{$docentes}}</span></h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 card-efect" style="margin-top: 10px">
                    <div class="card  card-style" style="background: #f5f5f5 ">
                        <div class="card-header">

                            <img src="/images/particulares.svg" width="80px" style="margin-left: 30%">
                            <br>
                            <h5 class="text-center ">Total Particulares</h5>
                            <h5 class="text-center"><span class="badge badge-dark">{{$particulares}}</span></h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 card-efect" style="margin-top: 10px"    >
                    <div class="card card-style" style="background: #f5f5f5 ">
                        <div class="card-header">
                            <img src="/images/dinero.ico" width="80px" style="margin-left: 30%">
                            <br>
                            <h5 class="text-center ">Ingresos Totales</h5>
                            <h5 class="text-center"><span class="badge badge-dark">{{$ingresos}}</span></h5>

                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-light"
                    data-target="#modalPruebaRapida"
                    data-toggle="modal"
               style="margin-left: 43%;margin-top: 10px"><span class="badge
 badge-danger">Prueba</span> Peso ideal</button>
        </div>


        <!-- Modal DEL PESO IDEAL -->
        <div class="modal fade" id="modalPruebaRapida" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Peso Ideal</h5>
                        <button type="button" class="close"
                                onclick="limpiarDatosModal()" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <h6 class="" for="femeninoRB">Seleccione su sexo:</h6>
                            <br><br>
                            <div class="form-check" style="margin-left: 5px">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="femeninoRB" value="F">
                                <label class="form-check-label" style="color: black" for="femeninoRB">Femenino</label>
                            </div>
                            <div class="form-check ml-1">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="masculinoRB" value="M">
                                <label class="form-check-label" for="masculinoRB" style="color: black;">Masculino</label>
                            </div>
                        </div>

                        <div class="form-row " >
                        <div class="form-group col-md-4">
                            <h6 class=" " for="email" style=" margin-top: -1%">Altura:</h6>
                            <input style="width: 310px" type="number" class="form-control inputtamaño3" step="0.0001" id="altura"
                                   name="altura" maxlength="3" placeholder="Ingrese su altura" required min="20"  max="300" pattern="^[0-9]+"

                            >
                        </div>

                        </div>


                        <div class="alert alert-success" role="alert">

                            <h6>Tu peso ideal es:</h6> <h5 id="pesoIdeal"></h5>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="limpiarDatosModal()" data-dismiss="modal">cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="calcularPesoIdeal()">Calcular</button>
                    </div>
                </div>
            </div>


    </div>
        <!--FUNCIONES DEL MODAL DEL PESO IDEAL COMO LIMPIAR,CALCULAR Y CONDICIONAR  -->
        <script>
            function limpiarDatosModal() {
                var femeninoRB = document.getElementById("femeninoRB").checked =false;
                var masculinoRB = document.getElementById("masculinoRB").checked=false;
                var altura = document.getElementById("altura").value="";
                var pesoIdeal=document.getElementById("pesoIdeal").innerText="";
            }
            function calcularPesoIdeal() {
                var femeninoRB = document.getElementById("femeninoRB").checked;
                var masculinoRB = document.getElementById("masculinoRB").checked;
                var altura = document.getElementById("altura").value;
                var pesoIdeal=document.getElementById("pesoIdeal");

                if (!femeninoRB&&!masculinoRB) {
                    pesoIdeal.innerText="Selecciona el sexo"
                }else {
                    if (altura) {

                        if (femeninoRB) {
                            var pesoidealF = (0.67 * altura) - 52;
                            pesoIdeal.innerText = pesoidealF.toFixed(2) +"Kg";
                        }
                        if (masculinoRB) {

                            var pesoidealM = (0.75 * altura) - 62.5;
                            pesoIdeal.innerText = pesoidealM.toFixed(2) +"Kg";

                        }
                        if(altura<20){
                            pesoIdeal.innerText = "Ingrese la altura superior a 20 cm";
                        }
                        if(altura>300){
                            pesoIdeal.innerText = "Ingrese la altura inferior a 300 cm";
                        }

                    } else {
                        pesoIdeal.innerText = "Ingrese la altura requerida";
                    }
                }

            }
        </script>
@endsection

<style>
   /* .card-style{
        transition: all 0.2s ease-in-out;
    }
    .card-efect{
        transition: 0.2s all ease-in-out;
    }


    .card-efect:hover .card-style {
        transform: scaleY(1.1) scaleX(1.1);
        z-index: 100;
        box-shadow: 0 15px 20px rgba(0, 0, 0, 0.3);
        background: #3a3a3a;
        color: white;
    }*/
</style>
