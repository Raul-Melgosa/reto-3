<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UserController;
use App\Models\Equipo;
use App\Models\Zona;
use App\Models\User;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class RegistroController extends Controller
{
    public function index()
    {
        
        $equipos=Equipo::all();
        $zonas=Zona::all();
        return view('auth.register', compact('equipos','zonas'));

    }

    public function create()
    {
        try{
            $data=request()->all();
            if (Gate::allows('isAdmin')) {
                if ($data['rol']=="operador") {
                    User::create([
                        'username' => $data['username'],
                        'nombre' => $data['name'],
                        'apellidos' => $data['apellidos'],
                        'email' => $data['email'],
                        'password' => Hash::make($data['password']),
                        'rol' => $data['rol']
                    ]);
                }elseif ($data['rol']=="jde") {

                    $equipo = new Equipo();
                    $equipo->zona_id=$data['zona'];
                    $equipo->save();

                    User::create([
                        'username' => $data['username'],
                        'nombre' => $data['name'],
                        'apellidos' => $data['apellidos'],
                        'email' => $data['email'],
                        'password' => Hash::make($data['password']),
                        'rol' => $data['rol'],
                        'equipo_id' => $equipo->id
                    ]);
                    
                }else {
                    User::create([
                        'username' => $data['username'],
                        'nombre' => $data['name'],
                        'apellidos' => $data['apellidos'],
                        'email' => $data['email'],
                        'password' => Hash::make($data['password']),
                        'rol' => $data['rol'],
                        'equipo_id' => $data['equipo_id']
                    ]);
                }
                    
            }
            elseif (Gate::allows('isJde')) {
                User::create([
                    'username' => $data['username'],
                    'nombre' => $data['name'],
                    'apellidos' => $data['apellidos'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'rol' => $data['rol'],
                    'equipo_id' => auth()->user()->id
                ]);
                
            }
            return Redirect(route('home'));
        }catch(Exception $e){
            $error= $e;
            if($e->getCode()==23000){ // primary key duplicada
                $errorMessage='Ese email ya esta registrado';
            }else{
                $errorMessage=$e->getMessage();
            }
            
            $equipos=Equipo::all();
            $zonas=Zona::all();
            return view('auth.register', compact('equipos','zonas', 'error','errorMessage'));
        }
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
}
