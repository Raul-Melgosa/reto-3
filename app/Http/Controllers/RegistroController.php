<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UserController;
use App\Models\Equipo;
use App\Models\Zona;
use Illuminate\Http\Request;

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
        //
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
