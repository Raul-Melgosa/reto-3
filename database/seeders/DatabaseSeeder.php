<?php

namespace Database\Seeders;

use App\Models\Ascensor;
use App\Models\Cliente;
use App\Models\Equipo;
use App\Models\Incidencia;
use App\Models\ModeloAscensor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $modelos=[
            [
                'modelo'=>'Orona-3G-1010',
                'manual'=>'Catalogo-Orona-3G-1010-ES.pdf',
                'carga'=>' 630'
            ],
            [
                'modelo'=>'Orona-3G-1015',
                'manual'=>'Catalogo-Orona-3G-1015-ES.pdf',
                'carga'=>'1000'
            ],
            [
                'modelo'=>'Orona-3G-1020',
                'manual'=>'Catalogo-Orona-3G-1020-ES.pdf',
                'carga'=>'630'
            ],
            [
                'modelo'=>'Orona-3G-1025',
                'manual'=>'Catalogo-Orona-3G-1025-ES.pdf',
                'carga'=>'1000'
            ],
            [
                'modelo'=>'Orona-3G-2010',
                'manual'=>'Catalogo-Orona-3G-2010-ES.pdf',
                'carga'=>'630'
            ],
            [
                'modelo'=>'Orona-3G-2015',
                'manual'=>'Catalogo-Orona-3G-2015-ES.pdf',
                'carga'=>'1000'
            ],
            [
                'modelo'=>'Orona-3G-2016',
                'manual'=>'Catalogo-Orona-3G-2016-ES.pdf',
                'carga'=>'1600'
            ],
            [
                'modelo'=>'Orona-3G-2020',
                'manual'=>'Catalogo-Orona-3G-2020-ES.pdf',
                'carga'=>'630'
            ],
            [
                'modelo'=>'Orona-3G-2025',
                'manual'=>'Catalogo-Orona-3G-2025-ES.pdf',
                'carga'=>'1000'
            ],
            [
                'modelo'=>'Orona-3G-2026',
                'manual'=>'Catalogo-Orona-3G-2026-ES.pdf',
                'carga'=>'1600'
            ]
        ];
        foreach ($modelos as $modelo) {
            $m=new ModeloAscensor();
            $m->modelo=$modelo['modelo'];
            $m->manual=$modelo['manual'];
            $m->carga=$modelo['carga'];
            $m->save();
        }
        
        function llamadaFactoryAscensor($zonaId) {
            Ascensor::factory(random_int(50,100))->create([
                'zona_id' => $zonaId,
            ]);
            DB::table('equipos')->insert([
                'zona_id' => $zonaId,
            ]);
        }

        $zonaId=DB::table('zonas')->insertGetId([
            'zona'=>"norte"
        ]);
        llamadaFactoryAscensor($zonaId);


        $zonaId=DB::table('zonas')->insertGetId([
            'zona'=>"sur"
        ]);
        llamadaFactoryAscensor($zonaId);


        $zonaId=DB::table('zonas')->insertGetId([
            'zona'=>"este"
        ]);
        llamadaFactoryAscensor($zonaId);


        $zonaId=DB::table('zonas')->insertGetId([
            'zona'=>"oeste"
        ]);
        llamadaFactoryAscensor($zonaId);


        $zonaId=DB::table('zonas')->insertGetId([
            'zona'=>"centro"
        ]);
        llamadaFactoryAscensor($zonaId);

        

        User::factory()->count(25)->create([
            'rol' => 'operador'
        ]);

        User::factory()->count(25)->create([
            'rol' => 'operador',
            'username' => 'operador'
        ]);

        $equipos = (new Equipo)->all();
        foreach ($equipos as $equipo) {
            if($equipo->id==1) {
                User::factory()->count(9)->create([
                    'rol' => 'tecnico',
                    'equipo_id' => $equipo->id
                ]);
                User::factory()->count(1)->create([
                    'rol' => 'tecnico',
                    'username' => 'tecnico',
                    'equipo_id' => $equipo->id
                ]);
                User::factory()->count(1)->create([
                    'rol' => 'jde',
                    'username' => 'jefe',
                    'equipo_id' => $equipo->id
                ]);
            } else {
                User::factory()->count(10)->create([
                'rol' => 'tecnico',
                'equipo_id' => $equipo->id
                ]);
                User::factory()->count(1)->create([
                    'rol' => 'jde',
                    'equipo_id' => $equipo->id
                ]);
            }
            
        }

        Cliente::factory()->count(5)->create();

        Incidencia::factory()->count(600)->create();

        DB::table('users')->insert([
            'nombre'=>"admin",
            'apellidos' => "admin",
            'username' => 'admin',
            'email'=>"admin@igobide.org",
            'password'=>Hash::make("admin"),
            'rol'=>"admin",
            'admin'=>true,
            'equipo_id' => 1,
        ]);
    }
}
