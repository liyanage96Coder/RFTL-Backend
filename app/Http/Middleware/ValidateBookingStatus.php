<?php

namespace App\Http\Middleware;

use App\BookingStatus;
use Closure;

class ValidateBookingStatus
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $bookingStatus = BookingStatus::latest('id')->first();
        if ($bookingStatus->active) {
            return $next($request);
        }

        return response()->json([
            'error' => true,
            'message' => 'Registration for RFTL 2024 are closed!',
        ]);
    }
}
