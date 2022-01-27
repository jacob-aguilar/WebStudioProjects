@extends ('layouts.app')
@section('content')

<div class="container">
<h1>Alumnos <a href="{{route('alumno.crear')}}"></a> <span class="badge-secondary">Nuevo</span></h1>
  @isset ($mensaje)
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Alumno creado</strong> El alumno fue creado correctamente
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  
  @endisset
  
 <table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Cuenta</th>
      <th scope="col">Nombre Completo</th>
      <th scope="col">Deuda</th>
      <th scope="col">Ver</th>
      <th scope="col">Eliminar</th>

    </tr>
  </thead>
  <tbody>
  @foreach($alumnos as $alumno)
    <tr>
      <td scope="row">{{$alumno->cuenta}}</td>
      <td>{{ $alumno->nombres ." ".$alumno->apellidos }}</td>
      <td>{{ $alumno->deuda }}</td>
      <td><a href="{{ route('alumno.ver', ['id'=>$alumno->id]) }}">Ver</a></td>
      <td>
        <form action="{{route('alumno.eliminar', ['id', $alumno->id])}}" method="post">
          @csrf
          @method('delete')
          <button type="submit" class="btn btn-danger">Eliminar</button> 
        </form>
      </td>
    </tr>
    @endforeach
    </tbody>

</table>
<!---->
	 {{ $alumnos->links()}}
  </div>

@endsection