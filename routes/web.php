<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\ManualController;
use App\Http\Controllers\AscensorController;
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

Route::get('/home', [App\Http\Controllers\UserController::class, 'home'])->name('home');

Route::get('/manuales',[ManualController::class, 'index'])->name('manuales.index');
Route::get('/manuales/buscar',[ManualController::class, 'filtrarNombre'])->name('manuales.filtrarNombre');



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
Route::get('/incidencias/create',[IncidenciaController::class, 'create'])->name('incidencia.create');

Route::post('/incidencias/create',[IncidenciaController::class, 'store'])->name('incidencia.store');
Route::get('/incidencias/{id}',[IncidenciaController::class, 'show'])->name('incidencias.show');
Route::put('/incidencias/{id}',[IncidenciaController::class, 'update'])->name('incidencias.update');

Route::get('/incidencias/create/direccion',[IncidenciaController::class, 'firltarAscensores'])->name('webservice.ascensores');




