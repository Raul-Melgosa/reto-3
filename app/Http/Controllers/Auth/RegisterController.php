<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Equipo;
use App\Models\Zona;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;


    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255'],
            'nombre' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'rol' => ['required'],
            'equipo_id' => ['required'],
            'zona' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function register(Request $request)
    {
        $user = new User($request->all());
        $user->save();
        /*
        return User::create([
            'username' => $data['username'],
            'nombre' => $data['name'],
            'apellidos' => $data['apellidos'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'rol' => $data['rol']
        ])->save();
        /*$user = new User();

        $user->username=request('username');
        $user->nombre=request('nombre');
        $user->apellidos=request('apellidos');
        $user->email=request('email');
        $user->password=Hash::make(request('password'));
        $user->rol=request('rol');
        $user->equipo_id = auth()->user()->id;

        $user->save();
       
        if (Gate::allows('isAdmin')) {
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
}
