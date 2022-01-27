@extends('plantilla')

@isset($num)
    
    <h1>Tabla del numero {{ $num }}</h1>

    <table border="solid">
        <tr>
            <td>Operacion</td>
            <td>Resultado</td>
        </tr>
       
        @for($i = 1; $i < 11; $i++)
            <tr>
            <td> {{ $i }} x {{ $num }} </td>
            <td> {{ $i * $num }} </td>
            </tr>
        @endfor        
    </table>


    <h1>Tabla del numero {{ $num }} sin division</h1>
    <table border="solid" style="align_parentm: center">
        <tr>
            <td>Operacion</td>
            <td>Resultado</td>
        </tr>

        <tr>
        <td>
        @for($i = 1; $i < 11; $i++)
            
             {{ $i }} x {{ $num }} <br>
            
        @endfor
        </td>
        
        <td>        
        @for($i = 1; $i < 11; $i++)
        
             {{ $i * $num }} <br>
            
        @endfor
        </td>
        </tr>

        
    </table>

@endisset