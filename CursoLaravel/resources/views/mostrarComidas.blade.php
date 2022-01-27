<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="DirectoryPlus template project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/styles/bootstrap-4.1.2/bootstrap.min.css">
    <link href="/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="/plugins/OwlCarousel2-2.3.4/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="/plugins/OwlCarousel2-2.3.4/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="/plugins/OwlCarousel2-2.3.4/animate.css">
    <link rel="stylesheet" type="text/css" href="/styles/main_styles.css">
    <link rel="stylesheet" type="text/css" href="/styles/responsive.css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="card-header">
        <h4>Comidas</h4>
    </div>
    <div class="card-body">
        <button class="btn btn-danger" data-target="#modalAgregar"
                data-toggle="modal">Agregar Comida
        </button>

        <form action="{{route("buscar")}}" method="GET">
            <input name="busqueda" placeholder="Buscar..." class="form-control"   style="margin: 50px; width: 350px">

            <button class="btn btn-warning" type="submit">Buscar</button>
        </form>

    </div>
</div>

@if(session("exito"))
    <div class="alert alert-success" role="alert">
        {{session("exito")}}
    </div>
@endif



<div class="table-responsive">
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th>Nombre</th>
            <th>Sabor</th>
            <th>Precio</th>


        </tr>
        </thead>
        <tbody>
        @foreach($comidas as $comida)
            <tr>
                <th>{{$comida->id}}</th>
                <th>{{$comida->nombre}}</th>
                <th>{{$comida->sabor}}</th>
                @if($comida->precio>50)
                    <th style="color: #2fa360">{{$comida->precio}}
                        <button class="btn btn-danger"  data-toggle="modal"  data-id="{{$comida->id}}" data-target="#modalEliminar"><span><i class="fa fa-trash"></i></span></button>
                    </th>

                @else
                    <th style="color: #bb0003">{{$comida->precio}}
                        <button class="btn btn-danger" data-toggle="modal"  data-id="{{$comida->id}}" data-target="#modalEliminar"><span><i class="fa fa-trash"></i></span></button>
                    </th>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>


<div id="modalEliminar" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Advertencia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route("borrar")}}" method="GET">
                <div class="modal-body">

                <h4>¿Estas seguro que deseas eliminar esta comida?</h4>

                </div>
                <div class="modal-footer">
                    <input id="input_id" type="hidden" name="id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Borrar</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div id="modalAgregar" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route("nueva_comida")}}" method="GET">
                <div class="modal-body">

                    <input name="nombre" placeholder="Ingrese el nombre" required>
                    <input name="sabor" placeholder="Ingrese el sabor" required>
                    <input name="precio" placeholder="Ingrese el precio" required>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="/js/jquery-3.3.1.min.js"></script>
<script src="/styles/bootstrap-4.1.2/popper.js"></script>
<script src="/styles/bootstrap-4.1.2/bootstrap.min.js"></script>
<script src="/plugins/greensock/TweenMax.min.js"></script>
<script src="/plugins/greensock/TimelineMax.min.js"></script>
<script src="/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="/plugins/greensock/animation.gsap.min.js"></script>
<script src="/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="/plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="/plugins/OwlCarousel2-2.3.4/owl.carousel.js"></script>
<script src="/plugins/easing/easing.js"></script>
<script src="/plugins/progressbar/progressbar.min.js"></script>
<script src="/plugins/parallax-js-master/parallax.min.js"></script>
<script src="/js/custom.js"></script>

<script>
    $('#modalEliminar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var modal = $(this);

        var id = button.data("id");

        modal.find('.modal-footer #input_id').val(id)

    });


</script>
</body>
</html>
