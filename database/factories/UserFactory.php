<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Equipo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $roles = ['tecnico','jde','operador'];
        $rol = $roles[random_int(0,count($roles)-1)];
        if($rol=='operador') {
            return [
                'name' => $this->faker->name(),
                'email' => $this->faker->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => Hash::make("12345678"), // password
                'remember_token' => Str::random(10),
                'rol' => $rol
            ];
        } else {
            $equipos = (new Equipo)->all();
            $equipo = $equipos[random_int(0,count($equipos)-1)];
            return [
                'name' => $this->faker->name(),
                'email' => $this->faker->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => Hash::make("12345678"), // password
                'remember_token' => Str::random(10),
                'rol' => $rol,
                'equipo_id' => $equipo->id
            ];
        }
        
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
