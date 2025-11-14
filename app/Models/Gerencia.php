<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gerencia extends Model
{
    protected $table = 'gerencias';
    
    protected $fillable = [
        'name',
    ];
}
