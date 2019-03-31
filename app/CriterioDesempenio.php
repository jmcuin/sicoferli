<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class CriterioDesempenio extends Model
{
    //
    protected $table = 'cat_criterios_desempenio';
    protected $primaryKey = 'id_criterio_desempenio';

    use Sortable;

	public $sortable = ['id_criterio_desempenio', 'criterio', 'porcentaje_examen', 'porcentaje_tareas', 'porcentaje_tomas_clase', 'porcentaje_participacion'];

    protected $fillable = [
            'criterio', 
            'porcentaje_examen', 
            'porcentaje_tareas', 
            'porcentaje_tomas_clase', 
            'porcentaje_participacion'
    ];

    public function inscripcion()
    {
        return $this->belongsTo(Inscripcion::class,'id_inscripcion');
    }
}
