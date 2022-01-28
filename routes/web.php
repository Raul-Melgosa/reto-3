<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
