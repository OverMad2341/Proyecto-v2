<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovementHistory extends Model
{
    protected $table = 'movent_history';

    protected $fillable = [
        'title',
        'description',
        'date',
        'reference_id',
        'active',
    ];

    protected $casts = [
        'date' => 'datetime',
        'active' => 'boolean',
    ];

    public $timestamps = true;
}
