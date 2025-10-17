<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationalUni extends Model
{
    protected $table = 'organizational_unit';

    protected $fillable = [
        'name',
        'code',
        'parent_id',
        'description',
    ];
}
