<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NationalAsset extends Model
{
    protected $table = 'national_asset';

    protected $fillable = [
        'name',
        'serial_number',
        'category_id',
        'sub_category_id',
        'location_id',
        'value',
        'acquired_at',
        'status',
    ];

    protected $casts = [
        'acquired_at' => 'date',
    ];
}
