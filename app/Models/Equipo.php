<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;
    public function zona()
    {
        return $this->belongsTo('App\Models\Zona');
    }
    /*
    public function tecnicos()
    {
        return $this->hasMany('App\Models\User');
    }
    public function jefeDeEquipo()
    {
        return $this->hasOne('App\Models\User');
    }
    */
    public function personal()
    {
        return $this->hasMany(User::class);
    }

    public function tecnicos()
    {
        $personal = $this->personal;
        $devolver = [];
        foreach ($personal as $persona) {
            if($persona->rol=='tecnico') {
                array_push($devolver,$persona);
            }
        }
        if(count($devolver)==0) {
            $devolver = null;
        }
        return $devolver;
    }

    public function jefeDeEquipo()
    {
        $personal = $this->personal;
        foreach ($personal as $persona) {
            if($persona->rol=='jde') {
                return $persona;
            }
        }
        return null;
    }
}
