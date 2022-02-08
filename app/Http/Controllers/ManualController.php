<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModeloAscensor;

class ManualController extends Controller
{
    public function index()
    {
        
        $manuales=ModeloAscensor::all();
        
        return view('manuales.index', compact('manuales'));

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
    public function filtrarNombre()
    {
        
        $ascensor=request('ascensor');
        
        if(strlen($ascensor)>0){
            $manual=ModeloAscensor::where('modelo','like','%'.$ascensor.'%')->get();
            if(count($manual)>0){
                return json_encode($manual);
            }
        }else{
            $manual="null";
            return json_encode($manual);
        }
        
        
    }
}
