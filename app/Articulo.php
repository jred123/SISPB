<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Articulo extends Model
{
    protected $fillable =[
        'idcategoria','idsucursal','idmarca','codigo','nombre','precio_venta','precio_compra','stock','idpersona','descripcion','condicion'
    ];
    public function categoria(){
        return $this->belongsTo('App\Categoria');
    }
    public function sucursal(){
        return $this->belongsTo('App\Sucursal');
    }
    public function marca(){
        return $this->belongsTo('App\Marca');
    }
}
