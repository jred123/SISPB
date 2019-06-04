<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Marca;

class MarcaController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $marcas = Marca::orderBy('id', 'desc')->paginate(3);
        }
        else{
            $marcas = Marca::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(3);
        }
        

        return [
            'pagination' => [
                'total'        => $marcas->total(),
                'current_page' => $marcas->currentPage(),
                'per_page'     => $marcas->perPage(),
                'last_page'    => $marcas->lastPage(),
                'from'         => $marcas->firstItem(),
                'to'           => $marcas->lastItem(),
            ],
            'marcas' => $marcas
        ];
    }

    public function selectMarca(Request $request){
        if (!$request->ajax()) return redirect('/');
        $marcas = Marca::where('condicion','=','1')
        ->select('id','nombre')->orderBy('nombre', 'asc')->get();
        return ['marcas' => $marcas];
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
        $marca = new Marca();
        $marca->nombre = $request->nombre;
        $marca->descripcion = $request->descripcion;
        $marca->condicion = '1';
        $marca->save();
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
        $marca = Marca::findOrFail($request->id);
        $marca->nombre = $request->nombre;
        $marca->descripcion = $request->descripcion;
        $marca->condicion = '1';
        $marca->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $marca = Marca::findOrFail($request->id);
        $marca->condicion = '0';
        $marca->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $marca = Marca::findOrFail($request->id);
        $marca->condicion = '1';
        $marca->save();
    }
}
