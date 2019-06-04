<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articulo;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ArticulosExport;
use App\Exports\Articulos2Export;

class ArticuloController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $articulos = Articulo::join('categorias','articulos.idcategoria','=','categorias.id')   
            ->join('sucursals','articulos.idsucursal','=','sucursals.id')   
            ->join('marcas','articulos.idmarca','=','marcas.id')
            ->join('personas','articulos.idpersona','=','personas.id')
            ->select('articulos.id','articulos.idcategoria','articulos.idsucursal','articulos.idmarca','articulos.codigo','articulos.nombre','categorias.nombre as nombre_categoria','sucursals.nombre as nombre_sucursal','marcas.nombre as nombre_marca','articulos.precio_venta','articulos.precio_compra','articulos.stock','articulos.created_at','articulos.descripcion','personas.nombre as nomp','articulos.condicion')
            ->where('articulos.stock','>',0)
            ->orderBy('articulos.id', 'desc')->paginate(20);
        }
        else{
            $articulos = Articulo::join('categorias','articulos.idcategoria','=','categorias.id')
            ->join('sucursals','articulos.idsucursal','=','sucursals.id')
            ->join('marcas','articulos.idmarca','=','marcas.id')
            ->join('personas','articulos.idpersona','=','personas.id')
            ->select('articulos.id','articulos.idcategoria','articulos.idsucursal','articulos.idmarca','articulos.codigo','articulos.nombre','categorias.nombre as nombre_categoria','sucursals.nombre as nombre_sucursal','marcas.nombre as nombre_marca','articulos.precio_venta','articulos.precio_compra','articulos.stock','articulos.created_at','articulos.descripcion','personas.nombre as nomp','articulos.condicion')
            ->where('articulos.stock','>',0)
            ->where('articulos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('articulos.id', 'desc')->paginate(20);
        }

        return [
            'pagination' => [
                'total'        => $articulos->total(),
                'current_page' => $articulos->currentPage(),
                'per_page'     => $articulos->perPage(),
                'last_page'    => $articulos->lastPage(),
                'from'         => $articulos->firstItem(),
                'to'           => $articulos->lastItem(),
            ],
            'articulos' => $articulos
        ];
        
    }
    public function buscarfecha(Request $request){
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->fecha;

            $articulos = Articulo::join('categorias','articulos.idcategoria','=','categorias.id')
            ->join('sucursals','articulos.idsucursal','=','sucursals.id')
            ->join('marcas','articulos.idmarca','=','marcas.id')
            ->join('personas','articulos.idpersona','=','personas.id')
            ->select('articulos.id','articulos.idcategoria','articulos.idsucursal','articulos.idmarca','articulos.codigo','articulos.nombre','categorias.nombre as nombre_categoria','sucursals.nombre as nombre_sucursal','marcas.nombre as nombre_marca','articulos.precio_venta','articulos.precio_compra','articulos.stock','articulos.created_at','articulos.descripcion','personas.nombre as nomp','articulos.condicion')
            ->where('articulos.stock','>',0)
            ->whereDate('articulos.created_at',$buscar)
            ->orderBy('articulos.id', 'desc')->paginate(20);
        
        return [
            'pagination' => [
                'total'        => $articulos->total(),
                'current_page' => $articulos->currentPage(),
                'per_page'     => $articulos->perPage(),
                'last_page'    => $articulos->lastPage(),
                'from'         => $articulos->firstItem(),
                'to'           => $articulos->lastItem(),
            ],
            'articulos' => $articulos
        ];

    }
    public function listarArticulo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $articulos = Articulo::join('categorias','articulos.idcategoria','=','categorias.id')
            ->join('sucursals','articulos.idsucursal','=','sucursals.id')
            ->join('marcas','articulos.idmarca','=','marcas.id')
            ->select('articulos.id','articulos.idcategoria','articulos.idsucursal','articulos.idmarca','articulos.codigo','articulos.nombre','categorias.nombre as nombre_categoria','sucursals.nombre as nombre_sucursal','marcas.nombre as nombre_marca','articulos.precio_venta','articulos.stock','articulos.descripcion','articulos.condicion')
            ->where('articulos.stock','>',0)
            ->where('articulos.condicion','=',1)
            ->orderBy('articulos.id', 'desc')->paginate(10);
        }
        else{
            $articulos = Articulo::join('categorias','articulos.idcategoria','=','categorias.id')
            ->join('sucursals','articulos.idsucursal','=','sucursals.id')
            ->join('marcas','articulos.idmarca','=','marcas.id')
            ->select('articulos.id','articulos.idcategoria','articulos.idsucursal','articulos.idmarca','articulos.codigo','articulos.nombre','categorias.nombre as nombre_categoria','sucursals.nombre as nombre_sucursal','marcas.nombre as nombre_marca','articulos.precio_venta','articulos.stock','articulos.descripcion','articulos.condicion')
            ->where('articulos.'.$criterio, 'like', '%'. $buscar . '%')
            ->where('articulos.stock','>',0)
            ->where('articulos.condicion','=',1)
            ->orderBy('articulos.id', 'desc')->paginate(10);
        }
        

        return ['articulos' => $articulos];
    }
    public function listarArticuloVenta(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $articulos = Articulo::join('categorias','articulos.idcategoria','=','categorias.id')
            ->join('sucursals','articulos.idsucursal','=','sucursals.id')
            ->join('marcas','articulos.idmarca','=','marcas.id')
            ->select('articulos.id','articulos.idcategoria','articulos.idsucursal','articulos.idmarca','articulos.codigo','articulos.nombre','categorias.nombre as nombre_categoria','sucursals.nombre as nombre_sucursal','marcas.nombre as nombre_marca','articulos.precio_venta','articulos.stock','articulos.descripcion','articulos.condicion')
            ->where('articulos.stock','>','0')
            ->where('articulos.stock','>',0)
            ->where('articulos.condicion','=',1)
            ->orderBy('articulos.id', 'desc')->paginate(10);
        }
        else{
            $articulos = Articulo::join('categorias','articulos.idcategoria','=','categorias.id')
            ->join('sucursals','articulos.idsucursal','=','sucursals.id')
            ->join('marcas','articulos.idmarca','=','marcas.id')
            ->select('articulos.id','articulos.idcategoria','articulos.idsucursal','articulos.idmarca','articulos.codigo','articulos.nombre','categorias.nombre as nombre_categoria','sucursals.nombre as nombre_sucursal','marcas.nombre as nombre_marca','articulos.precio_venta','articulos.stock','articulos.descripcion','articulos.condicion')
            ->where('articulos.'.$criterio, 'like', '%'. $buscar . '%')
            ->where('articulos.stock','>','0')
            ->where('articulos.stock','>',0)
            ->where('articulos.condicion','=',1)
            ->orderBy('articulos.id', 'desc')->paginate(10);
        }
         

        return ['articulos' => $articulos];
    }
    public function listarPdf(){
        $articulos = Articulo::join('categorias','articulos.idcategoria','=','categorias.id')
        ->join('sucursals','articulos.idsucursal','=','sucursals.id')
        ->join('marcas','articulos.idmarca','=','marcas.id')
        ->join('personas','articulos.idpersona','=','personas.id')
        ->select('articulos.id','articulos.idcategoria','articulos.idsucursal','articulos.idmarca','articulos.codigo','articulos.nombre','categorias.nombre as nombre_categoria','sucursals.nombre as nombre_sucursal','marcas.nombre as nombre_marca','articulos.precio_venta','articulos.precio_compra','articulos.stock','articulos.created_at','articulos.descripcion','personas.nombre as nomp','articulos.condicion')
        ->where('articulos.stock','>',0)
        ->orderBy('articulos.created_at', 'desc')->get();

        $cont= count($articulos);

        $pdf = \PDF::loadView('pdf.articulospdf',['articulos'=>$articulos,'cont'=>$cont]);
        return $pdf->download('articulos.pdf');
    }
    public function excel(){
        
        return Excel::download(new ArticulosExport, 'articulosCelulares.xlsx');
    }
    public function excelAccs(){
        
        return Excel::download(new Articulos2Export, 'articulosAccesorios.xlsx');
    }

    public function buscarArticulo(Request $request ){
        if (!$request->ajax()) return redirect('/');

        $filtro = $request->filtro;
        $articulos = Articulo::where('codigo','=', $filtro)
        ->where('articulos.condicion','=',1)
        ->select('id', 'nombre')->orderBy('nombre', 'asc')->take(1)->get();

        return ['articulos' => $articulos];
    }
    public function buscarArticuloVenta(Request $request ){
        if (!$request->ajax()) return redirect('/');

        $filtro = $request->filtro;
        $articulos = Articulo::where('codigo','=', $filtro)
        ->select('id', 'nombre','stock','precio_venta')
        ->where('stock','>','0')
        ->where('articulos.condicion','=',1)
        ->orderBy('nombre', 'asc')->take(1)->get();

        return ['articulos' => $articulos];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $articulo = new Articulo();
        $articulo->idcategoria = $request->idcategoria;
        $articulo->idsucursal = $request->idsucursal;
        $articulo->idmarca = $request->idmarca;
        $articulo->codigo = $request->codigo;
        $articulo->nombre = $request->nombre;
        $articulo->precio_venta = $request->precio_venta;
        $articulo->precio_compra = $request->precio_compra;
        $articulo->stock = $request->stock;
        $articulo->descripcion = $request->descripcion;
        $articulo->condicion = '1';
        $articulo->save();
    }

    public function agregar(Request $request)
    {
        $articulos = $request->data2;
        $array = [];

        if (!$request->ajax()) return redirect('/');
        foreach($articulos as $ep=>$det)
            {
                $articulo = new Articulo();
                
                $det = $articulo->create([
                    'idcategoria' => $det['idcategoria'],
                    'idsucursal' => $det['idsucursal'],
                    'idmarca' => $det['idmarca'],
                    'codigo' => $det['codigo'],
                    'idpersona' => $request->proveedor,
                    'nombre' => $det['articulo'],
                    'precio_venta' => $det['precioMercado'],
                    'precio_compra' => $det['precio'],
                    'stock' => $det['cantidad'],
                    'descripcion' => '',
                    'condicion' => '1'
                ]);
                //dd($det);
                array_push($array, $det->id);
                
            }
            
                return $array;
            
            
    }
    public function agregarModoPago(Request $request)
    {
        $articulos = $request->data2;
        $array = [];

        if (!$request->ajax()) return redirect('/');
        foreach($articulos as $ep=>$det)
            {
                $articulo = new Articulo();
                
                $det = $articulo->create([
                    'idcategoria' => $det['idcategoria'],
                    'idsucursal' => $det['idsucursal'],
                    'idmarca' => $det['idmarca'],
                    'codigo' => $det['codigo'],
                    'nombre' => $det['articulo'],
                    'precio_venta' => $det['precioMercado'],
                    'precio_compra' => $det['precioCompra'],
                    'idpersona' => $request->cliente,
                    'stock' => 1,
                    'descripcion' => $det['descripcion'],
                    'condicion' => '4'
                ]);
                array_push($array, $det->id);
                
            }
            
                return $array;
            
            
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $articulo = Articulo::findOrFail($request->id);
        $articulo->idcategoria = $request->idcategoria;
        $articulo->idsucursal = $request->idsucursal;
        $articulo->idmarca = $request->idmarca;
        $articulo->codigo = $request->codigo;
        $articulo->nombre = $request->nombre;
        $articulo->precio_venta = $request->precio_venta;
        $articulo->stock = $request->stock;
        $articulo->descripcion = $request->descripcion;
        $articulo->condicion = '1';
        $articulo->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $articulo = Articulo::findOrFail($request->id);
        $articulo->condicion = '0';
        $articulo->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $articulo = Articulo::findOrFail($request->id);
        $articulo->condicion = '1';
        $articulo->save();
    }
    public function devolver(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $articulo = Articulo::findOrFail($request->id);
        $articulo->condicion = '2';
        $articulo->save();
    }

}
