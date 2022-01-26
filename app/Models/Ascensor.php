<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ascensor extends Model
{
    use HasFactory;
    public function zona()
    {
        return $this->belongsTo('App\Models\Zona');
    }
    public function modeloAscensor()
    {
        return $this->belongsTo('App\Models\ModeloAscensor');
    }
    public function incidencias()
    {
        return $this->hasMany('App\Models\Incidencia');
    }
}
