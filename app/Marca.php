<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $fillable = ['nombre','descripcion','condicion'];

    public function marcas()
    {
        return $this->hasMany('App\Articulo');
    }
}
