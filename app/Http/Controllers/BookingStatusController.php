<?php

namespace App\Http\Controllers;

use App\BookingStatus;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookingStatusController extends Controller
{
    function get(): JsonResponse
    {
        try {
            return response()->json([
                'error' => false,
                'message' => 'Successfully retrieved booking status',
                'bookingStatus' => BookingStatus::latest('id')->first(),
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while getting booking status!',
        ]);
    }

    function update(Request $request): JsonResponse
    {
        try {
            $user = null;
            $token = null;
            if ($request->header('Authorization') && $request->header('Authorization') !== 'null') {
                $token = $request->header('Authorization');
            } elseif ($request->header('Token') && $request->header('Token') !== 'null') {
                $token = $request->header('Token');
            }
            if ($token) {
                $user = User::where('token', $token)->first();
            }

            $newBookingStatus = new BookingStatus();
            $newBookingStatus->active = $request->active;
            $newBookingStatus->user_id = $user->id;
            $newBookingStatus->save();

            return response()->json([
                'error' => false,
                'message' => 'Successfully updated booking status',
                'bookingStatus' => $newBookingStatus,
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while updating booking status!',
        ]);
    }
}
