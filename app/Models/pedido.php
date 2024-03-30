<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pedido extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'pedido';
    protected $primaryKey = 'id_pedido'; 
    protected $fillable = [
        'unidades',
        'id_producto',
        'id_admin',
        'id_proveedor'
    ];

}
