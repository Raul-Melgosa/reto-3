<?php

namespace Database\Factories;

use App\Models\ModeloAscensor;
use App\Models\Zona;
use Illuminate\Database\Eloquent\Factories\Factory;

class AscensorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $modelos = (new ModeloAscensor())->all();
        $modelo_id = $modelos[random_int(0,count($modelos)-1)];
        $paradas=random_int(3,15);
        return [
            'numeroserie' => uniqid(),
            'calle' => $this->faker->streetAddress(),
            'bloque' => $this->faker->buildingNumber(),
            'paradas' => $paradas,
            'recorrido' => ($paradas * (random_int(23,28)/10)),
            'modelo_ascensor_id' => $modelo_id
        ];
    }
}