<?php

namespace App\Http\Controllers;

use App\Booking;
use App\BookingTShirt;
use App\TShirt;
use App\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    function index(Request $request): JsonResponse
    {
        try {
            $user = null;
            $bookings = array();
            $token = null;
            if ($request->header('Authorization') && $request->header('Authorization') !== 'null') {
                $token = $request->header('Authorization');
            } elseif ($request->header('Token') && $request->header('Token') !== 'null') {
                $token = $request->header('Token');
            }
            if ($token) {
                $user = User::where('token', $token)->first();
                if ($user->role->name === "ADMIN") {
                    $bookings = Booking::where('active', 1)
                        ->where('is_group', false)
                        ->where('status', 'Confirmed')
                        ->with(['tShirt', 'user', 'payment'])
                        ->get();
                } else {
                    $bookings = Booking::where('active', 1)
                        ->where('is_group', false)
                        ->where('status', 'Confirmed')
                        ->where('user_id', $user->id)
                        ->with(['tShirt', 'user', 'payment'])
                        ->get();
                }
            }
            return response()->json([
                'error' => false,
                'message' => 'Successfully retrieved bookings',
                'bookings' => $bookings
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

    function indexGroup(Request $request): JsonResponse
    {
        try {
            $user = null;
            $bookings = array();
            $token = null;
            if ($request->header('Authorization') && $request->header('Authorization') !== 'null') {
                $token = $request->header('Authorization');
            } elseif ($request->header('Token') && $request->header('Token') !== 'null') {
                $token = $request->header('Token');
            }
            if ($token) {
                $user = User::where('token', $token)->first();
                if ($user->role->name === "ADMIN") {
                    $bookings = Booking::where('active', 1)
                        ->where('is_group', true)
                        ->where('status', 'Confirmed')
                        ->with(['bookingTShirts', 'bookingTShirts.tShirt', 'user', 'payment'])
                        ->get();
                } else {
                    $bookings = Booking::where('active', 1)
                        ->where('is_group', true)
                        ->where('status', 'Confirmed')
                        ->where('user_id', $user->id)
                        ->with(['bookingTShirts', 'bookingTShirts.tShirt', 'user', 'payment'])
                        ->get();
                }
            }
            return response()->json([
                'error' => false,
                'message' => 'Successfully retrieved bookings',
                'bookings' => $bookings
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

    function indexPending(Request $request): JsonResponse
    {
        try {
            $user = null;
            $bookings = array();
            $token = null;
            if ($request->header('Authorization') && $request->header('Authorization') !== 'null') {
                $token = $request->header('Authorization');
            } elseif ($request->header('Token') && $request->header('Token') !== 'null') {
                $token = $request->header('Token');
            }
            if ($token) {
                $user = User::where('token', $token)->first();
                if ($user->role->name === "ADMIN") {
                    $bookings = Booking::where('active', 1)
                        ->where('is_group', false)
                        ->where('status', '!=', 'Confirmed')
                        ->with(['tShirt', 'user', 'payment'])
                        ->get();
                } else {
                    $bookings = Booking::where('active', 1)
                        ->where('is_group', false)
                        ->where('status', '!=', 'Confirmed')
                        ->where('user_id', $user->id)
                        ->with(['tShirt', 'user', 'payment'])
                        ->get();
                }
            }
            return response()->json([
                'error' => false,
                'message' => 'Successfully retrieved bookings',
                'bookings' => $bookings
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

    function indexPendingGroup(Request $request): JsonResponse
    {
        try {
            $user = null;
            $bookings = array();
            $token = null;
            if ($request->header('Authorization') && $request->header('Authorization') !== 'null') {
                $token = $request->header('Authorization');
            } elseif ($request->header('Token') && $request->header('Token') !== 'null') {
                $token = $request->header('Token');
            }
            if ($token) {
                $user = User::where('token', $token)->first();
                if ($user->role->name === "ADMIN") {
                    $bookings = Booking::where('active', 1)
                        ->where('is_group', true)
                        ->where('status', '!=', 'Confirmed')
                        ->with(['bookingTShirts', 'bookingTShirts.tShirt', 'user', 'payment'])
                        ->get();
                } else {
                    $bookings = Booking::where('active', 1)
                        ->where('is_group', true)
                        ->where('status', '!=', 'Confirmed')
                        ->where('user_id', $user->id)
                        ->with(['bookingTShirts', 'bookingTShirts.tShirt', 'user', 'payment'])
                        ->get();
                }
            }
            return response()->json([
                'error' => false,
                'message' => 'Successfully retrieved bookings',
                'bookings' => $bookings
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

    function indexCheckedIn(Request $request): JsonResponse
    {
        try {
            $user = null;
            $bookings = array();
            $token = null;
            if ($request->header('Authorization') && $request->header('Authorization') !== 'null') {
                $token = $request->header('Authorization');
            } elseif ($request->header('Token') && $request->header('Token') !== 'null') {
                $token = $request->header('Token');
            }
            if ($token) {
                $user = User::where('token', $token)->first();
                if ($user->role->name === "ADMIN") {
                    $bookings = Booking::where('active', 1)
                        ->where('is_group', false)
                        ->where('checkin', true)
                        ->with(['tShirt', 'user', 'payment', 'checkedInBy'])
                        ->get();
                } else {
                    $bookings = Booking::where('active', 1)
                        ->where('is_group', false)
                        ->where('checkin', true)
                        ->where('user_id', $user->id)
                        ->with(['tShirt', 'user', 'payment', 'checkedInBy'])
                        ->get();
                }
            }
            return response()->json([
                'error' => false,
                'message' => 'Successfully retrieved bookings',
                'bookings' => $bookings
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

    function indexCheckedInGroup(Request $request): JsonResponse
    {
        try {
            $user = null;
            $bookings = array();
            $token = null;
            if ($request->header('Authorization') && $request->header('Authorization') !== 'null') {
                $token = $request->header('Authorization');
            } elseif ($request->header('Token') && $request->header('Token') !== 'null') {
                $token = $request->header('Token');
            }
            if ($token) {
                $user = User::where('token', $token)->first();
                if ($user->role->name === "ADMIN") {
                    $bookings = Booking::where('active', 1)
                        ->where('is_group', true)
                        ->where('checkin', true)
                        ->with(['bookingTShirts', 'bookingTShirts.tShirt', 'user', 'payment', 'checkedInBy'])
                        ->get();
                } else {
                    $bookings = Booking::where('active', 1)
                        ->where('is_group', true)
                        ->where('checkin', true)
                        ->where('user_id', $user->id)
                        ->with(['bookingTShirts', 'bookingTShirts.tShirt', 'user', 'payment', 'checkedInBy'])
                        ->get();
                }
            }
            return response()->json([
                'error' => false,
                'message' => 'Successfully retrieved bookings',
                'bookings' => $bookings
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

    function user($userId): JsonResponse
    {
        try {
            return response()->json([
                'error' => false,
                'message' => 'Successfully retrieved user bookings',
                'bookings' => $bookings = Booking::where('active', 1)
                    ->where('status', 'Confirmed')
                    ->where('user_id', $userId)
                    ->with(['tShirt', 'user', 'payment', 'bookingTShirts', 'bookingTShirts.tShirt'])
                    ->get()
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while getting user bookings!',
        ]);
    }

    function get($id): JsonResponse
    {
        try {
            return response()->json([
                'error' => false,
                'message' => 'Successfully retrieved booking',
                'booking' => Booking::where('id', $id)
                    ->with(['tShirt', 'bookingTShirts', 'bookingTShirts.tShirt', 'payment'])
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

    function getBooking($reference): JsonResponse
    {
        try {
            return response()->json([
                'error' => false,
                'message' => 'Successfully retrieved booking',
                'booking' => Booking::where('reference', base64_decode($reference))
                    ->with(['tShirt', 'bookingTShirts', 'bookingTShirts.tShirt'])
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
                'bookings' => Booking::where('active', 1)
                    ->where('is_group', false)
                    ->where('status', 'Confirmed')
                    ->with(['tShirt'])
                    ->orderByDesc('id')
                    ->limit($limit)
                    ->get()
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

    function getGroupLimited($limit): JsonResponse
    {
        try {
            return response()->json([
                'error' => false,
                'message' => 'Successfully retrieved limited bookings',
                'bookings' => Booking::where('active', 1)
                    ->where('is_group', true)
                    ->where('status', 'Confirmed')
                    ->with(['bookingTShirts'])
                    ->orderByDesc('id')
                    ->limit($limit)
                    ->get()
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

    function getDashboard(): JsonResponse
    {
        try {
            $bookings = Booking::where('active', 1)
                ->where('is_group', false)
                ->where('status', 'Confirmed')
                ->get();
            $groupBookings = Booking::where('active', 1)
                ->where('is_group', true)
                ->where('status', 'Confirmed')
                ->with(['bookingTShirts'])
                ->get();
            $tShirts = TShirt::where('active', 1)
                ->with(['bookings' => function ($q) {
                    $q->where('status', 'Confirmed')->where('active', 1);
                }])
                ->get();
            $cashDonations = 0.00;
            $onlineDonations = 0.00;
            $individualParticipants = 0;
            $groupParticipants = 0;
            $userLeaderboard = array();

            foreach ($bookings as $booking) {
                $individualParticipants += 1;
                if ($booking->payment_type === "Cash") {
                    $cashDonations += $booking->donation;
                    if ($booking->user_id) {
                        $id_list = array_column($userLeaderboard, 'id');
                        $index = array_search($booking->user_id, $id_list);
                        if ($index === false) {
                            $user = User::findOrFail($booking->user_id);
                            $user->individual_participants = 1;
                            $user->group_participants = 0;
                            $user->total_participants = 1;
                            array_push($userLeaderboard, $user);
                        } else {
                            $userLeaderboard[$index]->individual_participants += 1;
                            $userLeaderboard[$index]->total_participants += 1;
                        }
                    }
                } else {
                    $onlineDonations += $booking->donation;
                }
            }

            foreach ($groupBookings as $groupBooking) {
                foreach ($groupBooking->bookingTShirts as $booking_t_shirt) {
                    $groupParticipants += $booking_t_shirt->quantity;
                    if ($groupBooking->user_id) {
                        $id_list = array_column($userLeaderboard, 'id');
                        $index = array_search($groupBooking->user_id, $id_list);
                        if ($index === false) {
                            $user = User::findOrFail($groupBooking->user_id);
                            $user->individual_participants = 0;
                            $user->group_participants = $booking_t_shirt->quantity;
                            $user->total_participants = $booking_t_shirt->quantity;
                            array_push($userLeaderboard, $user);
                        } else {
                            $userLeaderboard[$index]->group_participants += $booking_t_shirt->quantity;
                            $userLeaderboard[$index]->total_participants += $booking_t_shirt->quantity;
                        }
                    }
                }
                if ($groupBooking->payment_type === "Cash") {
                    $cashDonations += $groupBooking->donation;
                } else {
                    $onlineDonations += $groupBooking->donation;
                }
            }

            foreach ($tShirts as $tShirt) {
                $remaining = $tShirt->quantity - count($tShirt->bookings);
                $sum = BookingTShirt::select(DB::raw('sum(quantity) as used_quantity'))
                    ->join('bookings', 'booking_id', '=', 'bookings.id')
                    ->where('booking_t_shirts.t_shirt_id', $tShirt->id)
                    ->where('booking_t_shirts.active', true)
                    ->where('bookings.active', true)
                    ->where('status', 'Confirmed')
                    ->get();
                $remaining -= $sum[0]['used_quantity'];
                unset($tShirt['bookings']);
                $tShirt->remaining = $remaining;
            }

            $userLeaderboard = collect($userLeaderboard)->sortByDesc('total_participants')->values()->all();

            return response()->json([
                'error' => false,
                'message' => 'Successfully retrieved dashboard stats',
                'cashDonations' => $cashDonations,
                'onlineDonations' => $onlineDonations,
                'individualParticipants' => $individualParticipants,
                'groupParticipants' => $groupParticipants,
                'tShirts' => $tShirts,
                'userLeaderboard' => $userLeaderboard
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while getting dashboard stats!',
        ]);
    }

    function sendEmail($id): JsonResponse
    {
        try {
            $booking = Booking::where('id', $id)
                ->with(['tShirt', 'bookingTShirts', 'bookingTShirts.tShirt'])
                ->first();

            $data = array('booking' => $booking);
            if ($booking->is_group) {
                $booking->member_count = 0;
                foreach ($booking->bookingTShirts as $bookingTShirt) {
                    $booking->member_count += $bookingTShirt->quantity;
                }
                Mail::send('mail.group-booking-email', $data, function ($message) use ($booking) {
                    $message->to($booking->email, ucwords($booking->full_name))->subject('Thank you for your contribution');
                });
            } else {
                Mail::send('mail.individual-booking-email', $data, function ($message) use ($booking) {
                    $message->to($booking->email, ucwords($booking->full_name))->subject('Thank you for your contribution');
                });
            }
            return response()->json([
                'error' => false,
                'message' => 'Successfully sent booking email',
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while sending booking email!',
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

            $newBooking = Booking::where('id', $newBooking->id)->with(['tShirt'])->first();

            // unique_order_id|total_amount
            $plainText = $newBooking->reference . '|' . $newBooking->donation;
            $publicKey = "-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQClRnNNmL9Omdb62JEAJ3X9e34s
R96tDDKRQyUkciLxuDQOPIs3axSzLF6KNsOSEOZX7jAq6/exwujKxLGnmMyJ3Asd
rTiRzioFtln5ljzPmMtrXbiD4+aXya0N5BOd3eleiTRYZ1KVubX+kESdk1cTfPTK
ZvuD9+TwQDpMSJBRZwIDAQAB
-----END PUBLIC KEY-----";
            //load public key for encrypting
            openssl_public_encrypt($plainText, $encrypt, $publicKey);

            //encode for data passing
            $payment = base64_encode($encrypt);

            $newBooking->custom_fields = base64_encode($newBooking->reference . "|" . $newBooking->full_name . "|" . $newBooking->email . "|" . $newBooking->phone);
            $newBooking->secret_key = "f8b7c0b5-ee96-4c28-bd58-c10d93b5acc2";
            $newBooking->payment = $payment;

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

    function createGroup(Request $request): JsonResponse
    {
        try {
            $newBooking = new Booking();
            $newBooking->reference = $this->bookingReferenceGenerate();
            $newBooking->status = "Payment Pending";
            $newBooking->payment_type = "WebXPay";
            $this->getGroupData($request, $newBooking);

            $newBooking = Booking::where('id', $newBooking->id)->with(['bookingTShirts', 'bookingTShirts.tShirt'])->first();

            // unique_order_id|total_amount
            $plainText = $newBooking->reference . '|' . $newBooking->donation;
            $publicKey = "-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQClRnNNmL9Omdb62JEAJ3X9e34s
R96tDDKRQyUkciLxuDQOPIs3axSzLF6KNsOSEOZX7jAq6/exwujKxLGnmMyJ3Asd
rTiRzioFtln5ljzPmMtrXbiD4+aXya0N5BOd3eleiTRYZ1KVubX+kESdk1cTfPTK
ZvuD9+TwQDpMSJBRZwIDAQAB
-----END PUBLIC KEY-----";
            //load public key for encrypting
            openssl_public_encrypt($plainText, $encrypt, $publicKey);

            //encode for data passing
            $payment = base64_encode($encrypt);

            $newBooking->custom_fields = base64_encode($newBooking->reference . "|" . $newBooking->full_name . "|" . $newBooking->email . "|" . $newBooking->phone);
            $newBooking->secret_key = "f8b7c0b5-ee96-4c28-bd58-c10d93b5acc2";
            $newBooking->payment = $payment;

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
            $newBooking = new Booking();
            $newBooking->reference = $this->bookingReferenceGenerate();
            $newBooking->status = "Confirmed";
            $newBooking->payment_type = "Cash";
            $newBooking->user_id = $user->id;
            $this->getData($request, $newBooking);

            return response()->json([
                'error' => false,
                'message' => 'Successfully created booking',
                'booking' => Booking::where('id', $newBooking->id)->with(['tShirt'])->first()
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

    function adminGroupCreate(Request $request): JsonResponse
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
            $newBooking = new Booking();
            $newBooking->reference = $this->bookingReferenceGenerate();
            $newBooking->status = "Confirmed";
            $newBooking->payment_type = "Cash";
            $newBooking->user_id = $user->id;
            $this->getGroupData($request, $newBooking);

            return response()->json([
                'error' => false,
                'message' => 'Successfully created booking',
                'booking' => Booking::where('id', $newBooking->id)->with(['bookingTShirts', 'bookingTShirts.tShirt'])->first()
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

            if ($booking->is_group) {
                BookingTShirt::where('booking_id', $booking->id)->update(['active' => false]);
            }

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
                'booking' => Booking::where('id', $booking->id)->with(['tShirt'])->first()
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

    public function updateGroup(Request $request, $id): JsonResponse
    {
        try {
            $booking = Booking::findOrFail($id);
            $this->getGroupData($request, $booking);

            return response()->json([
                'error' => false,
                'message' => 'Successfully updated booking',
                'booking' => Booking::where('id', $booking->id)->with(['bookingTShirts', 'bookingTShirts.tShirt'])->first()
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

    public function checkin(Request $request, $id): JsonResponse
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

            $booking = Booking::findOrFail($id);
            $booking->checkin = true;
            $booking->checked_in_by = $user->id;
            if ($booking->is_group) {
                $booking->checkin_count = $request->checkin_count;
            }
            $booking->save();

            return response()->json([
                'error' => false,
                'message' => 'Successfully checked in booking',
                'booking' => Booking::where('id', $booking->id)
                    ->with(['tShirt', 'bookingTShirts', 'bookingTShirts.tShirt'])
                    ->first()
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while checking in booking!',
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

    private function getGroupData($request, $booking)
    {
        $booking->full_name = $request->full_name;
        $booking->email = $request->email;
        $booking->phone = $request->phone;
        $booking->donation = $request->donation;
        $booking->is_group = true;
        $booking->person_name = $request->person_name;
        $booking->group_category = $request->group_category;
        $booking->save();

        BookingTShirt::where('booking_id', $booking->id)->delete();

        $t_shirts = $request->booking_t_shirts;
        foreach ($t_shirts as $t_shirt) {
            $booking_t_shirt = new BookingTShirt();
            $booking_t_shirt->booking_id = $booking->id;
            $booking_t_shirt->t_shirt_id = $t_shirt['t_shirt_id'];
            $booking_t_shirt->quantity = $t_shirt['quantity'];
            $booking_t_shirt->save();
        }
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

    public function updateBookingStatus($id, $status)
    {
        try {
            $booking = Booking::findOrFail($id);
            $booking->status = $status;
            $booking->save();

            if ($status === "Confirmed") {
                $this->sendEmail($booking->id);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
    }

    function downloadPDF($reference)
    {
        try {
            $booking = Booking::where('reference', $reference)
                ->with(['tShirt', 'bookingTShirts', 'bookingTShirts.tShirt'])
                ->first();

            $data = array('booking' => $booking);
            if ($booking->is_group) {
                $booking->member_count = 0;
                foreach ($booking->bookingTShirts as $bookingTShirt) {
                    $booking->member_count += $bookingTShirt->quantity;
                }
                $pdf = Pdf::loadView('pdf.group-booking-email', $data, array(), 'UTF-8');
            } else {
                $pdf = Pdf::loadView('pdf.individual-booking-email', $data, array(), 'UTF-8');
            }

            return $pdf->download('booking.pdf');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while downloading booking!',
        ]);
    }

    public function confirm($id): JsonResponse
    {
        try {
            $this->updateBookingStatus($id, "Confirmed");

            return response()->json([
                'error' => false,
                'message' => 'Successfully confirmed booking',
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while confirming booking!',
        ]);
    }
}
