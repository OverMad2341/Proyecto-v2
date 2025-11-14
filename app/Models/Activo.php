<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activo extends Model
{
    protected $table = 'activos';
    protected $fillable = [
        'codigo',
        'serial',
        'marca',
        'modelo',
        'color',
        'estado',
        'empleado',
        'ubicacion',
        'categoria_id',
        'subcategoria_id',
        'subsubcategoria_id',
    ];
}
