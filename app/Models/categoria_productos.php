<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categoria_productos extends Model
{

    public $timestamps = false;

    use HasFactory;
    protected $table = 'categoria_productos';
    protected $primaryKey = 'id_categoria';  
    protected $fillable = [
        'nombre_categoria',
        'descripcion'
    ];
}
