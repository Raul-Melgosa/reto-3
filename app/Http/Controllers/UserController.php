<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use App\Models\User;
use App\Models\Indicencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            return redirect(route('estadisticas.index'));
        }
        elseif (Gate::allows('isJde')) {
            return redirect(route('estadisticas.index'));
            //select id from incidencias where tecnico_id IN (SELECT );
        }
        elseif (Gate::allows('isTecnico')) {
            $pendientes=Incidencia::where('tecnico_id','=',auth()->user()->id)->where('estado','!=','Resuelta')->orderBy('urgente','DESC')->orderBy('created_at','ASC')->orderBy('estado','DESC')->simplePaginate(20);
            $resueltas=Incidencia::where('tecnico_id','=',auth()->user()->id)->where('estado','=','Resuelta')->orderBy('urgente','DESC')->orderBy('created_at','ASC')->orderBy('estado','DESC')->simplePaginate(20);
            return view('tecnico.home', compact('pendientes','resueltas'));
        }
        elseif (Gate::allows('isOperador')) {
            $incidencias=Incidencia::orderBy('urgente','DESC','created_at','DESC')->simplePaginate(20);
            return view('incidencias.index', compact('incidencias'));
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

    public function cambiarRol()
    {
        $user=User::find(Auth::user()->id);
        $user->rol = request('roles');
        $user->save();
        return redirect(route('home'));
    }
}
