<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class AntecedenteLaboral extends Model
{
    //
	protected $table = 'antecedentes_laborales';
    protected $primaryKey = 'id_antecedente_laboral';

    use Sortable;

    public $sortable = ['id_trabajador', 'sin_experiencia', 'trabajo_anterior', 'puesto'];

    protected $fillable = [
		'sin_experiencia',
        'trabajo_anterior',
        'puesto'
    ];

    public function trabajador()
    {
        return $this->belongsTo(Trabajador::class,'id_trabajador');
    }
}
