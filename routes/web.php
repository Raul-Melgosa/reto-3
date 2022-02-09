<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\ManualController;
use App\Http\Controllers\AscensorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('home'));
});
Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();
Route::post('/registro', [RegistroController::class, 'create'])->name('crearUsuario');
Route::get('/registro', [RegistroController::class, 'index'])->name('registro');

Route::get('/home', [UserController::class, 'home'])->name('home');
Route::put('/users/update',[UserController::class, 'cambiarRol'])->name('users.cambiarrol');

Route::get('/manuales',[ManualController::class, 'index'])->name('manuales.index');
Route::get('/manuales/buscar',[ManualController::class, 'filtrarNombre'])->name('manuales.filtrarNombre');




Route::get('/estadisticas', [App\Http\Controllers\EstadisticasController::class, 'index'])->name('estadisticas.index');
//Rutas webservice-datos-estadisticas
Route::get('/estadisticas/numIncidenciasPorZona', [App\Http\Controllers\EstadisticasController::class, 'numIncidenciasPorZona']);
Route::get('/estadisticas/numTipoIncidenciasPorZona', [App\Http\Controllers\EstadisticasController::class, 'numTipoIncidenciasPorZona']);
Route::get('/estadisticas/numIncidenciasPorModelo', [App\Http\Controllers\EstadisticasController::class, 'numIncidenciasPorModelo']);
Route::get('/estadisticas/numIncidenciasPorModeloId', [App\Http\Controllers\EstadisticasController::class, 'numIncidenciasPorModeloId']);
Route::get('/estadisticas/tiempoMedioIncidenciaEquipo', [App\Http\Controllers\EstadisticasController::class, 'tiempoMedioIncidenciaEquipo']);
Route::get('/estadisticas/tiempoMedioIncidenciaTecnico', [App\Http\Controllers\EstadisticasController::class, 'tiempoMedioIncidenciaTecnico']);
Route::get('/estadisticas/tipoDeIncidenciasPorZona', [App\Http\Controllers\EstadisticasController::class, 'tipoDeIncidenciasPorZona']);
Route::get('/estadisticas/tipoDeIncidenciasPorZonaId', [App\Http\Controllers\EstadisticasController::class, 'tipoDeIncidenciasPorZonaId']);
Route::get('/estadisticas/getZonas', [App\Http\Controllers\EstadisticasController::class, 'getZonas']);
Route::get('/estadisticas/getTecnicos', [App\Http\Controllers\EstadisticasController::class, 'getTecnicos']);
Route::get('/estadisticas/getModelos', [App\Http\Controllers\EstadisticasController::class, 'getModelos']);
Route::get('/estadisticas/getEquipos', [App\Http\Controllers\EstadisticasController::class, 'getEquipos']);



//Ejemplo almacenamiento
Route::get('/manuales/create', [App\Http\Controllers\StorageController::class, 'index'])->name('manuales.create');
Route::post('/manuales/store', [App\Http\Controllers\StorageController::class, 'store'])->name('manuales.store');
Route::get('/manuales/{archivo}', function ($archivo) {
    $public_path = public_path();
    $url = $public_path.'/storage/manuales/'.$archivo;
    //verificamos si el archivo existe y lo retornamos
    if (Storage::exists('/manuales/'.$archivo))
    {
      return response()->download($url);
    }else{
        //si no se encuentra lanzamos un error 404.
        abort(404);
    }
});
Route::get('/manuales/delete/{archivo}', [App\Http\Controllers\StorageController::class, 'destroy'])->name('manuales.destroy');


//Ejemplo envio mail
//Route::get('/mail/{mail}/{contenido}/', [App\Http\Controllers\MailControler::class, 'sendEmailIncidencia', ]);

/*Route::get('/form', function ()
{
    return view('formularios.formularioOperador');
});
*/

Route::get('/incidencias',[IncidenciaController::class, 'index'])->name('incidencias.index');
Route::get('/incidencias/filtrar',[IncidenciaController::class, 'filtrar'])->name('incidencias.filtro');
Route::get('/incidencias/create',[IncidenciaController::class, 'create'])->name('incidencia.create');

Route::post('/incidencias/create',[IncidenciaController::class, 'store'])->name('incidencia.store');
Route::get('/incidencias/{id}',[IncidenciaController::class, 'show'])->name('incidencias.show');
Route::put('/incidencias/{id}',[IncidenciaController::class, 'update'])->name('incidencias.update');

Route::get('/incidencias/create/direccion',[IncidenciaController::class, 'firltarAscensores'])->name('webservice.ascensores');
Route::get('/manuales',[ManualController::class, 'index'])->name('manual.index');

