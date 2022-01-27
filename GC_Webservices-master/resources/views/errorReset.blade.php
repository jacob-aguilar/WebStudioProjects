@extends('layouts.app')
@section('content')
    <!-- Codigo para alertar si la contrase;a de inicio de sesion esta mal -->
    <div class="nav side-menu">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        ¡Atención!
                    </div>

                    <div class="panel-body">
                        <h1>{{$json}}</h1>
                    </div>
                    <div class="panel-footer">
                        <a type="button" class="btn btn-primary" href="/login"
                           title="Iniciar Sesión"><span style="padding-right: 10px" class="fa fa-sign-in"></span>Inicia Sesión</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection