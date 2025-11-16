<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Empleado; 
use App\Models\Gerencia;
use App\Models\Categoria;

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

    public function ubicacion()
    {
        // 1er arg: El modelo al que se conecta
        // 2do arg: El nombre de la columna FK en ESTA tabla ('activos')
        return $this->belongsTo(Gerencia::class, 'ubicacion');
    }

    /**
     * Define la relación con Empleado.
     */
    public function empleado()
    {
        // La FK se llama 'empleado'
        return $this->belongsTo(Empleado::class, 'empleado');
    }

    /**
     * Define la relación con Categoria.
     */
    public function categoria()
    {
        // La FK se llama 'categoria_id'
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}
