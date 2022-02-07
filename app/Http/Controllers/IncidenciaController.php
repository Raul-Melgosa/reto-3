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

class IncidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incidencias=Incidencia::orderBy('urgente','DESC','created_at','DESC')->paginate(20);
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
        
        $incidencias=Incidencia::orderBy('urgente','DESC')->orderBy('created_at','DESC')->paginate(20);
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
        $tecnicos=User::all()->where('equipo_id','=',$equipo_id);
        $modelo=ModeloAscensor::find($incidencia->ascensor->modeloAscensor_id);
        return view('incidencias.show', compact('incidencia','modelo','tecnicos'));
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
        if(Gate::allows('isJde')){
            request('tecnicos');
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
        
        return redirect(route('home'));
        
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
                $ascensor->modelo = ModeloAscensor::find($ascensor->modeloAscensor_id);
            }
            $tecnicos = $this->getTecnicos($ascensoresNum[0]->zona_id);
            array_push($datos,$ascensoresNum);
            array_push($datos,$tecnicos);
            return json_encode($datos);
        }
        else {
            $ascensores = Ascensor::where('calle','like','%'.$calle.'%')->get();
            foreach ($ascensores as $ascensor) {
                $ascensor->modelo = ModeloAscensor::find($ascensor->modeloAscensor_id);
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
}
