<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class MatchRecord extends Model
{
    protected $fillable = [
        'sport_id', 
        'title', 
        'status', 
        'start_time'
    ];

    public function sport(): BelongsTo
    {
        return $this->belongsTo(Sport::class);
    }

     public function participants(): HasMany
    {
        return $this->hasMany(MatchParticipant::class, 'match_id');
    }

}
