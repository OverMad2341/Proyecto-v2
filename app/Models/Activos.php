<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activos extends Model
{
    protected $table = 'activos';
    protected $fillable = [
        'codigo',
        'name',
        'serial',
        'marca',
        'modelo',
        'color',
        'estado',
        'empleado',
        'ubicacion',
        'categoria_id',
        'subcategoria_id',
        'sub_subcategoria_id',
    ];
}
