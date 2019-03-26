<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Familiar_trabajador extends Model
{
    //
    protected $table = 'familiar_trabajadors';
    protected $primaryKey = 'id_familiar_trabajador';

    protected $fillable = [
        'nombre',
        'a_paterno',
        'a_materno',
        'fecha_nacimiento',
        'ocupacion',
        'genero',
        'vive',
    ];

    public function estadoCivil()
    {
        return $this->belongsTo(EstadoCivil::class,'id_estado_civil');
    }

    public function parentesco()
    {
        return $this->belongsTo(Parentesco::class,'id_parentesco');
    }

    public function trabajador()
    {
        return $this->belongsTo(Trabajador::class,'id_trabajador');
    }
}
