<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transferencia extends Model
{
    protected $fillable = [
        'idusuario',
        'tipo_comprobante',
        'num_comprobante',
        'fecha_hora',
        'origen',
        'destino',
        'total',
        'estado'
     ];
     public function usuario()
     {
         return $this->belongsTo('App\User');
     }
}
