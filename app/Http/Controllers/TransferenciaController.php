<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Transferencia;
use App\DetalleTransferencia;
use App\Articulo;
use App\Sucursal;
use App\User;
use App\Notifications\NotifyAdmin;

class TransferenciaController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $buscar = $request->buscar;
        $criterio = $request->criterio;
         
        if ($buscar==''){
            $transferencias = Transferencia::join('users','transferencias.idusuario','=','users.id')
            ->select('transferencias.id','transferencias.tipo_comprobante',
            'transferencias.num_comprobante','transferencias.fecha_hora','transferencias.Receptor','transferencias.origen','transferencias.destino','transferencias.total',
            'transferencias.estado','users.usuario')
            ->where('transferencias.estado','!=','Eliminada')
            ->orderBy('transferencias.id', 'desc')->paginate(10);
        }
        else{
            $transferencias = Transferencia::join('users','transferencias.idusuario','=','users.id')
            ->select('transferencias.id','transferencias.tipo_comprobante',
            'transferencias.num_comprobante','transferencias.fecha_hora','transferencias.Receptor','transferencias.origen','transferencias.destino','transferencias.total',
            'transferencias.estado','users.usuario')
            ->where('transferencias.'.$criterio, 'like', '%'. $buscar . '%')->orderBy('transferencias.id', 'desc')->paginate(5);
        }
        
        return [
            'pagination' => [
                'total'        => $transferencias->total(),
                'current_page' => $transferencias->currentPage(),
                'per_page'     => $transferencias->perPage(),
                'last_page'    => $transferencias->lastPage(),
                'from'         => $transferencias->firstItem(),
                'to'           => $transferencias->lastItem(),
            ],
            'transferencias' => $transferencias
        ];
    }
    public function obtenerCabecera(Request $request){
        if (!$request->ajax()) return redirect('/');
 
        $id = $request->id;
         

        $transferencia = Transferencia::join('users','transferencias.idusuario','=','users.id')
        ->select('transferencias.id','transferencias.tipo_comprobante','transferencias.num_comprobante','transferencias.fecha_hora','transferencias.origen','transferencias.destino','transferencias.total',
        'transferencias.estado','users.usuario')
        ->where('transferencias.id','=',$id)
        ->orderBy('transferencias.id', 'desc')->take(1)->get();

         
        return [
           
            'transferencia' => $transferencia
        ];
    }
    public function obtenerDetalles(Request $request){
        if (!$request->ajax()) return redirect('/');
 
        $id = $request->id;
         
        $detalles = DetalleTransferencia::join('articulos','detalle_transferencias.idarticulo','=','articulos.id')
        ->select('detalle_transferencias.cantidad','articulos.nombre as articulo','articulos.codigo')
        ->where('detalle_transferencias.idtransferencia','=',$id)
        ->orderBy('detalle_transferencias.id', 'desc')->get();

         
        return [
           
            'detalles' => $detalles
        ];
    }
    public function pdf(Request $request,$id){
        $transferencia = Transferencia::join('users','transferencias.idusuario','=','users.id')
        ->select('transferencias.id','transferencias.tipo_comprobante','transferencias.num_comprobante','transferencias.Receptor','transferencias.created_at','transferencias.origen','transferencias.destino','transferencias.total',
        'transferencias.estado','users.usuario')
        ->where('transferencias.id','=',$id)
        ->orderBy('transferencias.id','desc')->take(1)->get();

        $detalles = DetalleTransferencia::join('articulos','detalle_transferencias.idarticulo','=','articulos.id')
        ->select('detalle_transferencias.cantidad','articulos.codigo as imei',
        'articulos.nombre as articulo')
        ->where('detalle_transferencias.idtransferencia','=',$id)
        ->orderBy('detalle_transferencias.id','desc')->get();

        $numTransferencia=Transferencia::select('num_comprobante')->where('id',$id)->get();

        $pdf = \PDF::loadView('pdf.transferencia',['transferencia'=>$transferencia,'detalles'=>$detalles]);
        return $pdf->download('transferencia-'.$numTransferencia[0]->num_comprobante.'.pdf');

    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        try{
            DB::beginTransaction();
 
            $mytime= Carbon::now('America/La_Paz');
 
            $transferencia = new Transferencia();
            $transferencia->idusuario = \Auth::user()->id;
            $transferencia->tipo_comprobante = $request->tipo_comprobante;
            $transferencia->num_comprobante = $request->num_comprobante;
            $transferencia->fecha_hora = $mytime->toDateTimeString();
            $transferencia->origen = $request->origen;
            $transferencia->destino = $request->destino;
            $transferencia->total = $request->total;
            $transferencia->estado = 'Pendiente';

            $transferencia->save();
 
            $detalles = $request->data;//Array de detalles
            //Recorro todos los elementos
 
            foreach($detalles as $ep=>$det)
            {
                $detalle = new DetalleTransferencia();
                $detalle->idtransferencia = $transferencia->id;
                $detalle->idarticulo = $det['idarticulo'];
                $detalle->cantidad = $det['cantidad'];          
                $detalle->save();
            }
            

            $fechaActual= date('Y-m-d');
            $numVentas = DB::table('ventas')->whereDate('created_at', $fechaActual)->count();
            $numTransferencia = DB::table('transferencias')->whereDate('created_at', $fechaActual)->count();

            $arregloDatos = [
                'ventas' => [
                            'numero' => $numVentas,
                            'msj' => 'Ventas'
                        ],
                'transferencias' => [
                            'numero' => $numTransferencia,
                            'msj' => 'transferencias'
                ]
            ];
            $allUsers = User::all();

            foreach ($allUsers as $notificar){
                User::findOrFail($notificar->id)->notify(new NotifyAdmin($arregloDatos));
            }

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }
    public function registro(Request $request){

        //if (!$request->ajax()) return redirect('/');
        $transferencia = Transferencia::findOrFail($request->idc);
        $transferencia->Receptor = \Auth::user()->usuario;
        $transferencia->estado = 'Registrado';
        $transferencia->save();
        //dd($request);
        $destinoid = (Sucursal::where('nombre',$request->data)->get())[0];
        //dd($destinoid->toArray());
        $articulos = DetalleTransferencia::getArticulos($request->idc);
        for($i=0;$i<count($articulos);$i++){
            $arti=$articulos[$i];
        $articulo = new Articulo();
        $articulo->idcategoria = $arti->idcategoria;
        $articulo->idsucursal = $destinoid->id;
        $articulo->idmarca = $arti->idmarca;
        $articulo->idpersona = $arti->idpersona;
        $articulo->codigo = $arti->codigo;
        $articulo->nombre = $arti->nombre;
        $articulo->precio_venta = $arti->precio_venta;
        $articulo->precio_compra = $arti->precio_compra;
        $articulo->stock = $arti->cantidad;
        $articulo->descripcion = $arti->descripcion;
        $articulo->condicion = '1';
        $articulo->save();  
        

        }
        
    }
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $transferencia = Transferencia::findOrFail($request->id);
        $transferencia->estado = 'Anulado';
        $transferencia->save();
    }
    public function eliminar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $transferencia = Transferencia::findOrFail($request->id);
        $transferencia->estado = 'Eliminada';
        $transferencia->save();
    }
}
