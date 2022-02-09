<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UserController;
use App\Models\Equipo;
use App\Models\Zona;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;


class RegistroController extends Controller
{
    public function index()
    {
        
        $equipos=Equipo::all();
        $zonas=Zona::all();
        return view('auth.register', compact('equipos','zonas'));

    }

    public function create()
    {
        $user = new User();

        $user->username=request('username');
        $user->nombre=request('nombre');
        $user->apellidos=request('apellidos');
        $user->email=request('email');
        $user->password=Hash::make(request('password'));
        $user->rol=request('rol');
        $user->equipo_id = auth()->user()->id;

        $user->save();
    }

    public function store()
    {
        //
    }

    public function show()
    {
       //
    }

    public function edit()
    {
        //
    }

    public function update()
    {
        //
    }

    public function destroy()
    {
        //
    }
}
