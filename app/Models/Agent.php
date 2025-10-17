<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Agent extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * Adjust this if your real table name is different (e.g. 'agents').
     *
     * @var string
     */
    protected $table = 'agent';

    /**
     * The attributes that are mass assignable.
     * Add your agent columns here, for example: ['name', 'email', ...]
     *
     * @var array
     */
    protected $fillable = [
        // Person / contact
        'name',
        'email',
        'phone',
        'address',

        // Organization
        'company',
        'position',

        // Additional
        'notes',
        'active',

        // Audit
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * If your table doesn't have created_at/updated_at set this to false.
     *
     * @var bool
     */
    public $timestamps = true;

}
