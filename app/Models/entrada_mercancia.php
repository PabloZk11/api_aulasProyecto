<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class entrada_mercancia extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'entrada_mercancias';
    protected $primaryKey = 'id_entrada'; 
    protected $fillable = [
        'cantidad_unidades',
        'id_producto',
        'id_pedido',
        'id_proveedor'
    ];

}
