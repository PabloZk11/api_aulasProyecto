<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Http\Responses\apiResponses;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\GuardarPedidoRequest;
use App\Models\pedido;
use Illuminate\Http\Request;

class pedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $pedidos = pedido::all();
            return  apiResponses::success('Listado de pedidos',205,$pedidos);
        } catch(Exception $e){
            return apiResponses::error('Algo salió mal al llamar los pedidos '.$e->getMessage(),500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuardarPedidoRequest $request)
    {
       try{
            $pedidos = pedido::create([
                "unidades"                   => $request -> unidades,
                "id_producto"                => $request -> id_producto,
                "id_admin"                   => $request -> id_admin,
                "id_proveedor"               => $request -> id_proveedor
            ]);
            return apiResponses::success('Pedido guardado exitosamente',201, $pedidos);
        }catch(ValidationException $e){
            return apiResponses::error('Algo falló al intentar guardar el pedido ',422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_pedido)
    {
        try{
            $pedidos = pedido::findOrFail($id_pedido);  
            return apiResponses::success('Pedido retornado exitosamente: ',200, $pedidos);
        }catch(ModelNotFoundException $e){
            return apiResponses::error('Fallo al buscar el pedido ',404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
