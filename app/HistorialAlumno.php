<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistorialAlumno extends Model
{
    //
    protected $table = 'historial_alumno';
    protected $primaryKey = 'id_historial_alumno';

    protected $fillable = [
        'narrativa'
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class,'id_grupo');
    }

    public function alumno()
    {
        return $this->belongsTo(Alumno::class,'id_alumno');
    }
}
