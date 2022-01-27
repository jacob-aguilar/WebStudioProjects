@extends('plantilla')



@section('contenido')
    
    @isset($n1, $n2)

        <P> Los numeros {{ $n1 }} y {{ $n2 }}</P>
        
        @if($n1 % $n2 == 0)
            <p> Si son divisores</p>
        @else
            <p>No son divisores</p>
        @endif
        
    @endisset
@endsection