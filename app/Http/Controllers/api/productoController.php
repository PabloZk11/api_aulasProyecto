<?php

namespace App\Http\Controllers\api;


use Exception;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\producto;
use App\Http\Requests\guardarrproductoRequest;
use App\Http\Requests\updProductosRequest;
use App\Http\Responses\apiResponses;

class productoController extends Controller
{
/**
     * Listados de todos los productos
     * @OA\Get (
     *     path="/api/producto",
     *     tags={"Productos"},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id_producto",
     *                         type="int",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="nom_producto",
     *                         type="string",
     *                         example="Esfero Pelikan"
     *                     ),
     *                     @OA\Property(
     *                         property="precio_unitario",
     *                         type="double",
     *                         example="1500"
     *                     ),
     *                     @OA\Property(
     *                         property="unidades_disponibles",
     *                         type="int",
     *                         example="30"
     *                     ),
     *                     @OA\Property(
     *                         property="marca",
     *                         type="string",
     *                         example="Pelikan"
     *                     ),
     *   *                     @OA\Property(
     *                         property="proveedor_id_proveedor",
     *                         type="int",
     *                         example="2"
     *                     ),
     *   *                     @OA\Property(
     *                         property="categoria_producto",
     *                         type="int",
     *                         example="1"
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        //return producto::all();
        try {
            $producto = producto::all();
            return apiResponses::success("Listado de productos",200,$producto);
        } catch (Exception $e){
            return apiResponses::error("algo salio mal".$e->getMessage(),404);
        }
    }

/**
     * Ingreso de nuevos productos a la base de datos
     * @OA\Post (
     *     path="/api/producto",
     *     tags={"Productos"},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id_producto",
     *                         type="int",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="nom_producto",
     *                         type="string",
     *                         example="Esfero Pelikan"
     *                     ),
     *                     @OA\Property(
     *                         property="precio_unitario",
     *                         type="double",
     *                         example="1500"
     *                     ),
     *                     @OA\Property(
     *                         property="unidades_disponibles",
     *                         type="int",
     *                         example="30"
     *                     ),
     *                     @OA\Property(
     *                         property="marca",
     *                         type="string",
     *                         example="Pelikan"
     *                     ),
     *   *                     @OA\Property(
     *                         property="proveedor_id_proveedor",
     *                         type="int",
     *                         example="2"
     *                     ),
     *   *                     @OA\Property(
     *                         property="categoria_producto",
     *                         type="int",
     *                         example="1"
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function store(GuardarrproductoRequest $request)
    {
        try{
            $producto = producto::create([
                "nom_producto" => $request -> nom_producto,
                "precio_unitario" => $request -> precio_unitario,
                "unidades_disponibles" => $request -> unidades_disponibles,
                "marca" => $request -> marca,
                "proveedor_id_proveedor" => $request -> proveedor_id_proveedor,
                "categoria_producto" => $request -> categoria_producto
            ]);
            return apiResponses::success('producto guardado exitosamente',201, $producto);
            }catch (ValidationException $e) {
                return apiResponses::error("Algo fallo al guardar el producto",404);
            }
        }

 /**
     * Mostrar la información de un solo producto
     * @OA\Get (
     *     path="/api/producto/{id}",
     *     tags={"Productos"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id_producto",
     *         required=true,
     *         @OA\Schema(type="int")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Property(property="id_producto", type="int", example=1),
     *              @OA\Property(property="nom_producto", type="string", example="Esfero Pelikan"),
     *              @OA\Property(property="precio_unitario", type="double", example="1500"),
     *              @OA\Property(property="unidades_disponibles", type="int", example="30"),
     *              @OA\Property(property="marca", type="string", example="Pelikan"),
     *              @OA\Property(property="proveedor_id_proveedor", type="int", example="2"),
     *              @OA\Property(property="categoria_producto", type="int", example="1")
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="NOT FOUND",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Cliente] #id"),
     *          )
     *      )
     * )
     */
    public function show($id_producto)
    {
        try{
            $producto = producto::findOrFail($id_producto);
            return apiResponses::success('producto retornado exitosamente: ',200, $producto);
        }catch(ModelNotFoundException $e){
            return apiResponses::error('Fallo al buscar el pedido ',404);
        }
    }

/**
     * Actualizacion de un producto especificado
     * @OA\Put (
     *     path="/api/producto/{id}",
     *     tags={"Productos"},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id_producto",
     *                         type="int",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="nom_producto",
     *                         type="string",
     *                         example="Esfero Pelikan"
     *                     ),
     *                     @OA\Property(
     *                         property="precio_unitario",
     *                         type="double",
     *                         example="1500"
     *                     ),
     *                     @OA\Property(
     *                         property="unidades_disponibles",
     *                         type="int",
     *                         example="30"
     *                     ),
     *                     @OA\Property(
     *                         property="marca",
     *                         type="string",
     *                         example="Pelikan"
     *                     ),
     *   *                     @OA\Property(
     *                         property="proveedor_id_proveedor",
     *                         type="int",
     *                         example="2"
     *                     ),
     *   *                     @OA\Property(
     *                         property="categoria_producto",
     *                         type="int",
     *                         example="1"
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function update(updProductosRequest $request, producto $producto)
    {
        try{

            $producto->update($request->all());
                return apiResponses::success('Producto actualizada correctamente',200,$producto);
            }catch(ModelNotFoundException $e){
                return apiResponses::error('Categoria no encontrada',404);
            }catch (ValidationException $e) {
                return apiResponses::error('Error de validación: ' . $e->getMessage(), 404);
            }catch(Exception $e){
                return apiResponses::error('Error: '.$e->getMessage(),422);
            }



        $producto->update($request->all());
        return response()->json([
            "res" => true,
            "mensaje" => "Producto Actualizado"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(producto $producto)
    {
        $producto->delete();
        return response()->json([
            "res" => true,
            "mensaje" => "Producto Eliminado"
        ]);
    }
}
