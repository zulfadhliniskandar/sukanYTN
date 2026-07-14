<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sport extends Model
{
    protected $table = 'sports';

    protected $fillable = [
        'name',
        'venue_id',
        'type',
    ];

    public function matches(): HasMany
    {
        return $this->hasMany(MatchRecord::class, 'sport_id');
    }

    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }

    public function pic(): HasMany
    {
        return $this->hasMany(PicSport::class, 'sport_id');
    }

    // A Sport has many Registrations (linked via sport_id in registrations table)
    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class, 'sport_id');
    }
}
