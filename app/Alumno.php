<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Alumno extends Model
{
    //
    protected $table = 'alumnos';
    protected $primaryKey = 'id_alumno';

    use Sortable;

    public $sortable = ['id_alumno', 'nombre', 'a_paterno', 'a_materno', 'curp', 'telefono', 'email'];

    protected $fillable = [
            'nombre',
            'a_paterno',
            'a_materno',
            'extranjero',    
            'calle',
            'numero_interior',
            'numero_exterior',
            'colonia',
            'cp'
    ];

    public function municipio()
    {
        return $this->belongsTo(Municipio::class,'id_estado_municipio');
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class,'id_religion');
    }

    public function padecimiento()
    {
        return $this->hasOne(Padecimiento::class,'id_padecimiento');
    }

    public function expediente()
    {
        return $this->hasOne(Expediente_alumno::class,'id_expediente');
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class,'id_inscripcion');
    }

    public function notificaciones()
    {
        return $this->hasMany(Notificacion::class,'id_notificacion');
    }
}
