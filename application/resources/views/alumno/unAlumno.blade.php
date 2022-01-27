@extends ('layouts.app')
@section('content')
	<div class="container">
   <div class="row">
   <div class="col-3 offset-4">
    <div class="card" style="width: 18rem;">
  <img class="card-img-top" src="{{ $alumno->foto}}" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">{{$alumno->cuenta}}</h5>
    <p class="card-text">{{$alumno->nombres ." ".$alumno->apellidos}}</p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><strong>Correo: </strong>{{$alumno->correo}}</li>
    <li class="list-group-item"><strong>Nacio: </strong>{{$alumno->fecha_nacimiento}}</li>
    <li class="list-group-item"><strong>ID: </strong>{{$alumno->identidad}}</li>
  </ul>
  <div class="card-body">
    <a href="#" class="card-link">Editar</a>
    <a href="#" class="card-link btn-danger">Borrar</a>
  </div>
  </div>
</div>
</div>
  </div>
@endsection