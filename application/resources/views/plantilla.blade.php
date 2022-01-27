<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('Titulo')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
    
    <!--Todas las vistas que extiendan de esta plantilla
    tendran el estilo asignado-->
    <style>

        h1{
            color: blue;
        }
        p{
            color: green;
        }
    </style>
</head>
<body>
    @yield('contenido')

    
</body>
</html>