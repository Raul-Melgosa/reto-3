<?php

namespace App\Http\Controllers;

use App\Models\Ascensor;
use App\Models\Equipo;
use App\Models\Cliente;
use App\Models\Zona;
use App\Models\Incidencia;
use App\Models\ModeloAscensor;
use App\Http\Controllers\MailController;
use Illuminate\Http\Request;
use App\Models\User;
use Mockery\Undefined;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;

class IncidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->rol=='jde') {
            $pendientes=Incidencia::whereIn('tecnico_id', function($query){
            $query->select('id')
                ->from(with(new User())->getTable())
                ->where('equipo_id', auth()->user()->equipo_id);
            })->where('estado','!=','Resuelta')->orderBy('urgente','DESC','created_at','DESC')->simplePaginate(20);

            $resueltas=Incidencia::whereIn('tecnico_id', function($query){
                $query->select('id')
                ->from(with(new User())->getTable())
                ->where('equipo_id', auth()->user()->equipo_id);
            })->where('estado','=','Resuelta')->orderBy('urgente','DESC','created_at','DESC')->simplePaginate(20);
            return view('jefeDeEquipo.home', compact('pendientes','resueltas'));
        }
        
        $incidencias=Incidencia::orderBy('urgente','DESC','created_at','DESC')->simplePaginate(20);
        return view('incidencias.index', compact('incidencias'));
    }

    public function filtrar()
    {
        $nombreTecnico=request('nombre');
        $zona=request('zona');
        $estado=request('estado');
        $fechaInicio=request('fechainicio');
        $fechaFin=request('fechafin');
        $tipoFiltro=[               //Aqui se define en base a que se va a filtrar depende de los parametros recogidos
                    "nombre" => 0,
                    "zona" => 0,
                    "estado" => 0,
                    "fecha" => 0];
        if($nombreTecnico!=""){
            $tipoFiltro["nombre"]=1;
        }
        if($zona!=null){
            $tipoFiltro["zona"]=1;
        }
        if($estado!=null){
            $tipoFiltro["estado"]=1;
        }
        if(self::validarFecha($fechaInicio) && self::validarFecha($fechaFin)){
            $tipoFiltro["fecha"]=1;
        }
        if($tipoFiltro['nombre']==0 && $tipoFiltro['zona']==0 && $tipoFiltro['estado']==0 && $tipoFiltro['fecha']==0)
            redirect('/incidencias');

        $incidencias=null;
        $idTecnicosNombre=[];
        $idTecnicosZona=[];     
        $idTecnicos=[];

        if($tipoFiltro["nombre"]==1){
            $tecnicos=User::where('rol','tecnico')->where('nombre', 'LIKE', '%'.$nombreTecnico.'%')->get();

            foreach($tecnicos as $tecnico){
                array_push($idTecnicosNombre, $tecnico->id);
            }
        }
        if($tipoFiltro["zona"]==1){
            $zonaId=Zona::where('zona', $zona)->first();
            $equipo=Equipo::where('zona_id', $zonaId->id)->first();
            $tecnicos=User::where('rol', 'tecnico')->where('equipo_id', $equipo->id)->get();
            foreach($tecnicos as $tecnico){
                array_push($idTecnicosZona, $tecnico->id);
            }
        }

        if($tipoFiltro["nombre"]==0 && $tipoFiltro["zona"]==0){
            $tecnicos=User::all();
            foreach($tecnicos as $tecnico){
                array_push($idTecnicos, $tecnico->id);
            }
        }
        if($tipoFiltro["nombre"]==1 && $tipoFiltro["zona"]==1){
            $idTecnicos=array_intersect($idTecnicosNombre, $idTecnicosZona);
        }
        elseif($tipoFiltro["nombre"]==1 && $tipoFiltro["zona"]==0){
            $idTecnicos=$idTecnicosNombre;
        }
        elseif($tipoFiltro["nombre"]==0 && $tipoFiltro["zona"]==1){
            $idTecnicos=$idTecnicosZona;
        }


        
        if($tipoFiltro["estado"]==1 && $tipoFiltro["fecha"]==0){
            $incidencias=Incidencia::whereIn('tecnico_id', $idTecnicos)->where('estado', $estado)->orderBy('urgente','DESC','created_at','DESC')->simplePaginate(20);
        }
        elseif($tipoFiltro["estado"]==0 && $tipoFiltro["fecha"]==1){
            $incidencias=Incidencia::whereIn('tecnico_id', $idTecnicos)->whereBetween('fecha_inicio', [$fechaInicio, $fechaFin])->orderBy('urgente','DESC','created_at','DESC')->simplePaginate(20);

        }
        elseif($tipoFiltro["estado"]==1 && $tipoFiltro["fecha"]==1){
            $incidencias=Incidencia::whereIn('tecnico_id', $idTecnicos)->where('estado', $estado)->whereBetween('fecha_inicio', array($fechaInicio, $fechaFin))->orderBy('urgente','DESC','created_at','DESC')->simplePaginate(20);

        }
        elseif($tipoFiltro["estado"]==0 && $tipoFiltro["fecha"]==0){
            $incidencias=Incidencia::whereIn('tecnico_id', $idTecnicos)->orderBy('urgente','DESC','created_at','DESC')->simplePaginate(20);

        }
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
        /*'urgente' => true,
                    'estado' => $estado,
                    'fecha-fin' => $this->faker->date(),
                    'tipoaveria' => $tipo,
                    'cliente_id' => $cliente->id,
                    'ascensor_id' => $ascensor->id,
                    'tecnico_id' => $tecnico->id,
                    'comentarioOperador' => $comentarioOperador,
                    'comentarioTecnico' => $comentarioTecnico*/
        $cliente = Cliente::where('email',request('emailCliente'))->first();
        if (!$cliente) {
            $cliente = new Cliente;
            $cliente->nombre=request('nombreCliente');
            $cliente->apellido=request('apellidoCliente');
            $cliente->email=request('emailCliente');
            $cliente->telefono=request('telefono');
            $cliente->save();
        }
        $incidencia = new Incidencia();
        $incidencia->comentarioOperador = request('comentarioOperador');
        if(request('averia')==""){
            $incidencia->tipoAveria = 'Sin especificar';
        }else {
            $incidencia->tipoAveria = request('averia');
        }
        $incidencia->cliente_id = $cliente->id;
        $incidencia->ascensor_id = request('idAscensor');
        $incidencia->tecnico_id=request('idTecnico');
     
        if(request('urgente')=="1"){
            $incidencia->urgente=1;
        } else {
            $incidencia->urgente=0;
        }
        $incidencia->save();

        $tecnico=User::find(request('idTecnico'));
        (new MailControler)->sendEmail($tecnico->email,'Nueva incidencia asignada','Este correo es meramente informativo, por favor no responda, se le ha asignado una nueva incidencia; mire la app para obtener más información');
        
        $incidencias=Incidencia::orderBy('urgente','DESC')->orderBy('created_at','DESC')->simplePaginate(20);
        return redirect(route('incidencias.index'));
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
        $equipo_id=$incidencia->tecnico->equipo_id;
        $tecnicos=User::where('equipo_id','=',$equipo_id)->orderBy('nombre','ASC')->get();
        $modelo=$incidencia->ascensor->modeloascensor;
        if(auth()->user()->rol=='tecnico'||auth()->user()->rol=='jde') {
            if ($incidencia->tecnico->equipo->zona->zona!=auth()->user()->equipo->zona->zona) {
                return view('errors.403');  
            } else {
                return view('incidencias.show', compact('incidencia','modelo','tecnicos'));
            }
        } else {
            return view('incidencias.show', compact('incidencia','modelo','tecnicos'));
        }
        
        
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
    public function update($id)
    {
        $incidencia=Incidencia::find($id);
        $incidencia->updated_at=Carbon::now()->toDateTimeString();
        if(Gate::allows('isJde')){
            $incidencia->tecnico_id=request('tecnicos');
            $incidencia->save();
        }
        if(Gate::allows('isOperador')){
            $incidencia->tecnico_id=request('tecnicos');
            $incidencia->save();
        }
        if (Gate::allows('isTecnico')) {
            $incidencia->estado = request('estados');
            
            $incidencia->tipoaveria=request('averia');
            $incidencia->comentarioTecnico=request('comentarioTecnico');

            $incidencia->save();
            if(request('estados')=="Resuelta"){
                $cliente=Cliente::find(request('cliente'));
                (new MailControler)->sendEmail($cliente->email,'Incidencia Resuelta','La incidencia con su ascensor ha sido resuelta, que tenga un buen dia');
            }
        }
        
        return redirect(route('incidencias.show',$incidencia->id));
        
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
        $datos=[];

        if(strlen($nSerie)>12) {
            $ascensoresNum = Ascensor::where('numeroserie','=',$nSerie)->get();
            foreach ($ascensoresNum as $ascensor) {
                $ascensor->modelo = $ascensor->modeloascensor;
            }
            $tecnicos = $this->getTecnicos($ascensoresNum[0]->zona_id);
            array_push($datos,$ascensoresNum);
            array_push($datos,$tecnicos);
            return json_encode($datos);
        }
        else {
            $ascensores = Ascensor::where('calle','like','%'.$calle.'%')->get();
            foreach ($ascensores as $ascensor) {
                $ascensor->modelo = $ascensor->modeloascensor;
            }
            if(count($ascensores)>0){
                $ascensor=$ascensores->where('bloque',$numero);
                if(count($ascensor)>0){
                    $tecnicos = $this->getTecnicos($ascensor[0]->zona_id);
                    array_push($datos,$ascensor);
                    array_push($datos,$tecnicos);
                    return json_encode($datos);
                } else {
                    $null='null';
                    return $null;
                }
            } else {
                $null='null';
                return $null;
            }
        }
    }

    function getTecnicos($zona_id) {
        $zona = Zona::find($zona_id);
        $equipos = Equipo::all()->where('zona_id','=',$zona->id);
        $tecnicos = [];
        foreach ($equipos as $equipo) {
            $tecnicosEquipo = $equipo->tecnicos();
            foreach ($tecnicosEquipo as $tecnico) {
                $incidenciasNormales=Incidencia::where('tecnico_id','=',$tecnico->id)->where('urgente','=','0')->get();
                $incidenciasUrgentes=Incidencia::where('tecnico_id','=',$tecnico->id)->where('urgente','=','1')->get();
                $tecnico->incidenciasNormales=count($incidenciasNormales);
                $tecnico->incidenciasUrgentes=count($incidenciasUrgentes);
                if(count($incidenciasUrgentes)>0) {
                    $tecnico->background='danger';
                } else {
                    $tecnico->background='dark';
                }
                array_push($tecnicos,$tecnico);
            }
        }
        return $tecnicos;
    }

    public function validarFecha($fecha){
        $regexFecha = '/^([0-9]{4})-([0-1][0-9])-([0-3][0-9])\s([0-1][0-9]|[2][0-3]):([0-5][0-9]):([0-5][0-9])$/';
        return preg_match($regexFecha, $fecha, $matches);
    }
}
