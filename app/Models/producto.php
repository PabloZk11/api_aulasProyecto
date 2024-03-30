<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class producto extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_producto';
    protected $table = 'productos';

    protected $fillable = [
        "nom_producto",
        "precio_unitario",
        "unidades_disponibles",
        "marca",
        "proveedor_id_proveedor",
        "categoria_producto"
    ];


    public $timestamps = false;

}
