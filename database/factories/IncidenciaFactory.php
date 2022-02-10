<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\Cliente;
use \App\Models\Ascensor;
use \App\Models\Equipo;
use \App\Models\User;
use DateTime;
use Faker\Provider\cs_CZ\DateTime as Cs_CZDateTime;

class IncidenciaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $urgente = random_int(0,5);
        
        $tipos = ['Bandalismo (estético)', 'Funcionamiento (mecánico)', 'Funcionamiento (eléctrico)'];
        $tipo = $tipos[random_int(0,(count($tipos)-1))];
        
        $estados = ['Pendiente','En proceso', 'Resuelta'];
        $estado = $estados[random_int(0,(count($estados)-1))];
        
        $clientes = (new Cliente)->all();
        $cliente = $clientes[random_int(0,(count($clientes)-1))];
        
        $ascensores = (new Ascensor)->all();
        $ascensor = $ascensores[random_int(0,(count($ascensores)-1))];
        
        $zona = $ascensor->zona_id;
        $equipo = Equipo::where('zona_id','=',$zona)->first();
        
        $tecnicos = $equipo->tecnicos();
        $tecnico = $tecnicos[random_int(0,(count($tecnicos)-1))];

        $comentarioOperador = $this->faker->realTextBetween('200','300');
        $comentarioTecnico=null;

        if($estado=='En proceso' || $estado=='Resuelta') {
            $comentarioTecnico = $this->faker->realTextBetween('200','300');
        }
        $created_at = $this->faker->dateTimeBetween('-1460 days', 'now');
        if ($urgente == 1) { //Es urgente
            if($estado == 'Resuelta') { //Es urgente y ha finalizado
                return [
                    'urgente' => true,
                    'estado' => $estado,
                    'fecha_inicio' => date('Y-m-d', time()),
                    'created_at' => $created_at,
                    'fecha_fin' => $this->faker->dateTimeBetween('0 week', '+1 week'),
                    'tipoaveria' => $tipo,
                    'cliente_id' => $cliente->id,
                    'ascensor_id' => $ascensor->id,
                    'tecnico_id' => $tecnico->id,
                    'comentarioOperador' => $comentarioOperador,
                    'comentarioTecnico' => $comentarioTecnico
                ];
            } else { //Es urgente y no ha finalizado
                return [
                    'urgente' => true,
                    'estado' => $estado,
                    'fecha_inicio' => date('Y-m-d', time()),
                    'created_at' => $created_at,
                    'tipoaveria' => $tipo,
                    'cliente_id' => $cliente->id,
                    'ascensor_id' => $ascensor->id,
                    'tecnico_id' => $tecnico->id,
                    'comentarioOperador' => $comentarioOperador,
                    'comentarioTecnico' => $comentarioTecnico
                ];
            }
            
        } else { //No es urgente
            if($estado == 'Resuelta') { //No es urgente y esta finalizada
                return [
                    'urgente' => false,
                    'created_at' => $created_at,
                    'estado' => $estado,
                    'fecha_inicio' => date('Y-m-d', time()),
                    'fecha_fin' => $this->faker->dateTimeBetween('0 week', '+1 week'),
                    'tipoaveria' => $tipo,
                    'cliente_id' => $cliente->id,
                    'ascensor_id' => $ascensor->id,
                    'tecnico_id' => $tecnico->id,
                    'comentarioOperador' => $comentarioOperador,
                    'comentarioTecnico' => $comentarioTecnico
                ];
            } else { // No es urgente y esta sin finalizar
                return [
                    'urgente' => false,
                    'created_at' => $created_at,
                    'estado' => $estado,
                    'fecha_inicio' => date('Y-m-d', time()),
                    'tipoaveria' => $tipo,
                    'cliente_id' => $cliente->id,
                    'ascensor_id' => $ascensor->id,
                    'tecnico_id' => $tecnico->id,
                    'comentarioOperador' => $comentarioOperador,
                    'comentarioTecnico' => $comentarioTecnico
                ];
            }
        }
        
    }
}
