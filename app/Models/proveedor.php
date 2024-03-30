<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proveedor extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'proveedors';
    protected $primaryKey = 'id_proveedor'; 
    protected $fillable = [
        'productos',
        'doc_proveedor'
    ];

}
