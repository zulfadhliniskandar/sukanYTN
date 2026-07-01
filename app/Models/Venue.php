<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'location_link',
        'description',
    ];

    public function getMapUrlAttribute(): string
    {
        if (empty($this->location_link)) {
            return "https://www.google.com/maps/search/?api=1&query={$this->latitude},{$this->longitude}";
        } else {
            return $this->location_link;
        }
    }

    public function sports()
    {
        return $this->hasMany(Sport::class);
    }
}
