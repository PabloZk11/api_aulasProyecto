<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Http\Responses\apiResponses;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrarEntradaRequest;
use App\Models\entrada_mercancia;
use App\Models\producto;
use Illuminate\Http\Request;

class entradaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $entrada = entrada_mercancia::all();
            return  apiResponses::success('Listado de entradas: ',205,$entrada);
        } catch(Exception $e){
            return apiResponses::error('Algo salió mal al retornar las entradas '.$e->getMessage(),500);
        }
    }


    public function store(RegistrarEntradaRequest $request)
    {
       try{

            $producto = producto::findOrFail($request->id_producto);


            $entradas = entrada_mercancia::create([
                "cantidad_unidades"   => $request -> cantidad_unidades,
                "id_producto"         => $request -> id_producto,
                "id_pedido"           => $request -> id_pedido,
                "id_proveedor"        => $request -> id_proveedor
            ]);

            $producto->increment('unidades_disponibles', $request->cantidad_unidades);

            return apiResponses::success('Entrada registrada ',201, $entradas);
        }catch(ValidationException $e){
            return apiResponses::error('Algo falló al registrar la entrada ',422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_entrada)
    {
        try{
            $entrada = entrada_mercancia::findOrFail($id_entrada);  
            return apiResponses::success('Entrada retornada exitosamente: ',200, $entrada);
        }catch(ModelNotFoundException $e){
            return apiResponses::error('Fallo al buscar la entrada ',404);
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
