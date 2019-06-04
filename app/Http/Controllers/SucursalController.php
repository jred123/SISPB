<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sucursal;

class SucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $sucursals = Sucursal::orderBy('id', 'desc')->paginate(3);
        }
        else{
            $sucursals = Sucursal::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(3);
        }
        

        return [
            'pagination' => [
                'total'        => $sucursals->total(),
                'current_page' => $sucursals->currentPage(),
                'per_page'     => $sucursals->perPage(),
                'last_page'    => $sucursals->lastPage(),
                'from'         => $sucursals->firstItem(),
                'to'           => $sucursals->lastItem(),
            ],
            'sucursals' => $sucursals
        ];
    }

    public function selectSucursal(Request $request){
        if (!$request->ajax()) return redirect('/');
        $sucursals = Sucursal::where('condicion','=','1')
        ->select('id','nombre')->orderBy('nombre', 'asc')->get();
        return ['sucursals' => $sucursals];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $sucursal = new Sucursal();
        $sucursal->nombre = $request->nombre;
        $sucursal->direccion = $request->direccion;
        $sucursal->telefono = $request->telefono;
        $sucursal->condicion = '1';
        $sucursal->save();
    }
  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $sucursal = Sucursal::findOrFail($request->id);
        $sucursal->nombre = $request->nombre;
        $sucursal->direccion = $request->direccion;
        $sucursal->telefono = $request->telefono;
        $sucursal->condicion = '1';
        $sucursal->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $sucursal = Sucursal::findOrFail($request->id);
        $sucursal->condicion = '0';
        $sucursal->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $sucursal = Sucursal::findOrFail($request->id);
        $sucursal->condicion = '1';
        $sucursal->save();
    }
}
