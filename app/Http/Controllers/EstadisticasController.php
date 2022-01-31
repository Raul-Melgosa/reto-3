<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zona;

class EstadisticasController extends Controller
{
    //incidencias-->
                    //por zona
                    //por rango de tiempo
                    //por modelo


    public function incidenciasPorZona(){
        $zonas=Zona::all();
        $incidencias=[];
        foreach ($zonas as $zona) {
            $equipo=$zona->equipo();
            $equipo->inc
        }
    }

}
