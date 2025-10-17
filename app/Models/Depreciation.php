<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depreciation extends Model
{
    protected $table = 'depreciation';
    
    protected $fillable = [
        'name',
        'rate',
        'method',
        'description',
    ];

    public $timestamps = true;
}
