<?php

namespace App\Exports;

use App\Articulo;
use Maatwebsite\Excel\Concerns\FromCollection;


use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\FromView;

class Articulos2Export implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Articulo::all();
    }
    public function view(): View
    {
        return view('pdf.articulos2', [
            'articulos2' => Articulo::join('categorias','articulos.idcategoria','=','categorias.id')
            ->join('sucursals','articulos.idsucursal','=','sucursals.id') 
            ->join('marcas','articulos.idmarca','=','marcas.id')
            ->join('personas','articulos.idpersona','=','personas.id')
            ->select('articulos.codigo','articulos.nombre','categorias.nombre as nombre_categoria','sucursals.nombre as nombre_sucursal','marcas.nombre as nombre_marca','articulos.precio_venta','articulos.precio_compra','articulos.stock','personas.nombre as nomp','articulos.created_at','articulos.descripcion','articulos.condicion')
            ->where('articulos.stock','>',0)
            ->where('articulos.idcategoria','=',2)
            ->orderBy('articulos.created_at', 'desc')->get()
        ]);
    }
}
