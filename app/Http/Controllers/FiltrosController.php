<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incidencia;
use App\Models\ModeloAscensor;

class FiltrosController extends Controller
{
    public function index()
    {
        
        $incidencias=Incidencia::orderBy('urgente','DESC','created_at','DESC')->get();
        
        return view('filtros.filtrosIndex', compact('incidencias'));

    }

    public function create()
    {
        //
    }

    public function store()
    {
        //
    }

    public function show($id)
    {
        $incidencia=Incidencia::find($id);
        $modelo=ModeloAscensor::find($incidencia->ascensor->modeloAscensor_id);
        return view('filtros.detalles', compact('incidencia','modelo'));
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
