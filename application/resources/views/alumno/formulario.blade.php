@extends ('layouts.app')
@section('content')
<div class="container">

@if($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif


  <form method="post" action="{{route('alumno.guardar')}}">
      @csrf
    <div class="row">
      <div class="col">
        <div class="form-group">
         <input type="text" class="form-control" placeholder="Nombres" name="nombres">
        </div>
      </div>
    <div class="col">
          <div class="form-group">
        <input type="text" class="form-control" placeholder="Apellidos" name="apellidos">
      </div>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <div class="form-group">
        <input type="number" class="form-control" placeholder="Numero de Cuenta" name="cuenta">
        </div>
      </div>

      <div class="col">
        <div class="form-group">
        <input type="email" class="form-control" placeholder="Correo Electronico" name="correo">
        </div>
      </div>


      <div class="col">
        <div class="form-group">
        <input type="number" class="form-control" placeholder="Identidad" name="identidad">
        </div>
      </div>
      </div>


      <div class="row">
         <div class="col">
            <div class="form-group">
            <input type="date"  name="fecha_nacimiento" placeholder="01-01-2019"> 
            </div>
         </div>

       <div class="col">
         <div class="form-group">
              <input type="number"  name="deuda" placeholder="Monto de Deuda"> 
        </div>      
       </div>

        <div class="col">
          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="activo" name="activo">
            <label class="form-check-label" for="gridCheck">
            Activo
            </label>
            </div>
          </div>
        </div>
      </div>

      <div class="row">

        <div class="col-3">
            <label class="my-1 mr-2" for="generoInput">Genero</label>
            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="genero">
                <option selected>Escoja...</option>
                <option value="1">Femenino</option>
                <option value="2">Masculino</option>
            </select>
        </div>

      <div class="col">

        <div class="form-group">
              <input type="text"  name="foto" placeholder="URL de la foto"> 
        </div> 
      </div> 

     </div>
      <div class="row">
        <button type="submit" class="btn btn-primary mb-2">Enviar</button>
      </div>
  </form>
</div>
@endsection