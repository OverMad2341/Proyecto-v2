<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    protected $table = 'subcategorias';
    
    protected $fillable = [
        'name',
        'categoria_id',
    ];
}
