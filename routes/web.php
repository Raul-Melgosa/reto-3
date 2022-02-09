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
Route::post('/registro', [RegistroController::class, 'create'])->name('crearUsuario')->middleware('auth');
Route::get('/registro', [RegistroController::class, 'index'])->name('registro')->middleware('auth');

Route::get('/home', [UserController::class, 'home'])->name('home')->middleware('auth');
Route::put('/users/update',[UserController::class, 'cambiarRol'])->name('users.cambiarrol');

Route::get('/manuales',[ManualController::class, 'index'])->name('manuales.index')->middleware('auth');
Route::get('/manuales/buscar',[ManualController::class, 'filtrarNombre'])->name('manuales.filtrarNombre')->middleware('auth');




Route::get('/estadisticas', [App\Http\Controllers\EstadisticasController::class, 'index'])->name('estadisticas.index');
//Rutas webservice-datos-estadisticas
Route::get('/estadisticas/numIncidenciasPorZona', [App\Http\Controllers\EstadisticasController::class, 'numIncidenciasPorZona'])->middleware('auth');
Route::get('/estadisticas/numTipoIncidenciasPorZona', [App\Http\Controllers\EstadisticasController::class, 'numTipoIncidenciasPorZona'])->middleware('auth');
Route::get('/estadisticas/numIncidenciasPorModelo', [App\Http\Controllers\EstadisticasController::class, 'numIncidenciasPorModelo'])->middleware('auth');
Route::get('/estadisticas/numIncidenciasPorModeloId', [App\Http\Controllers\EstadisticasController::class, 'numIncidenciasPorModeloId'])->middleware('auth');
Route::get('/estadisticas/tiempoMedioIncidenciaEquipo', [App\Http\Controllers\EstadisticasController::class, 'tiempoMedioIncidenciaEquipo'])->middleware('auth');
Route::get('/estadisticas/tiempoMedioIncidenciaTecnico', [App\Http\Controllers\EstadisticasController::class, 'tiempoMedioIncidenciaTecnico'])->middleware('auth');
Route::get('/estadisticas/tipoDeIncidenciasPorZona', [App\Http\Controllers\EstadisticasController::class, 'tipoDeIncidenciasPorZona'])->middleware('auth');
Route::get('/estadisticas/tipoDeIncidenciasPorZonaId', [App\Http\Controllers\EstadisticasController::class, 'tipoDeIncidenciasPorZonaId'])->middleware('auth');
Route::get('/estadisticas/getZonas', [App\Http\Controllers\EstadisticasController::class, 'getZonas'])->middleware('auth');
Route::get('/estadisticas/getTecnicos', [App\Http\Controllers\EstadisticasController::class, 'getTecnicos'])->middleware('auth');
Route::get('/estadisticas/getModelos', [App\Http\Controllers\EstadisticasController::class, 'getModelos'])->middleware('auth');
Route::get('/estadisticas/getEquipos', [App\Http\Controllers\EstadisticasController::class, 'getEquipos'])->middleware('auth');



//Ejemplo almacenamiento
Route::get('/manuales/create', [App\Http\Controllers\StorageController::class, 'index'])->name('manuales.create')->middleware('auth');
Route::post('/manuales/store', [App\Http\Controllers\StorageController::class, 'store'])->name('manuales.store')->middleware('auth');
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
})->middleware('auth');
Route::get('/manuales/delete/{archivo}', [App\Http\Controllers\StorageController::class, 'destroy'])->name('manuales.destroy')->middleware('auth');


//Ejemplo envio mail
//Route::get('/mail/{mail}/{contenido}/', [App\Http\Controllers\MailControler::class, 'sendEmailIncidencia', ]);

/*Route::get('/form', function ()
{
    return view('formularios.formularioOperador');
});
*/

Route::get('/incidencias',[IncidenciaController::class, 'index'])->name('incidencias.index')->middleware('auth');
Route::get('/incidencias/filtrar',[IncidenciaController::class, 'filtrar'])->name('incidencias.filtro')->middleware('auth');
Route::get('/incidencias/create',[IncidenciaController::class, 'create'])->name('incidencia.create')->middleware('auth');

Route::post('/incidencias/create',[IncidenciaController::class, 'store'])->name('incidencia.store')->middleware('auth');
Route::get('/incidencias/{id}',[IncidenciaController::class, 'show'])->name('incidencias.show')->middleware('auth');
Route::put('/incidencias/{id}',[IncidenciaController::class, 'update'])->name('incidencias.update')->middleware('auth');

Route::get('/incidencias/create/direccion',[IncidenciaController::class, 'firltarAscensores'])->name('webservice.ascensores')->middleware('auth');
Route::get('/manuales',[ManualController::class, 'index'])->name('manual.index')->middleware('auth');

