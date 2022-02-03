<?php

namespace App\Http\Controllers;

use App\Models\Ascensor;
use App\Models\Equipo;
use App\Models\Incidencia;
use App\Models\ModeloAscensor;
use Illuminate\Http\Request;
use App\Models\User;
use Mockery\Undefined;

class IncidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $incidencias=Incidencia::orderBy('urgente','DESC','created_at','DESC')->get();
        return view('incidencias.index', compact('incidencias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('incidencias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nombre=request('nombreCliente');
        $apellido=request('apellidoCliente');
        $email=request('emailCliente');
        $id_tecnico=request('tecnico');
        $tecnico=User::all()->where('id','=',$id_tecnico);
        return redirect()->route('incidencias.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Incidencia  $incidencia
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $incidencia=Incidencia::find($id);
        $modelo=ModeloAscensor::find($incidencia->ascensor->modeloAscensor_id);
        return view('incidencias.show', compact('incidencia','modelo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Incidencia  $incidencia
     * @return \Illuminate\Http\Response
     */
    public function edit(Incidencia $incidencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Incidencia  $incidencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Incidencia $incidencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Incidencia  $incidencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Incidencia $incidencia)
    {
        //
    }
    public function firltarAscensores()
    {
        $calle=request('calle');
        $numero=request('numero');
        $nSerie=request('numeroserie');
        if(strlen($nSerie)>12) {
            $ascensoresNum = Ascensor::where('numeroserie','like','%'.$nSerie.'%')->get();
            return json_encode($ascensoresNum);
        }
        else {
            $ascensores = Ascensor::where('calle','like','%'.$calle.'%')->get();
            if(count($ascensores)>0){
                $ascensor=$ascensores->where('bloque',$numero);
                //dd($ascensores);
                if(count($ascensor)>0){
                    return json_encode($ascensor); 

                }
                else{
                    return json_encode($ascensores);
                }
            }
        }
    }
}
