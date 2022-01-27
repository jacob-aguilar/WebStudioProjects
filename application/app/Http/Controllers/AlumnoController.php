<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumno;

class AlumnoController extends Controller
{
    //Con paginate limitamos a 1 o mas filas
    //Mostrar la lista completa de los alumnos
	public function index(){
	 $alumnos = Alumno::paginate(10);
	 return view('alumno.index')->with('alumnos', $alumnos);
	}

	//Mostrar los datos completos del alumno
	public function show($id){

		$alumno = Alumno::findOrFail($id);
		return view('alumno.unAlumno')->with('alumno', $alumno);
	}

	//Devolver el formulario para crear un nuevo alumno
	public function create(){

		return view('alumno.formulario');

	}


	//Sirve oara guardar los datos de un nuevo alumno
	public function store(Request $request){

			
		//Procesar la entrada (validadiones)
		$validatedData = $request->validate([
			'nombres' => 'required',
			'apellidos' => 'required',
			'cuenta' => 'required',
			'correo' => 'required',
			'fecha_nacimiento' => 'required',
			'identidad' => 'required',
			'activo' => 'required',
			'deuda' => 'required',
			'genero' => 'required',
			'foto' => 'required'

			]);


		//Crear una nueva instancia de alumnos 
		$nuevoAlumno = new Alumno();


		//TODO Asignar los valores recibidos de enterada
		$nuevoAlumno->nombres = $validatedData['nombres'];
		$nuevoAlumno->apellidos = $validatedData['apellidos'];
		$nuevoAlumno->cuenta = $validatedData['cuenta'];
		$nuevoAlumno->correo = $validatedData['correo'];
		$nuevoAlumno->fecha_nacimiento = $validatedData['fecha_nacimiento'];
		$nuevoAlumno->identidad = $validatedData['identidad'];
		
		if ($validatedData['activo']=='on') {
			$nuevoAlumno->activo = 1;
		}else{
			$nuevoAlumno->activo = 0;
		}

		$nuevoAlumno->genero = $validatedData['genero'];
		$nuevoAlumno->deuda = $validatedData['deuda'];
		$nuevoAlumno->foto = $validatedData['foto'];


		//Guardar el alumno
		$salvado = $nuevoAlumno->save();
		

		//Redireccionar el index de alumno
		if($salvado){
				return redirect('/alumnos')->with('mensaje','Alumno guardado correctamente');
		}
		//Al escribir este if eliminamos 
		//dd($request);
	}

		public function delete($id){
			//TODO se busca el ID
			$alumno = Alumno::findOrFail($id);

			//TODO borrar
			$alumno->delete();

			//TODO redirigirlo a la lista de alumnos
			return redirect()->route('alumno.index');
		}

}
