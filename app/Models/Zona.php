<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    use HasFactory;
    public function ascensores()
    {
        return $this->hasMany('App\Models\Ascensor');
    }
    public function equipo()
    {
        return $this->hasOne('App\Models\Equipo');
    }
}
