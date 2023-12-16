<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingTShirt extends Model
{
    public function tShirt(): BelongsTo
    {
        return $this->belongsTo(TShirt::class, 't_shirt_id');
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
