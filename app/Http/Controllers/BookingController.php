<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    function index(): JsonResponse
    {
        try {
            return response()->json([
                'error' => false,
                'message' => 'Successfully retrieved bookings',
                'bookings' => Booking::where('active', 1)->with(['tShirt'])->get()
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while getting bookings!',
        ]);
    }

    function get($id): JsonResponse
    {
        try {
            return response()->json([
                'error' => false,
                'message' => 'Successfully retrieved booking',
                'booking' => Booking::where('id', $id)
                    ->with(['tShirt'])
                    ->first()
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while getting booking!',
        ]);
    }

    function getLimited($limit): JsonResponse
    {
        try {
            return response()->json([
                'error' => false,
                'message' => 'Successfully retrieved limited bookings',
                'bookings' => Booking::where('active', 1)->with(['tShirt'])->orderByDesc('id')->limit($limit)->get()
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while getting limited bookings!',
        ]);
    }

    function create(Request $request): JsonResponse
    {
        try {
            $newBooking = new Booking();
            $newBooking->reference = $this->bookingReferenceGenerate();
            $newBooking->status = "Payment Pending";
            $newBooking->payment_type = "WebXPay";
            $this->getData($request, $newBooking);

            return response()->json([
                'error' => false,
                'message' => 'Successfully created booking',
                'booking' => $newBooking
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while creating booking!',
        ]);
    }

    function adminCreate(Request $request): JsonResponse
    {
        try {
            $newBooking = new Booking();
            $newBooking->reference = $this->bookingReferenceGenerate();
            $newBooking->status = "Confirmed";
            $newBooking->payment_type = "Cash";
            $this->getData($request, $newBooking);

            return response()->json([
                'error' => false,
                'message' => 'Successfully created booking',
                'booking' => $newBooking
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while creating booking!',
        ]);
    }

    public function delete($id): JsonResponse
    {
        try {
            $booking = Booking::findOrFail($id);
            $booking->update(['active' => false]);

            return response()->json([
                'error' => false,
                'message' => 'Successfully deleted booking',
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while deleting booking!',
        ]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $booking = Booking::findOrFail($id);
            $this->getData($request, $booking);

            return response()->json([
                'error' => false,
                'message' => 'Successfully updated booking',
                'booking' => $booking
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while updating booking!',
        ]);
    }

    private function getData($request, $booking)
    {
        $booking->full_name = $request->full_name;
        $booking->date_of_birth = $request->date_of_birth;
        $booking->email = $request->email;
        $booking->phone = $request->phone;
        $booking->donation = $request->donation;
        $booking->t_shirt_id = $request->t_shirt;
        $booking->save();
    }

    private function bookingReferenceGenerate()
    {
        $bookingReference = date('y') . "" . date('m') . "" . date('d');
        $bookingReferenceList = Booking::where('reference', 'like', $bookingReference . '%')->get();

        if (count($bookingReferenceList) > 0) {
            $bookingReferenceList = $bookingReferenceList->sortBy('reference', SORT_REGULAR, true)->first()->reference;
            $bookingReferenceList += 1;
        } else {
            $bookingReferenceList = date('y') . "" . date('m') . "" . date('d') . "0001";
        }
        return $bookingReferenceList;
    }
}
