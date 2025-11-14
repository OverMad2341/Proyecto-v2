<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubSubcategoria extends Model
{
    protected $table = 'subsubcategorias';
    
    protected $fillable = [
        'name',
        'subcategoria_id',
    ];
}
