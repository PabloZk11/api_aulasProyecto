<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\productoController;
use App\Http\Controllers\api\re_salidaController;
use App\Http\Controllers\api\vendedorController;
use App\Http\Controllers\api\facturaController;
use App\Http\Controllers\api\devolucionController;
use App\Http\Controllers\api\pedidoController;
use App\Http\Controllers\api\usuarioController;
use App\Http\Controllers\API\categoriaController;
use App\Http\Controllers\API\proveedorController;
use App\Http\Controllers\API\entradaController;
use App\Http\Controllers\API\facturaEntradaController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Rutas Tabla Productos

Route::apiResource("producto",productoController::class);


// Rutas Tabla Registro_Salidas

Route::apiResource("salida",re_salidaController::class);

// Rutas Tabla Usuario

Route::apiResource("usuario",usuarioController::class);

// rutas factura_salida
Route::apiResource("factura_salida",facturaController::class);

// rutas devolucion
Route::apiResource("devolucion",devolucionController::class);


//ruta vendedor

Route::apiResource('pedido',pedidoController::class);
Route::apiResource('categoria_productos',categoriaController::class);
Route::apiResource('entrada_mercancia',entradaController::class);
Route::apiResource('factura_entrada',facturaEntradaController::class);
Route::apiResource('proveedor',proveedorController::class);