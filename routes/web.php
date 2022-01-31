<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\FiltrosController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/mail/{mail}/{contenido}/', [App\Http\Controllers\MailControler::class, 'sendEmailIncidencia', ]);

/*Route::get('/form', function ()
{
    return view('formularios.formularioOperador');
});
*/
Route::get('/user', function ()
{
    return view('formularios.formularioNuevoUser');
});


Route::get('/incidencia',[IncidenciaController::class, 'index'])->name('incidencia.index');

Route::post('/incidencia',[IncidenciaController::class, 'store'])->name('incidencia.store');

Route::get('/filtros',[FiltrosController::class, 'index'])->name('filtros.index');

Route::get('/filtros/{id}',[FiltrosController::class, 'show'])->name('filtros.show');
