<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
    protected $primaryKey = 'id_usuario';
    protected $table = 'usuario';

    protected $fillable = [
        "nombre",
        "email",
        "contraseña",
        "rol_usuario",
        "id_tdoc_usuario"
    ];
    
    public $timestamps = false;
}
