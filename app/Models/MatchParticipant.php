<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class MatchParticipant extends Model
{
    protected $fillable = [
        'match_id',
        'user_id',
        'contingent_id',
        'score',
        'result',
        'results'
    ];

    public function match(): BelongsTo
    {
        return $this->belongsTo(MatchRecord::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function contingent(): BelongsTo
    {
        return $this->belongsTo(Contingent::class);
    }
}
