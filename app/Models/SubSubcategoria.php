<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubSubcategoria extends Model
{
    protected $table = 'sub_subcategorias';
    
    protected $fillable = [
        'name',
        'subcategoria_id',
    ];
}
