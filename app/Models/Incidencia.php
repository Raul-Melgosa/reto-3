<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    use HasFactory;
    public function ascensor()
    {
        return $this->belongsTo('App\Models\Ascensor');
    }
    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente');
    }
    public function tecnico()
    {
        return $this->belongsTo('App\Models\User');
    }
}
