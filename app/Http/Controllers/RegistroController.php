<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UserController;
use App\Models\Equipo;
use App\Models\Zona;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;


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
        $user = new User();

        $user->username=request('username');
        $user->nombre=request('name');
        $user->apellidos=request('apellidos');
        $user->email=request('email');
        $user->password=Hash::make(request('password'));
        $user->rol=request('rol');
        $user->equipo_id = auth()->user()->id;

        $user->save();
        return
        /*if (Gate::allows('isAdmin')) {
            if ($data['rol']=="operador") {
                return User::create([
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

                return User::create([
                    'username' => $data['username'],
                    'nombre' => $data['name'],
                    'apellidos' => $data['apellidos'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'rol' => $data['rol'],
                    'equipo_id' => $equipo->id
                ]);
                
            }else {
                return User::create([
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
            return User::create([
                'username' => $data['username'],
                'nombre' => $data['name'],
                'apellidos' => $data['apellidos'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'rol' => $data['rol'],
                'equipo_id' => auth()->user()->id
            ]);
            
        }*/

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
