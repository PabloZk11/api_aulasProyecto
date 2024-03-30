<?php

namespace App\Http\Controllers\api;


use App\Http\Controllers\Controller;
use App\Http\Requests\GuardarDevolucionRequest;
use App\Http\Requests\ActualizarDevolucionRequest;
use Illuminate\Http\Request;
use Exception;
use App\Http\Responses\apiResponses;
use App\Models\devolucion;

class devolucionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $devolucion = devolucion::all();
            return  apiResponses::success('Listado de devoluciones: ',205,$devolucion);
        } catch(Exception $e){
            return apiResponses::error('Algo salió mal al llamar los pedidos '.$e->getMessage(),500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GuardarDevolucionRequest $request)
    {
        try{
            $devolucion = devolucion::create([
                "id_producto " => $request -> id_producto ,
                "unidades" => $request -> unidades,
                "id_entrada_devolvuion"  => $request -> id_entrada_devolucion,
              
            ]);
            return apiResponses::success('devolucion guardada exitosamente',201, $devolucion);
        }catch(ValidationException $e){
            return apiResponses::error('Algo falló al intentar guardar la devolucion ',422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_devolucion)
    {
        try{
            $devolucion = devolucion::findOrFail($id_devolucion);  
            return apiResponses::success('devolucion retornado exitosamente: ',200, $devolucion);
        }catch(ModelNotFoundException $e){
            return apiResponses::error('Fallo al buscar la devolucion ',404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ActualizarDevolucionRequest $request, devolucion $id_devolucion)
    {
        try{                  
           
            $id_devolucion->update($request->all());
            return apiResponses::success('Devolución actualizada correctamente',200,$id_devolucion);
        }catch(ModelNotFoundException $e){
            return apiResponses::error('Devolución no encontrada',404);
        }catch (ValidationException $e) {
            return apiResponses::error('Error de validación: ' . $e->getMessage(), 422);
        }catch(Exception $e){
            return apiResponses::error('Error: '.$e->getMessage(),422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
