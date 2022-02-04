<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zona;
use App\Models\ModeloAscensor;
use App\Models\Equipo;
use App\Models\User;

class EstadisticasController extends Controller
{
    //incidencias-->
                    //por zona
                    //por rango de tiempo
                    //por modelo


    public function index(){
        return view('estadisticas.estadisticas');
    }


    public function validarFecha($fecha){
        $regexFecha = '/^([0-9]{4})-([0-1][0-9])-([0-3][0-9])\s([0-1][0-9]|[2][0-3]):([0-5][0-9]):([0-5][0-9])$/';
        return preg_match($regexFecha, $fecha, $matches);
    }



    public function numIncidenciasPorZona(){
        $fechaMin=request('fechaInicio');
        $fechaMax=request('fechaFin'); 
        if(!self::validarFecha($fechaMin) && !self::validarFecha($fechaMax)){
            $fechaMin=null;
            $fechaMax=null;
        }
        $zonas=Zona::all();
        $incidenciasTotales=[];
        foreach ($zonas as $zona) {
            $incidencias=[];
            $equipo=$zona->equipo;
            $tecnicos=$equipo->tecnicos();
            foreach($tecnicos as $tecnico){
                if($fechaMin!=null && $fechaMax!=null){
                    $incidencias=array_merge($incidencias, $tecnico->incidencias
                                                                ->whereBetween('fecha_inicio', [$fechaMin, $fechaMax])->toArray());
                }
                else{
                    $incidencias=array_merge($incidencias, $tecnico->incidencias->toArray());
                }
            }
            $num_inicidencias=count($incidencias);
            $incidenciasTotales[$zona->zona]=$num_inicidencias;
        }
        return [ 'titulo' => 'Numero de incidencias por zona:',
            'nombrecolumnas' => ['  Zona', 'Numero de incidencias'],
            'datos' => $incidenciasTotales];
    }

    public function numTipoIncidenciasPorZona(/*$fechaMin, $fechaMax*/){
        $fechaMin=request('fechaInicio');
        $fechaMax=request('fechaFin'); 
        if(!self::validarFecha($fechaMin) && !self::validarFecha($fechaMax)){
            $fechaMin=null;
            $fechaMax=null;
        }
        $zonas=Zona::all();
        $incidenciasTotales=[];
        foreach ($zonas as $zona) {
            $incidencias=[];
            $equipo=$zona->equipo;
            $tecnicos=$equipo->tecnicos();
            foreach($tecnicos as $tecnico){
                if($fechaMin!=null && $fechaMax!=null){
                    $incidencias=array_merge($incidencias, $tecnico->incidencias->whereBetween('fecha_inicio', [$fechaMin, $fechaMax])->toArray());
                }
                else{
                    $incidencias=array_merge($incidencias, $tecnico->incidencias->toArray());
                }
            }
            $incidenciasTipo['Todas']=count($incidencias);
            $incidencias_bandalismo=count(array_filter($incidencias, function($var){
                if($var['tipoaveria']=="Bandalismo (estético)"){
                    return true;
                }
            }));
            $incidenciasTipo['Estetica']=$incidencias_bandalismo;
            $incidencias_mecanicas=count(array_filter($incidencias, function($var){
                if($var['tipoaveria']=="Funcionamiento (mecánico)"){
                    return true;
                }
            }));
            $incidenciasTipo['Mecanica']=$incidencias_mecanicas;
            $incidencias_electricas=count(array_filter($incidencias, function($var){
                if($var['tipoaveria']=="Funcionamiento (eléctrico)"){
                    return true;
                }
            }));
            $incidenciasTipo['Electrica']=$incidencias_electricas;
            $incidenciasModelo[$zona->zona]=$incidenciasTipo;        
        }
        return [ 'titulo' => 'Tipos de incidencia por zona:',
                        'nombrecolumnas' => ['Zona', 'Total','Averias Electricas', 'Averias Mecanicas', 'Averias Esteticas'],
                        'datos' => $incidenciasModelo];
    }




    public function numIncidenciasPorModelo(/*$fechaMin, $fechaMax*/){
        $fechaMin=request('fechaInicio');
        $fechaMax=request('fechaFin'); 
        if(!self::validarFecha($fechaMin) && !self::validarFecha($fechaMax)){
            $fechaMin=null;
            $fechaMax=null;
        }
        $modelos=ModeloAscensor::all();
        $incidenciasTotales=[];
        foreach ($modelos as $modelo) {
            $incidencias=[];
            $ascensores=$modelo->ascensores;
            foreach($ascensores as $ascensor){
                if($fechaMin!=null && $fechaMax!=null){
                    $incidencias=array_merge($incidencias, $ascensor->incidencias->whereBetween('fecha_inicio', [$fechaMin, $fechaMax])->toArray());
                }
                else{
                    $incidencias=array_merge($incidencias, $ascensor->incidencias->toArray());
                }
            }
            $incidenciasTipo['Todas']=count($incidencias);
            $incidencias_bandalismo=count(array_filter($incidencias, function($var){
                if($var['tipoaveria']=="Bandalismo (estético)"){
                    return true;
                }
            }));
            $incidenciasTipo['Estetica']=$incidencias_bandalismo;
            $incidencias_mecanicas=count(array_filter($incidencias, function($var){
                if($var['tipoaveria']=="Funcionamiento (mecánico)"){
                    return true;
                }
            }));
            $incidenciasTipo['Mecanica']=$incidencias_mecanicas;
            $incidencias_electricas=count(array_filter($incidencias, function($var){
                if($var['tipoaveria']=="Funcionamiento (eléctrico)"){
                    return true;
                }
            }));
            $incidenciasTipo['Electrica']=$incidencias_electricas;
            $incidenciasModelo[$modelo->modelo]=$incidenciasTipo;        
        }
        return [ 'titulo' => 'Tipos de incidencia por modelo:',
                        'nombrecolumnas' => ['Modelo', 'Total','Averias Electricas', 'Averias Mecanicas', 'Averias Esteticas'],
                        'datos' => $incidenciasModelo];
    }

    public function numIncidenciasPorModeloId(/*$modeloId, $fechaMin, $fechaMax*/){
        $fechaMin=request('fechaInicio');
        $fechaMax=request('fechaFin'); 
        if(!self::validarFecha($fechaMin) && !self::validarFecha($fechaMax)){
            $fechaMin=null;
            $fechaMax=null;
        }
        $modeloId=1;
        $modelos=ModeloAscensor::all()->where('id',$modeloId);
        $incidencias=[];
        foreach ($modelos as $modelo) {
            $ascensores=$modelo->ascensores;
            foreach($ascensores as $ascensor){
                if($fechaMin!=null && $fechaMax!=null){
                    $incidencias=array_merge($incidencias, $ascensor->incidencias->whereBetween('fecha_inicio', [$fechaMin, $fechaMax])->toArray());
                }
                else{
                    $incidencias=array_merge($incidencias, $ascensor->incidencias->toArray());
                }
            }
            $incidenciasTipo['Todas']=count($incidencias);
            $incidencias_bandalismo=count(array_filter($incidencias, function($var){
                if($var['tipoaveria']=="Bandalismo (estético)"){
                    return true;
                }
            }));
            $incidenciasTipo['Estetica']=$incidencias_bandalismo;
            $incidencias_mecanicas=count(array_filter($incidencias, function($var){
                if($var['tipoaveria']=="Funcionamiento (mecánico)"){
                    return true;
                }
            }));
            $incidenciasTipo['Mecanica']=$incidencias_mecanicas;
            $incidencias_electricas=count(array_filter($incidencias, function($var){
                if($var['tipoaveria']=="Funcionamiento (eléctrico)"){
                    return true;
                }
            }));
            $incidenciasTipo['Electrica']=$incidencias_electricas;
            $incidenciasModelo[$modelo->modelo]=$incidenciasTipo;
        }
        

        return [ 'titulo' => 'Tipos de incidencia por modelo ID:',
                        'nombrecolumnas' => ['Tipo averia', 'Numero de averias'],
                        'datos' => $incidenciasTipo];


        
    }


    public function tiempoMedioIncidenciaEquipo(/*$fechaMin, $fechaMax*/){  //tiempo medio que se ha tardado en cerrar un incidencia
        $fechaMin=request('fechaInicio');
        $fechaMax=request('fechaFin'); 
        if(!self::validarFecha($fechaMin) && !self::validarFecha($fechaMax)){
            $fechaMin=null;
            $fechaMax=null;
        }
        $equipos=Equipo::all();
        $tiemposIncidencias=[];
        foreach ($equipos as $equipo) {
            $incidenciasTecnico=[];
            $tecnicos=$equipo->tecnicos();
            foreach($tecnicos as $tecnico){
                if($fechaMin!=null && $fechaMax!=null){
                    $incidenciasTecnico=array_merge($incidenciasTecnico, $tecnico->incidencias->whereBetween('fecha_inicio', [$fechaMin, $fechaMax])->toArray());
                }
                else{
                    $incidenciasTecnico=array_merge($incidenciasTecnico, $tecnico->incidencias
                                            ->where('fecha_fin', '!=', null)->toArray());
                }
            }
            //dd($incidenciasTecnico);
            $contador=0; // numero de incidencias para sacar la media
            $tiempoIncidencias=0;
            foreach($incidenciasTecnico as $incidencia){      
                $tiempoIncidencias+=(strtotime($incidencia['fecha_fin']) - strtotime($incidencia['fecha_inicio']));
                $contador++;
            }
            $tiempoMedioIncidencia=($tiempoIncidencias/$contador)/(60 * 60); //devuelve horas

            $tiemposIncidencias[$equipo->id]= $tiempoMedioIncidencia;
        }
        return [ 'titulo' => 'Tiempo medio de incidencia equipos:',
            'nombrecolumnas' => ['Id equipo', 'Tiempo Media Incidencia(h)'],
            'datos' => $tiemposIncidencias];
    }

    public function tiempoMedioIncidenciaTecnico(/*$equipoId, $fechaMin, $fechaMax*/){  //tiempo medio que se ha tardado en cerrar un incidencia cada tecnico
        $fechaMin=request('fechaInicio');
        $fechaMax=request('fechaFin'); 
        if(!self::validarFecha($fechaMin) && !self::validarFecha($fechaMax)){
            $fechaMin=null;
            $fechaMax=null;
        }
        $equipoId=1;
        $equipo=Equipo::get('id',$equipoId)->first();
        $tecnicos=$equipo->tecnicos();
        $incidenciasTecnico=[];
        $tiempoMedioIncidenciaTecnicos=[];
        foreach($tecnicos as $tecnico){
            if($fechaMin!=null && $fechaMax!=null){
                $incidenciasTecnico=$tecnico->incidencias->whereBetween('fecha_inicio', [$fechaMin, $fechaMax])->toArray();
                $tiempoIncidencias=0;
                $contador=0;
                foreach($incidenciasTecnico as $incidencia){ 
                    $tiempoIncidencias+=(strtotime($incidencia->fecha_fin) - strtotime($incidencia->fecha_inicio));
                    $contador++;
                }
                $tiempoMedioIncidencia=($tiempoIncidencias/$contador)/(60 * 60); //devuelve horas
                $tiempoMedioIncidenciaTecnicos[$tecnico->id] = $tiempoMedioIncidencia;
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
                    $tiempoMedioIncidenciaTecnicos[$tecnico->nombre] = round($tiempoMedioIncidencia, 1);
                }
                else{
                    //$tiempoMedioIncidenciaTecnicos[$tecnico->nombre] = "Tecnico sin incidencias";
                    $tiempoMedioIncidenciaTecnicos[$tecnico->nombre] = 0;
                }
            }
        }

            return [ 'titulo' => 'Tiempo medio de incidencia tecnicos:',
            'nombrecolumnas' => ['Nombre tecnico', 'Tiempo Media Incidencia(h)'],
            'datos' => $tiempoMedioIncidenciaTecnicos,];
           
        }


        public function tipoDeIncidenciasPorZona(/*$fechaMin, $fechaMax*/){
            $fechaMin=request('fechaInicio');
            $fechaMax=request('fechaFin'); 
            if(!self::validarFecha($fechaMin) && !self::validarFecha($fechaMax)){
                $fechaMin=null;
                $fechaMax=null;
            }
            $zonas=Zona::all();
            foreach ($zonas as $zona) {
                $incidencias=[];
                $incidencias_bandalismo=0;
                $incidencias_mecanicas=0;
                $incidencias_electricas=0;
                $equipo=$zona->equipo;
                $tecnicos=$equipo->tecnicos();
                foreach($tecnicos as $tecnico){
                    if($fechaMin!=null && $fechaMax!=null){
                        if(count($tecnico->incidencias->toArray())>=1){
                            $incidencias=array_merge($incidencias, $tecnico->incidencias->whereBetween('fecha_inicio', [$fechaMin, $fechaMax])->toArray());
                        }
                    }
                    else{
                        if(count($tecnico->incidencias->toArray())>=1)
                            $incidencias=array_merge($incidencias, $tecnico->incidencias->toArray());
                    }
                }
                //dd($incidencias);
                $incidencias_bandalismo=count(array_filter($incidencias, function($var){
                    if($var['tipoaveria']=="Bandalismo (estético)"){
                        return true;
                    }
                }));
                $incidencias_mecanicas=count(array_filter($incidencias, function($var){
                    if($var['tipoaveria']=="Funcionamiento (mecánico)"){
                        return true;
                    }
                }));
                $incidencias_electricas=count(array_filter($incidencias, function($var){
                    if($var['tipoaveria']=="Funcionamiento (eléctrico)"){
                        return true;
                    }
                }));

                
                $incidenciasTotales[$zona->zona]=['electrica' => $incidencias_electricas,
                                                    'mecanica' => $incidencias_mecanicas,
                                                    'estetica' => $incidencias_bandalismo];

            }

            return [ 'titulo' => 'Tipos de incidencia por zonas:',
                        'nombrecolumnas' => ['Equipos', 'Averias Electricas', 'Averias Mecanicas', 'Averias Esteticas'],
                        'datos' => $incidenciasTotales,];


                        
            
            //dd($incidenciasTotales);

        }

        public function tipoDeIncidenciasPorZonaId(/*$zonaId/*$fechaMin, $fechaMax*/){
            $fechaMin=request('fechaInicio');
            $fechaMax=request('fechaFin'); 
            if(!self::validarFecha($fechaMin) && !self::validarFecha($fechaMax)){
                $fechaMin=null;
                $fechaMax=null;
            }
            $zonas=Zona::all()->where('id', 1);
            foreach ($zonas as $zona) {
                $incidencias=[];
                $incidencias_bandalismo=0;
                $incidencias_mecanicas=0;
                $incidencias_electricas=0;
                $equipo=$zona->equipo;
                $tecnicos=$equipo->tecnicos();
                foreach($tecnicos as $tecnico){
                    if($fechaMin!=null && $fechaMax!=null){
                        if(count($tecnico->incidencias->toArray())>=1){
                            $incidencias=array_merge($incidencias, $tecnico->incidencias->whereBetween('fecha_inicio', [$fechaMin, $fechaMax])->toArray());
                        }
                    }
                    else{
                        if(count($tecnico->incidencias->toArray())>=1)
                            $incidencias=array_merge($incidencias, $tecnico->incidencias->toArray());
                    }
                }
                //dd($incidencias);
                $incidencias_bandalismo=count(array_filter($incidencias, function($var){
                    if($var['tipoaveria']=="Bandalismo (estético)"){
                        return true;
                    }
                }));
                $incidenciasTotales['Estetica']=$incidencias_bandalismo;
                $incidencias_mecanicas=count(array_filter($incidencias, function($var){
                    if($var['tipoaveria']=="Funcionamiento (mecánico)"){
                        return true;
                    }
                }));
                $incidenciasTotales['Mecanica']=$incidencias_mecanicas;
                $incidencias_electricas=count(array_filter($incidencias, function($var){
                    if($var['tipoaveria']=="Funcionamiento (eléctrico)"){
                        return true;
                    }
                }));
                $incidenciasTotales['Electrica']=$incidencias_electricas;
                
            }
            return [ 'titulo' => 'Tipos de incidencia por modelo ID:',
                        'nombrecolumnas' => ['Tipo averia', 'Numero de averias'],
                        'datos' => $incidenciasTotales];

        }


        public function getZonas(){
            $zonas=Zona::all();
            $nombreZonas=[];
            foreach($zonas as $key => $value){
                $nombreZonas[$key]=$value;
            }
            return json_encode($nombreZonas);
        }

        public function getModelos(){
            $modelos=ModeloAscensor::all();
            $nombreModelos=[];
            foreach($modelos as $key => $value){
                $nombreModelos[$key]=$value;
            }
            return json_encode($nombreModelos);
        }

        public function getTecnicos(){
            $idEquipo=request('id_equipo');
            $modelos=User::all()->where('rol', 'tecnico')
                                ->where('equipo_id', $idEquipo);

            $nombreModelos=[];
            foreach($modelos as $key => $value){
                $nombreModelos[$key]=$value;
            }
            return json_encode($nombreModelos);
        }





        



}


