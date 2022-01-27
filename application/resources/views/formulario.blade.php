@extends('plantilla')

@section('contenido')
    <h1>Sumar dos numeros</h1>


    @if($errors -> any())
        <div class="alert alert-danger">
        <ul>
         @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
        </div>
    @endif

    <form action="/suma" method="post">
        @csrf
        <input type="text" name="n1" placeholder="Primer Numero">
        <input type="text" name="n2" placeholder="Segundo Numero">
        <input type="submit" value="enviar">
    
    </form>

@endsection