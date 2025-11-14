<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empleado extends Model
{
    use HasFactory;
    protected $table = 'empleados';
    protected $fillable = [
        'cedula',
        'name',
        'surname',
        'email',
        'phone',
    ];
}
