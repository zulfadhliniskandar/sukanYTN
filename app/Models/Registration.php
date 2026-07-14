<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Registration extends Model
{
    protected $fillable = [
        'groupName',
        'student_id',
        'name',
        'status',
        'sport_id',
        'user_id',
        
    ];

    protected $casts = [
        'name' => 'array',
        'student_id' => 'array',
    ];

    public function sport(): BelongsTo
    {
        return $this->belongsTo(Sport::class, 'sport_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
