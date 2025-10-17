<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'person';

    protected $fillable = [
        'first_name',
        'last_name',
        'cedula',
        'birth_date',
        'email',
        'phone',
        'address',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];
}
