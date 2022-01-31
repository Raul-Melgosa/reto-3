<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zona;
use App\Models\ModeloAscensor;
use App\Models\Equipo;
use Illuminate\Support\Facades\DB;

class EstadisticasController extends Controller
{
    //incidencias-->
                    //por zona
                    //por rango de tiempo
                    //por modelo


    public function numIncidenciasPorZona(/*$fechaMin, $fechaMax*/){
        $fechaMin=null;
        $fechaMax=null;
        $zonas=Zona::all();
        $incidenciasTotales=[];
        foreach ($zonas as $zona) {
            $incidencias=[];
            $equipo=$zona->equipo;
            $tecnicos=$equipo->tecnicos();
            foreach($tecnicos as $tecnico){
                if($fechaMin && $fechaMax){
                    array_push($incidencias, $tecnico->incidencias
                                                                ->where('created_at', '>=', $fechaMin)
                                                                ->where('fecha_fin', '<=', $fechaMax));
                }
                else{
                    array_push($incidencias, $tecnico->incidencias);
                }
            }
            $num_inicidencias=count($incidencias);
            array_push($incidenciasTotales, [$zona->zona=> $num_inicidencias]);
        }
        dd($incidenciasTotales);
    }




    public function numIncidenciasPorModelo($fechaMin, $fechaMax){
        $fechaMin=null;
        $fechaMax=null;
        $modelos=ModeloAscensor::all();
        $incidenciasTotales=[];
        foreach ($modelos as $modelo) {
            $incidencias=[];
            $ascensores=$modelo->ascensores;
            foreach($ascensores as $ascensor){
                if($fechaMin && $fechaMax){
                    array_push($incidencias, $ascensor->incidencias
                                                                ->where('created_at', '>=', $fechaMin)
                                                                ->where('fecha_fin', '<=', $fechaMax));
                }
                else{
                    array_push($incidencias, $ascensor->incidencias);
                }
            }
            $num_inicidencias=count($incidencias);
            $num_inicidencias_modelo=[$modelo->modelo => $num_inicidencias];
            array_push($incidenciasTotales, $num_inicidencias_modelo);
        }
        dd($incidenciasTotales);
    }

    public function tiempoMedioIncidenciaEquipo(/*$fechaMin, $fechaMax*/){  //tiempo medio que se ha tardado en cerrar un incidencia
        $fechaMin=null;
        $fechaMax=null;
        $equipos=Equipo::all();
        $tiemposIncidencias=[];
        foreach ($equipos as $equipo) {
            $incidenciasTecnico=[];
            $tecnicos=$equipo->tecnicos();
            foreach($tecnicos as $tecnico){
                if($fechaMin && $fechaMax){
                    array_push($incidenciasTecnico, $tecnico->incidencias
                                            ->where('created_at', '>=', $fechaMin)
                                            ->where('fecha_fin', '<=', $fechaMax));
                }
                else{
                    //array_push($incidenciasTecnico, $tecnico->incidencias);
                    array_push($incidenciasTecnico, $tecnico->incidencias
                                            ->where('fecha_fin', '!=', null));
                }
            }
            $contador=0; // numero de incidencias para sacar la media
            $tiempoIncidencias=0;
            foreach($incidenciasTecnico as $incidencias){ 
                foreach($incidencias as $incidencia){      
                    $tiempoIncidencias+=(strtotime($incidencia->fecha_fin) - strtotime($incidencia->fecha_inicio));
                    $contador++;
                }
            }
            $tiempoMedioIncidencia=($tiempoIncidencias/$contador)/(60 * 60); //devuelve horas

            array_push($tiemposIncidencias, [$equipo->equipo_id => $tiempoMedioIncidencia]);
        }
        dd($tiemposIncidencias);
    }

    public function tiempoMedioIncidenciaTecnico(/*$equipoId, $fechaMin, $fechaMax*/){  //tiempo medio que se ha tardado en cerrar un incidencia cada tecnico
        $fechaMin=null;
        $fechaMax=null;
        $equipoId=1;
        $equipo=Equipo::get('id',$equipoId)->first();
        $tecnicos=$equipo->tecnicos();

        $incidenciasTecnico=[];
        $tiempoMedioIncidenciaTecnicos=[];
        foreach($tecnicos as $tecnico){
            if($fechaMin && $fechaMax){
                $incidenciasTecnico=$tecnico->incidencias->where('created_at', '>=', $fechaMin)
                                    ->where('fecha_fin', '<=', $fechaMax);
                $tiempoIncidencias=0;
                $contador=0;
                foreach($incidenciasTecnico as $incidencia){ 
                    $tiempoIncidencias+=(strtotime($incidencia->fecha_fin) - strtotime($incidencia->fecha_inicio));
                    $contador++;
                }
                $tiempoMedioIncidencia=($tiempoIncidencias/$contador)/(60 * 60); //devuelve horas
                array_push($tiempoMedioIncidenciaTecnicos, [$tecnico->tecnico_id => $tiempoMedioIncidencia]);
                } 
            else{
                $incidenciasTecnico=$tecnico->incidencias->where('fecha_fin', '!=', null );
                $tiempoIncidencias=0;
                $contador=0;
                if(count($incidenciasTecnico)>0){
                    foreach($incidenciasTecnico as $incidencia){ 
                        $tiempoIncidencias+=(strtotime($incidencia->fecha_fin) - strtotime($incidencia->fecha_inicio));
                        $contador++;
                    }
                    $tiempoMedioIncidencia=($tiempoIncidencias/$contador)/(60 * 60); //devuelve horas
                    array_push($tiempoMedioIncidenciaTecnicos, [$tecnico->tecnico_id => $tiempoMedioIncidencia]);
                }
                else{
                    array_push($tiempoMedioIncidenciaTecnicos, [$tecnico->tecnico_id => "Tecnico sin incidencias"]);

                }
            } 
        }
            dd($tiempoMedioIncidenciaTecnicos);
        }


        public function tipoDeIncidenciasPorZona(/*$fechaMin, $fechaMax*/){
            $fechaMin=null;
            $fechaMax=null;
            $zonas=Zona::all();
            $incidencias=[];
            foreach ($zonas as $zona) {
                $incidencias_bandalismo=0;
                $incidencias_mecanicas=0;
                $incidencias_electricas=0;
                $equipo=$zona->equipo;
                $tecnicos=$equipo->tecnicos();
                foreach($tecnicos as $tecnico){
                    if($fechaMin && $fechaMax){
                        array_push($incidencias, $tecnico->incidencias
                                                                    ->where('created_at', '>=', $fechaMin)
                                                                    ->where('fecha_fin', '<=', $fechaMax));
                    }
                    else{
                        array_push($incidencias, $tecnico->incidencias);
                    }
                }
                $incidencias_bandalismo=count(array_filter($incidencias, function($var){
                    if($var->tipoaveria=="Bandalismo (estético)"){
                        return true;
                    }
                }));
                $incidencias_mecanicas=count(array_filter($incidencias, function($var){
                    if($var->tipoaveria=="Funcionamiento (mecánico)"){
                        return true;
                    }
                }));
                $incidencias_mecanicas=count(array_filter($incidencias, function($var){
                    if($var->tipoaveria=="Funcionamiento (eléctrico)"){
                        return true;
                    }
                }));
                dd($incidencias_bandalismo);
                array_push($incidenciasTotales, [$zona->zona=> $num_inicidencias]);
            }
            dd($incidenciasTotales);

        }

}



