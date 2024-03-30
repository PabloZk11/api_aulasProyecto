<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuardarCategoriaRequest;
use App\Http\Requests\updateCategoriaRequest;
use App\Http\Responses\apiResponses;
use App\Models\categoria_productos;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class categoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $categorias = categoria_productos::all();
            return  apiResponses::success('Lista de categorias',205,$categorias);
        } catch(Exception $e){
            return apiResponses::error('Algo salió mal al llamar las categorías '.$e->getMessage(),500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuardarCategoriaRequest $request)
    {
        try{
            $categorias = categoria_productos::create([
                "nombre_categoria"  => $request -> nombre_categoria,
                "descripcion"  => $request -> descripcion
            ]);
            return apiResponses::success('Categoria registrada exitosamente',201, $categorias);
        }catch(ValidationException $e){
            return apiResponses::error('Algo falló al intentar registrar la categoría ',422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_categoria
     * @return \Illuminate\Http\Response
     */
    public function show($id_categoria)
    {
        try{
            $categorias = categoria_productos::findOrFail($id_categoria);
            return apiResponses::success('Categoria retornada exitosamente: ',200, $categorias);
        }catch(ModelNotFoundException $e){
            return apiResponses::error('Fallo al buscar la categoría ',404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateCategoriaRequest $request,  $id_categoria)
    {
        try{                  
            $categoria = categoria_productos::findOrFail($id_categoria);
            $request->validate([
                'nombre_categoria' => ['required',Rule::unique('categoria_productos')->ignore($categoria)],
                'descripcion' => ['required',Rule::unique('categoria_productos')->ignore($categoria)]
            ]);
            $categoria->update($request->all());
            return apiResponses::success('Categoría actualizada correctamente',200,$categoria);
        }catch(ModelNotFoundException $e){
            return apiResponses::error('Categoria no encontrada',404);
        }catch (ValidationException $e) {
            return apiResponses::error('Error de validación: ' . $e->getMessage(), 422);
        }catch(Exception $e){
            return apiResponses::error('Error: '.$e->getMessage(),422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id_categoria)
    {
        try{
            $categorias = categoria_productos::findOrFail($id_categoria); 
            $categorias->DELETE();
            return apiResponses::success('categoría eliminada exitosamente', 200);
        }catch(ModelNotFoundException $e){
            return apiResponses::error('error al eliminar la categoría',404);
        }
    }
}
