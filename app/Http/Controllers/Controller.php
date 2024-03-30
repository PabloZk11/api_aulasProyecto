<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
* @OA\Info(
*             title="Documentacion API - Aulas", 
*             version="1.0",
*             description="Listado de endpoints de producto - explicacion"
* )
*
* @OA\Server(url="http://apiaulas.test/")
*/

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
