<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NationalAssetAssignament extends Model
{
    protected $table = 'national_asset_assignament';

    protected $fillable = [
        'national_asset_id',
        'assigned_to_id',
        'assigned_at',
        'notes',
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
    ];
}
