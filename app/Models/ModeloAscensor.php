<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModeloAscensor extends Model
{
    use HasFactory;
    public function ascensores()
    {
        return $this->hasMany('App\Models\Ascensor');
    }
}
