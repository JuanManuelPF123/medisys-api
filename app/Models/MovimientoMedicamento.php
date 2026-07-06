<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimientoMedicamento extends Model
{
    protected $table = 'movimientos_medicamentos';

    protected $fillable = [

        'id_medicamento',

        'tipo_movimiento',

        'cantidad',

        'stock_anterior',

        'stock_actual',

        'observacion'

    ];

    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class, 'id_medicamento');
    }
}
