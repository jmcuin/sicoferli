<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conyuge extends Model
{
    protected $table = 'conyuges';
    protected $primaryKey = 'id_conyuge';

    protected $fillable = [
        'nombre',
        'a_paterno',
        'a_materno',
        'fecha_nacimiento',
        'lugar_labora',
        'genero',
    ];
}
