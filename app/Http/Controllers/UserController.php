<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use App\Models\User;
use App\Models\Indicencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        if (Gate::allows('isAdmin')) {
            return view('estadisticas.estadisticas');
        }
        elseif (Gate::allows('isJde')) {
            //select id from incidencias where tecnico_id IN (SELECT );
            $pendientes=Incidencia::whereIn('tecnico_id', function($query){
                $query->select('id')
                ->from(with(new User())->getTable())
                ->where('equipo_id', auth()->user()->equipo_id);
            })->where('estado','!=','Resuelta')->orderBy('urgente','DESC','created_at','DESC')->paginate(20);

            $resueltas=Incidencia::whereIn('tecnico_id', function($query){
                $query->select('id')
                ->from(with(new User())->getTable())
                ->where('equipo_id', auth()->user()->equipo_id);
            })->where('estado','=','Resuelta')->orderBy('urgente','DESC','created_at','DESC')->paginate(20);
            return view('jefeDeEquipo.home', compact('pendientes','resueltas'));
        }
        elseif (Gate::allows('isTecnico')) {
            $pendientes=Incidencia::where('tecnico_id','=',auth()->user()->id)->where('estado','!=','Resuelta')->orderBy('urgente','DESC')->orderBy('created_at','ASC')->orderBy('estado','DESC')->paginate(20);
            $resueltas=Incidencia::where('tecnico_id','=',auth()->user()->id)->where('estado','=','Resuelta')->orderBy('urgente','DESC')->orderBy('created_at','ASC')->orderBy('estado','DESC')->paginate(20);
            return view('tecnico.home', compact('pendientes','resueltas'));
        }
        elseif (Gate::allows('isOperador')) {
            $incidencias=Incidencia::orderBy('urgente','DESC','created_at','DESC')->paginate(20);
            return view('operador.home', compact('incidencias'));
        }
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
