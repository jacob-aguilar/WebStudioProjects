<!DOCTYPE html>
<html lang="es" >

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Gym Control</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset("/vendor/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="{{asset("/vendor/fontawesome-free/css/all.min.css")}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="{{asset("css/agency.min.css")}}" rel="stylesheet">
    <link href="{{asset("/css/gym.css")}}" rel="stylesheet">

</head>

<body id="page-top">

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container" >
        <strong style="color: #c69500;font-size: 200%">Gym Control</strong>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ml-auto">
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="/">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="/estudiantes">Estudiantes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="/docentes">Docentes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="/particulares">Particulares</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="/estadisticas">Estadisticas</a>
                </li>

                <li class="nav-item dropdown">
                    <a href="#" class="nav-link  dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-expanded="false">
                         Perfil <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/perfil">
                            Seguridad
                        </a>

                        <a class="dropdown-item" href="{{ route('logout') }}" data-toggle="modal" data-target="#cerrarSesionModal">
                            Cerrar sesion
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>

                    </div>
                </li>

            </ul>
        </div>
    </div>
</nav>

@yield('content')


<div class="modal fade" tabindex="-1" id="cerrarSesionModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Advertencia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Estas seguro que deseas cerrar sesión?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Si</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<!-- Footer
<footer class="footer">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4">
                <span class="copyright">Copyright &copy; unah.edu.hn 2019</span>
            </div>
            <div class="col-md-4">
                <ul class="list-inline social-buttons">
                    <li class="list-inline-item">
                        <a href="#">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <ul class="list-inline quicklinks">
                    <li class="list-inline-item">
                        <a href="#">Politica de Privacidad</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">Terminos de Uso</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>-->

<!-- Bootstrap core JavaScript -->
<script src="{{asset("/vendor/jquery/jquery.min.js")}}"></script>
<script src="{{asset("/vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script>

<!-- Plugin JavaScript -->
<script src="{{asset("/vendor/jquery-easing/jquery.easing.min.js")}}"></script>

<!-- Contact form JavaScript -->
<script src="{{asset("/js/jqBootstrapValidation.js")}}"></script>
<script src="{{asset("/js/contact_me.js")}}"></script>

<!-- Custom scripts for this template -->
<script src="{{asset("/js/agency.min.js")}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js"></script>



<script>


    $('#editarEstudiante').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var nombre = button.data('mynombre');
        var fecha_nacimiento = button.data('myfecha_nacimiento');
        var cuenta = button.data('mycuenta');
        var fecha = button.data('myfecha');
        var telefono = button.data('mytelefono');
        var carrera = button.data('mycarrera');
        var genero = button.data("sexo");
        var cat_id = button.data('catid');
        var imagen =button.data("imagen");
        var modal = $(this);

        modal.find('.modal-body #nombre').val(nombre);
        modal.find('.modal-body #fecha_nacimiento').val(fecha_nacimiento);
        modal.find('.modal-body #identificacion').val(cuenta);
        modal.find('.modal-body #fecha_de_ingreso').val(fecha);
        modal.find('.modal-body #telefono').val(telefono);
        modal.find('.modal-body #carrera').val(carrera);
        modal.find('.modal-body #id').val(cat_id);

        if (genero === "M") {
            modal.find(".modal-body #sexo1E").prop("checked", true);
        }

        if (genero === "F") {
            modal.find(".modal-body #sexo2E").prop("checked", true);
        }
        if (imagen!==null){
            modal.find(".modal-body #previewImagenEditar").attr("src","/clientes_imagenes/"+imagen);
            console.log("imagen"+imagen);
        }else{
            modal.find(".modal-body #previewImagenEditar").attr("src",null);
        }
    });


</script>
<script>
    $('#editarDocente').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var nombre = button.data('mynombre');
        var fecha_nacimiento = button.data('myfecha_nacimiento');
        var nempleado = button.data('mynumero');
        var fecha = button.data('myfecha');
        var profesion = button.data('myprofesion');
        var telefono = button.data('mytelefono');
        var cat_id = button.data('catid');
        var genero = button.data("sexo");
        var imagen =button.data("imagen");
        var modal = $(this);

        modal.find('.modal-body #nombre').val(nombre);
        modal.find('.modal-body #fecha_nacimiento').val(fecha_nacimiento);
        modal.find('.modal-body #identificacion').val(nempleado);
        modal.find('.modal-body #fecha_de_ingreso').val(fecha);
        modal.find('.modal-body #profesion_u_oficio').val(profesion);
        modal.find('.modal-body #telefono').val(telefono);
        modal.find('.modal-body #id').val(cat_id);

        if (genero === "M") {
            modal.find(".modal-body #sexo1D").prop("checked", true);
        }

        if (genero === "F") {
            modal.find(".modal-body #sexo2D").prop("checked", true);
        }
        if (imagen!==null){
            modal.find(".modal-body #previewImagenEditar").attr("src","/clientes_imagenes/"+imagen);
            console.log("imagen"+imagen);
        }else{
            modal.find(".modal-body #previewImagenEditar").attr("src",null);
        }

    });


</script>
<script>
    $('#editarParticular').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var nombre = button.data('mynombre');
        var fecha_nacimiento = button.data('myfecha_nacimiento');
        var nidentidad = button.data('myidentidad');
        var fecha = button.data('myfecha');
        var profesion = button.data('myprofesion');
        var telefono = button.data('mytelefono');
        var id = button.data('id');
        var genero = button.data("sexo");
        var imagen =button.data("imagen");
        var modal = $(this);

        modal.find('.modal-body #nombre').val(nombre);
        modal.find('.modal-body #fecha_nacimiento').val(fecha_nacimiento);
        modal.find('.modal-body #identificacion').val(nidentidad);
        modal.find('.modal-body #fecha_de_ingreso').val(fecha);
        modal.find('.modal-body #profesion_u_oficio').val(profesion);
        modal.find('.modal-body #telefono').val(telefono);
        modal.find('.modal-body #id').val(id);

        if (genero === "M") {
            modal.find(".modal-body #sexo1P").prop("checked", true);
        }

        if (genero === "F") {
            modal.find(".modal-body #sexo2P").prop("checked", true);
        }
        if (imagen!==null){
            modal.find(".modal-body #previewImagenEditar").attr("src","/clientes_imagenes/"+imagen);
            console.log("imagen"+imagen);
        }else{
            modal.find(".modal-body #previewImagenEditar").attr("src",null);
        }
    });


    $(".solo-letras").keydown(function (e) {

            var key = e.keyCode;

            if (!((key == 8) || (key == 32) || (key == 46) ||(key==9)|| (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
                e.preventDefault();
            }

    });

</script>


<script>
    $('#editarPagoEstudiante').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var mes = button.data('mymes');
        var fecha_pago = button.data('myfecha');
        var nota = button.data('mynota');
        var cat_id = button.data('catid');
        var modal = $(this);

        const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
            "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
        ];


        const partesfecha = fecha_pago.split("-");
        const d = new Date(partesfecha[0], partesfecha[1] - 1, partesfecha[2]);
        modal.find('.modal-body #mes').val(monthNames[d.getMonth()]);

        modal.find('.modal-body #fecha_pago').on("change", function () {
            const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
            ];


            var valorfecha = $(this).val();
            const partesfecha = valorfecha.split("-");
            const d = new Date(partesfecha[0], partesfecha[1] - 1, partesfecha[2]);
            modal.find('.modal-body #mes').val(monthNames[d.getMonth()]);

        });

        modal.find('.modal-body #nota').val(nota);
        modal.find('.modal-body #fecha_pago').val(fecha_pago);
        modal.find('.modal-body #id').val(cat_id);


    });

</script>

<script>
    $('#modalBorrarEstudiante').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id');
            var nombre =button.data("nombre");
        var modal = $(this);

        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #nombreBorrar').text(nombre);

    });

    $('#modalBorrarDocente').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id');
        var nombre =button.data("nombre");
        var modal = $(this);

        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #nombreBorrar').text(nombre);
    });

    $('#modalBorrarParticular').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id');
        var nombre =button.data("nombre");
        var modal = $(this);

        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #nombreBorrar').text(nombre);
    });

    $('#modalBorrarGrasa').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id');
        var id_cliente =button.data("id_cliente")
        var modal = $(this);

        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #id_cliente').val(id_cliente);

    });

    $('#modalBorrarImc').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id');
        var id_cliente =button.data("id_cliente")
        var modal = $(this);

        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #id_cliente').val(id_cliente);

    });

    $('#modalBorrarRuffier').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id');
        var id_cliente =button.data("id_cliente")
        var modal = $(this);

        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #id_cliente').val(id_cliente);

    });
    $('#modalBorrarPagoEstudiante').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id');
        var id_cliente =button.data("id_cliente")
        var modal = $(this);

        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #id_cliente').val(id_cliente);

    });

    $('#modalBorrarPagoParticular').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id');
        var id_cliente =button.data("id_cliente")
        var modal = $(this);

        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #id_cliente').val(id_cliente);

    });

    $('#modalBorrarPago').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id');
        var id_cliente =button.data("id_cliente")
        var modal = $(this);

        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #id_cliente').val(id_cliente);

    });


    $('#editarPagoParticular').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var mes = button.data('mymes');
        var fecha_pago = button.data('myfecha');
        var nota = button.data('mynota');
        var cat_id = button.data('catid');
        var modal = $(this);

        const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
            "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
        ];


        const partesfecha = fecha_pago.split("-");
        const d = new Date(partesfecha[0], partesfecha[1] - 1, partesfecha[2]);
        modal.find('.modal-body #mes').val(monthNames[d.getMonth()]);

        modal.find('.modal-body #fecha_pago').on("change", function () {
            const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
            ];

            var valorfecha = $(this).val();
            const partesfecha = valorfecha.split("-");
            const d = new Date(partesfecha[0], partesfecha[1] - 1, partesfecha[2]);
            modal.find('.modal-body #mes').val(monthNames[d.getMonth()]);

        });

        modal.find('.modal-body #mes').val(mes);
        modal.find('.modal-body #fecha_pago').val(fecha_pago);
        modal.find('.modal-body #nota').val(nota);
        modal.find('.modal-body #id').val(cat_id);


    });

    $("#fecha").on("change", function () {
        const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
            "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
        ];


        var valorfecha = $(this).val();
        const partesfecha = valorfecha.split("-");
        const d = new Date(partesfecha[0], partesfecha[1] - 1, partesfecha[2]);
        $("#mes").val(monthNames[d.getMonth()]);

    });

    $('#modalRecuperar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var correo = button.data('correo');
        var modal = $(this);

        modal.find('.modal-body #email').val(correo);
        modal.find(".modal-body #correoInfo").text(correo);
    });


</script>


</body>

</html>
