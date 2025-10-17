<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'location';

    protected $fillable = [
        'name',
        'address',
        'city',
        'state_id',
        'country_id',
        'postal_code',
    ];

    public $timestamps = true;
}
