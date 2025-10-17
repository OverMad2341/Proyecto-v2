<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FederalState extends Model
{
    protected $table = 'federal_state';
    
    protected $fillable = [
        'name',
        'code',
        'country_id',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public $timestamps = true;
}
