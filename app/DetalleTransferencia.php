<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleTransferencia extends Model
{
    protected $table = 'detalle_transferencias';
    protected $fillable = [
        'idtransferencia', 
        'idarticulo',
        'cantidad',
    ];
    public $timestamps = false;

    public function scopeGetArticulos($query,$id){
            return $query->join('articulos','detalle_transferencias.idarticulo','=','articulos.id')
            ->join('transferencias','detalle_transferencias.idtransferencia','=','transferencias.id')
            ->select('articulos.id','articulos.idpersona','articulos.idcategoria','articulos.idsucursal','articulos.idmarca','articulos.codigo','articulos.nombre','articulos.precio_venta','articulos.precio_compra','articulos.stock','articulos.descripcion','articulos.condicion','detalle_transferencias.cantidad')
            ->where('detalle_transferencias.idtransferencia',$id)->get();
    }
    

}
