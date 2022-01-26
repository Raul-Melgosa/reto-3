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
    public function tecnicos()
    {
        return $this->hasMany('App\Models\User');
    }
    public function jefeDeEquipo()
    {
        return $this->hasOne('App\Models\User');
    }
}
