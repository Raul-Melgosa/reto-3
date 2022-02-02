<?php

namespace App\Http\Controllers;

use App\Models\Ascensor;
use Illuminate\Http\Request;

class AscensorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ascensor  $ascensor
     * @return \Illuminate\Http\Response
     */
    public function show(Ascensor $ascensor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ascensor  $ascensor
     * @return \Illuminate\Http\Response
     */
    public function edit(Ascensor $ascensor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ascensor  $ascensor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ascensor $ascensor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ascensor  $ascensor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ascensor $ascensor)
    {

    }


    public function filtrarAscensores(){  //busca ascensores coincidentes por nSerie, calle y bloque 
        $nSerie=request('numeroserie');   //en ese orden respectivamente
        $calle=request('calle');
        $bloque=request('bloque');

        if($nSerie){
            $ascensores=Ascensor::where('numeroserie', $nSerie)->get();
            if(count($ascensores)>0)
                return json_encode($ascensores);
            else{
                $ascensores=Ascensor::where('numeroserie', 'like', '%'.$nSerie.'%')->get();
                return json_encode($ascensores);
            }
        }
        elseif($calle){
            $ascensores=Ascensor::where('calle', 'like', '%'.$calle.'%')->get();  
            if(count($ascensores)>0 && $bloque){
                $ascensores->where('bloque', $bloque)->get();
            }
            elseif($ascensores){
                return $ascensores;
            }
        }
        return null;
    }


}
