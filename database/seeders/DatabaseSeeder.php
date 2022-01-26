<?php

namespace Database\Seeders;

use App\Models\Ascensor;
use App\Models\Cliente;
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
        
        
        $user = new User();
        $user->name="Pepe";
        $user->email="pepe.cerdan@ikasle.egibide.org";
        $user->password=Hash::make("12345678");
        $user->rol="admin";
        $user->save();
        
        DB::table('users')->insert([
            'name'=>"Roberto",
            'email'=>"roberto.cerdan@ikasle.egibide.org",
            'password'=>Hash::make("1234"),
            'rol'=>"admin",
        ]);
        DB::table('users')->insert([
            'name'=>"Raul",
            'email'=>"raul.melgosa@ikasle.egibide.org",
            'password'=>Hash::make("12345678"),
            'rol'=>"tecnico",
        ]);
        DB::table('users')->insert([
            'name'=>"Barbara",
            'email'=>"barbara.lopez@ikasle.egibide.org",
            'password'=>Hash::make("12345678"),
            'rol'=>"operador",
        ]);
        DB::table('users')->insert([
            'name'=>"Nieves",
            'email'=>"nieves@ikasle.egibide.org",
            'password'=>Hash::make("12345678"),
            'rol'=>"jde", //Jefe de equipo
        ]);
        
        

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

        Cliente::factory()->count(5)->create();

        //Ascensor::factory()->count(5)->create();
    }
}
