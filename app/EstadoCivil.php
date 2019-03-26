<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class EstadoCivil extends Model
{
    //
    protected $table = 'cat_estado_civils';
    protected $primaryKey = 'id_estado_civil';

    use Sortable;

	public $sortable = ['id_estado_civil', 'estado_civil'];

    protected $fillable = [
            'estado_civil'
    ];

    public function trabajadores()
    {
        return $this->hasMany(Trabajador::class,'id_trabajador');
    }

    public function familiarDeTrabajador()
    {
        return $this->hasMany(Familiar_trabajador::class,'id_estado_civil');
    }
}
