<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Empleado; 
use App\Models\Gerencia;
use App\Models\Categoria;
use App\Models\Subcategoria; // Asegúrate de tener este modelo
use App\Models\Subsubcategoria; // Asegúrate de tener este modelo

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

    public function gerencia()
    {
        // 2do arg: 'ubicacion' es el nombre de la columna en la tabla activos
        return $this->belongsTo(Gerencia::class, 'ubicacion');
    }

    // Antes: empleado(). Ahora: custodio()
    public function custodio()
    {
        return $this->belongsTo(Empleado::class, 'empleado');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    /**
     * Relación con Subcategoría
     */
    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class, 'subcategoria_id');
    }

    /**
     * Relación con Subsubcategoría
     */
    public function subsubcategoria()
    {
        return $this->belongsTo(Subsubcategoria::class, 'subsubcategoria_id');
    }
}