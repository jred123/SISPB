<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $fillable = ['nombre','direccion','telefono','condicion'];

    public function articulos()
    {
        return $this->hasMany('App\Articulo');
    }
}
