<?php

namespace App\Http\Controllers;

use App\Booking;
use App\BookingPayment;
use App\Order;
use App\OrderPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookingPaymentController extends Controller
{
    function paymentReceived(Request $request)
    {
        try {
            //decode & get POST parameters
            $payment = base64_decode($request->get('payment'));
            $signature = base64_decode($request->get('signature'));
            $customFields = base64_decode($request->get('custom_fields'));
            //load public key for signature matching
            $publicKey = "-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDniLV80g3ykBFTO5vrtXJDKAua
ri5V0RzyXmGV1K50jAajatNYzuiegeSdMVtWXqvkSjWmQJsv+njyMdPBeZBvN627
NZCIzqESCrtyZkqSf4W7iWKFWbbIY3Gt5NxMHQMce/wZ9HWN1h1xExo2nGZoxrt6
M6I7xoABOUNYDzullQIDAQAB
-----END PUBLIC KEY-----";
            openssl_public_decrypt($signature, $value, $publicKey);

            $signature_status = false;

            if ($value == $payment) {
                $signature_status = true;
            }

            //get payment response in segments
            //payment format: order_id|order_refference_number|date_time_transaction|payment_gateway_used|status_code|comment;
            $responseVariables = explode('|', $payment);

            $newBookingPayment = new BookingPayment();
            $newBookingPayment->transaction_id = $responseVariables[0];
            $newBookingPayment->transaction_reference_number = $responseVariables[1];
            $newBookingPayment->date_time = $responseVariables[2];
            $newBookingPayment->payment_gateway = $responseVariables[3];
            $newBookingPayment->status_code = $responseVariables[4];
            $newBookingPayment->comment = $responseVariables[5];

            $booking = Booking::where('reference', explode('|', $customFields)[0])
                ->where('active', 1)
                ->first();
            $newBookingPayment->booking_id = $booking->id;
            $newBookingPayment->save();

            $bookingController = new BookingController();
            $bookingController->updateBookingStatus($booking->id, $signature_status ? 'Confirmed' : 'Payment Failed');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }

        return redirect('booking/' . base64_encode(explode('|', base64_decode($request->get('custom_fields')))[0]));
    }
}
