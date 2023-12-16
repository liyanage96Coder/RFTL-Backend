<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TShirt extends Model
{
    protected $fillable = [
        'active'
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class)->where('active', true);
    }
}
