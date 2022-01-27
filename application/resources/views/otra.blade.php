@extends('plantilla')

@section('contenido')
    <h1> Lista de Nombres</h1>
    @isset($nombres)
        <p>Si existe el arreglo</p>
        <ul>
        @foreach($nombres as $nombre)
            <li>{{ $nombre }}</li>

        @endforeach
        </ul>
    

    <h1>Lista de nombres con forelse</h1>

    @forelse($nombres as $nombre)
    
        @if($loop -> first)
            <ul>
        @endif

        @if($loop -> last)
            </ul>
        @endif
        <li> {{ $nombre }}</li>

    @empty
        <h2>No hay nada</h2>
    @endforelse



    <h1> Lista de numeros desde {{ $i = 0}}</h1>
    <ul>
    @while($i < 11)
        <li> {{ $i++ }}</li>
    @endwhile
    </ul>



    <h1>Lista de Numeros con for</h1>
    <ul>
    @for($i = 0; $i < 11; $i++)
    <li> {{ $i }}</li>
    @endfor
    </ul>


    <h1>Uso de each</h1>
    <ul>
    @each('nombre', $nombres, 'nombre')
    </ul>
    @endisset
@endsection