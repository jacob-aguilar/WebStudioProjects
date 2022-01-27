<?php

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// estas rutas se pueden acceder sin proveer de un token válido.

Route::post('loguear', 'LoginController@login');// cuando el usuario ya esta registrado.
Route::post('registrar', 'LoginController@register');// cuando el usuario entra por primera vez.
Route::post('ingresarFormulario', 'LoginController@ingresarFormulario');// cuando el usuario entra por primera vez.
Route::post('obtenerUsuario','LoginController@obtenerUsuario');



// estas rutas requiren de un token válido para poder accederse.
Route::group(['middleware' => 'jwt.auth'], function () {

    Route::post('logout', 'LoginController@logout'); 
    Route::post('getCurrentUser', 'LoginController@getAuthUser');
   


});



//rutas brasly
Route::resource('datos_login','LoginController');
Route::post('actualizar_contrasena','LoginController@actualizarContrasena');
Route::post('actualizar_cuenta','LoginController@actualizarCuenta');
Route::resource('pacientes','PacienteController');
Route::resource('pacientes_antecedentes_familiares','PacientesAntecedentesFamiliaresController');
Route::resource('pacientes_antecedentes_personales','PacientesAntecedentesPersonalesController');
Route::resource('pacientes_habitos_toxicologicos','PacientesHabitosToxicologicosController');
Route::resource('p_hospitalarias_quirurgicas','PacientesHospitalariasQuirurgicasController');
Route::resource('enfermedades','EnfermedadesController');
Route::resource('telefonos_emergencia','TelefonosEmergenciaController');
Route::resource('telefonos_pacientes','TelefonosPacientesController');



Route::get('columna_enfermedades/{id_grupo_enfermedad}','EnfermedadesController@obtenerColumnaEnfermedad');
Route::get('columna_habito_toxicologico','HabitosToxicologicosController@obtenerColumnaHabitoToxicologico');
Route::get('obtenerColumnaNumeroTelefono/{telefono}','PacienteController@obtenerColumnaNumeroTelefono');
Route::resource('habitos_toxicologicos','HabitosToxicologicosController');
Route::get('obtenerAdministrador/{id}','AdministradorController@obtenerAdministrador');
Route::post('obtenerPaciente','PacienteController@obtenerPaciente');
Route::get('obtenerMedico/{id}','MedicosController@obtenerMedico');
Route::post('verificarClave','LoginController@verificarClave');
Route::post('duplicarRegistro','LoginController@duplicarRegistro');
Route::get('obtenerIdLoginMedico/{medico}','LoginController@obtenerIdLoginMedico');
Route::get('obtenerUsuarioConCorreo/{correo}','LoginController@obtenerUsuarioConCorreo');
//Route::get('obtenerUsuarioConId/{correo}','LoginController@obtenerUsuarioConId');
Route::post('contactar', 'LoginController@contact');
Route::post('mandarIdAView', 'LoginController@mandarIdAView');
Route::get('obtenerIdLogin/{cuenta}','LoginController@obtenerIdLogin');


//obtener datos de los grupos de enfermedades Antecedentes Familiares
Route::get('obtenerdesnutricionAF/{id}','PacientesAntecedentesFamiliaresController@obtenerdesnutricionAF');
Route::get('obtenermentalesAF/{id}','PacientesAntecedentesFamiliaresController@obtenermentalesAF');
Route::get('obteneralergiasAF/{id}','PacientesAntecedentesFamiliaresController@obteneralergiasAF');
Route::get('obtenercanceresAF/{id}','PacientesAntecedentesFamiliaresController@obtenercanceresAF');
Route::get('obtenerotrosAF/{id}','PacientesAntecedentesFamiliaresController@obtenerotrosAF');

//obtener datos de los grupos de enfermedades Antecedentes Personal
Route::get('obtenerdesnutricionAP/{id}','PacientesAntecedentesPersonalesController@obtenerdesnutricionAP');
Route::get('obtenermentalesAP/{id}','PacientesAntecedentesPersonalesController@obtenermentalesAP');
Route::get('obteneralergiasAP/{id}','PacientesAntecedentesPersonalesController@obteneralergiasAP');
Route::get('obtenercanceresAP/{id}','PacientesAntecedentesPersonalesController@obtenercanceresAP');
Route::get('obtenerotrosAP/{id}','PacientesAntecedentesPersonalesController@obtenerotrosAP');
Route::get('obtenerhospitalarias_quirurgicas/{id}','PacientesHospitalariasQuirurgicasController@obtenerhospitalarias_quirurgicas');

//obtener una enfermedad en especifico para editarla
Route::get('obtenerUnadesnutricionAP/{id}','PacientesAntecedentesPersonalesController@obtenerUnadesnutricionAP');
Route::get('obtenerUnamentalesAP/{id}','PacientesAntecedentesPersonalesController@obtenerUnamentalesAP');
Route::get('obtenerUnaalergiasAP/{id}','PacientesAntecedentesPersonalesController@obtenerUnaalergiasAP');
Route::get('obtenerUnacanceresAP/{id}','PacientesAntecedentesPersonalesController@obtenerUnacanceresAP');
Route::get('obtenerUnaotrosAP/{id}','PacientesAntecedentesPersonalesController@obtenerUnaotrosAP');
Route::get('obtenerUnahospitalaria_quirurgica/{id}','PacientesHospitalariasQuirurgicasController@obtenerUnahospitalaria_quirurgica');

//obtener unhabito para editar
Route::get('obtenerUnhabito/{id}','PacientesHabitosToxicologicosController@obtenerUnhabito');





Route::resource('parentescos','ParentescosController');
Route::resource('estados_civiles','EstadosCivilesController');
Route::resource('seguros_medicos','SegurosMedicosController');
Route::resource('practicas_sexuales','PracticasSexualesController');
Route::resource('metodos_planificaciones','MetodosPlanificacionesController');


Route::get('ultimoIdAntecedente','AntecedentesController@obtenerUltimoIdAntecedente');
Route::get('ultimoIdLogin','LoginController@ultimoIdLogin');





Route::resource('actividad_sexual','ActividadSexualController');
Route::resource('antecedentes_ginecologicos','AntecedentesGinecologicosController');
Route::resource('planificaciones_familiares','PlanificacionesFamiliaresController');
Route::resource('antecedentes_obstetricos','AntecedentesObstetricosController');


Route::resource('citas','CitasController');
Route::get('citas_vigentes/{id_paciente}','CitasController@citasVigentes');
Route::get('contarPacientes','PacienteController@contarPacientes');

//graficas
Route::get('pesosPaciente/{id_paciente}','HistoriasSubsiguientesController@pesosPaciente');
Route::get('todosPesosPaciente/{id_paciente}','HistoriasSubsiguientesController@todosPesosPaciente');

Route::get('pulsosPaciente/{id_paciente}','HistoriasSubsiguientesController@pulsosPaciente');
Route::get('todosPulsosPaciente/{id_paciente}','HistoriasSubsiguientesController@todosPulsosPaciente');

Route::get('alturasPaciente/{id_paciente}','HistoriasSubsiguientesController@alturasPaciente');
Route::get('todasAlturasPaciente/{id_paciente}','HistoriasSubsiguientesController@todasAlturasPaciente');

Route::get('temperaturasPaciente/{id_paciente}','HistoriasSubsiguientesController@temperaturasPaciente');
Route::get('todasTemperaturasPaciente/{id_paciente}','HistoriasSubsiguientesController@todasTemperaturasPaciente');

Route::get('presionesPaciente/{id_paciente}','HistoriasSubsiguientesController@presionesPaciente');
Route::get('todasPresionesPaciente/{id_paciente}','HistoriasSubsiguientesController@todasPresionesPaciente');













//rutas melvin
Route::get('obtenerColumnaUsuarioAdmin/{usuario}','AdministradorController@obtenerColumnaUsuarioAdmin');
Route::resource('administradores','AdministradorController');
Route::resource('medicos','MedicosController');


//rutas alberto
Route::resource('inventarios','InventarioController');
Route::get('medicamentos','InventarioController@obtenerMedicamentos');
Route::post('medicamentos/egreso','InventarioController@disminucion');
Route::get('obtenerColumnaUsuarioMedicos/{usuario}','MedicosController@obtenerColumnaUsuarioMedicos');
Route::get('obtenerColumnaIdentidad/{numero_identidad}','PacienteController@obtenerColumnaIdentidad');
Route::get('obtenerColumnaNumeroCuenta/{numero_cuenta}','PacienteController@obtenerColumnaNumeroCuenta');
Route::get('obtenerColumnaCorreo/{correo_electronico}','PacienteController@obtenerColumnaCorreo');




















//rutas marvin
Route::get('pacientes/ultimo/si','PacienteController@ultimoID');
Route::resource('historias_subsiguientes','HistoriasSubsiguientesController');
Route::post('pacientes/actualizarImagen','PacienteController@actualizarfoto');
Route::get('cantidadPacientesTotal','PacienteController@cantidad');
Route::get('cantidadHistoriasTotal','HistoriasSubsiguientesController@todasHistorias');
Route::get('citasHoy','CitasController@citasHoy');
Route::get('totalRemitidos','HistoriasSubsiguientesController@totalRemitidos');
Route::get('pacientesPorDia','HistoriasSubsiguientesController@pacientesPorDia');
Route::get('citas_fechas/{id_paciente}','CitasController@citasFechas');
Route::get('citasPorFecha/{fecha}','CitasController@citasporFecha');
Route::get('obtenerColumnaIdentidad','MedicosController@obtenerColumnaIdentidadMedico');
Route::get('obtenerColumnaIdentidadAdmin','AdministradorController@obtenerColumnaIdentidadAdmin');

































// rutas alberto





Route::resource('pacientes','PacienteController');