<?php

namespace App\Http\Controllers;

use App\Booking;
use App\BookingPayment;
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
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQClRnNNmL9Omdb62JEAJ3X9e34s
R96tDDKRQyUkciLxuDQOPIs3axSzLF6KNsOSEOZX7jAq6/exwujKxLGnmMyJ3Asd
rTiRzioFtln5ljzPmMtrXbiD4+aXya0N5BOd3eleiTRYZ1KVubX+kESdk1cTfPTK
ZvuD9+TwQDpMSJBRZwIDAQAB
-----END PUBLIC KEY-----";
            openssl_public_decrypt($signature, $value, $publicKey);

            if ($value == $payment) {
                //get payment response in segments
                //order_id|order_refference_number|date_time_transaction|status_code|comment|payment_gateway_used;
                $responseVariables = explode('|', $payment);

                $newBookingPayment = new BookingPayment();
                $newBookingPayment->transaction_id = $responseVariables[0];
                $newBookingPayment->transaction_reference_number = $responseVariables[1];
                $newBookingPayment->date_time = $responseVariables[2];
                $newBookingPayment->payment_gateway = $responseVariables[5];
                $newBookingPayment->status_code = $responseVariables[3];
                $newBookingPayment->comment = $responseVariables[4];

                $booking = Booking::where('reference', explode('|', $customFields)[0])
                    ->where('active', 1)
                    ->first();
                $newBookingPayment->booking_id = $booking->id;
                $newBookingPayment->save();

                $bookingController = new BookingController();
                $bookingController->updateBookingStatus($booking->id, $newBookingPayment->status_code === "0" ? 'Confirmed' : 'Payment Failed');

                if ($newBookingPayment->status_code === "0") {
                    return redirect('booking/' . base64_encode($booking->reference));
                } else {
                    return redirect('payment-failed');
                }
            } else {
                Log::info("=========== Payment Validation Error ==========");
                Log::info($payment);
                Log::info($signature);
                Log::info($customFields);
                Log::info($value);
                Log::info("=========== End ==========");
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }

        return redirect('payment-failed');
    }
}
