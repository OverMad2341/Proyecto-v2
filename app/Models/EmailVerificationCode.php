<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailVerificationCode extends Model
{
    use HasFactory;

    /**
     * La clave primaria no es un 'id' autoincremental.
     */
    protected $primaryKey = 'email';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Solo 'created_at' es automático, 'updated_at' no lo usamos.
     */
    const UPDATED_AT = null;

    protected $fillable = [
        'email',
        'code',
    ];
}